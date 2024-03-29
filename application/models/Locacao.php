<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle da Locação
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */
class Locacao extends CI_Model
{
    //Eduardo: Tabela do banco de dados
    const TABLENAME = "locacao";

    /**
     * Colunas da tabela livro:
     * id_locacao
     * id_usuario
     * id_exemplar
     * id_pessoa
     * data_locacao
     * data_planejada_entrega
     * data_entrega
     * observacao
     * encerrada
     * multa
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Configuracao');
        $this->load->model('Exemplar');
        $this->load->model('Pessoa');
        $this->load->model('Livro');
    }

    /**
     * Método para locar um livro
     *
     * @param integer $id_exemplar
     * @param integer $id_pessoa
     * @param string $data_locacao
     * @param string $data_planejada_entrega
     * @param string $observacao
     * @return integer
     */
    public function cadastrar(int $id_exemplar, int $id_pessoa, string $data_locacao, string $data_planejada_entrega, string $observacao) : int
    {
        $this->validar($id_exemplar, $id_pessoa, $data_locacao, $data_planejada_entrega);

        $this->db->insert(
            self::TABLENAME,
            [
                'id_exemplar' => $id_exemplar,
                'id_usuario' => $this->session->userdata('id'),
                'id_pessoa' => $id_pessoa,
                'data_locacao' => $data_locacao,
                'data_planejada_entrega' => $data_planejada_entrega,
                'observacao' => $observacao
            ]
        );

        $id = $this->db->insert_id();

        $this->Exemplar->atualizar_status($id_exemplar, Exemplar::STATUS_LOCADO);

        return $id;
    }

    /**
     * Buscar todas as locações em aberto
     *
     * @return void
     */
    public function get(array &$paginacao = NULL)
    {
        $this->db
            ->select('
            locacao.id_locacao,
            locacao.data_locacao,
            locacao.data_planejada_entrega,
            locacao.data_entrega,
            locacao.observacao,

            EXTRACT(days FROM AGE(locacao.data_planejada_entrega, NOW()::DATE)) AS dias_restantes,

            CASE WHEN (DATE_PART(\'day\', NOW() - locacao.data_planejada_entrega::TIMESTAMP) >= 1) THEN
                (DATE_PART(\'day\', NOW() - locacao.data_planejada_entrega::TIMESTAMP))::integer * config_locacao.valor_multa_por_dia
            ELSE
                0
            END AS multa,

            exemplar.id_exemplar,
            exemplar.codigo as codigo_exemplar,

            livro.id_livro,
            livro.codigo as codigo_livro,
            livro.titulo as titulo_livro,

            pessoa.id_pessoa,
            pessoa.codigo as codigo_pessoa,
            pessoa.nome as nome_pessoa
            ')
            ->from(Configuracao::TABLENAME_CONFIG_LOCACOES)
            ->from(self::TABLENAME)
            ->join(Exemplar::TABLENAME, 'id_exemplar', 'inner')
            ->join(Livro::TABLENAME, 'id_livro', 'inner')
            ->join(Escritor::TABLENAME, 'id_escritor', 'left')
            ->join(Categoria::TABLENAME, 'id_categoria', 'left')
            ->join(Prateleira::TABLENAME, 'id_prateleira', 'inner')
            ->join(Corredor::TABLENAME, 'id_corredor', 'inner')
            ->join(Pessoa::TABLENAME, 'id_pessoa', 'inner')
            ->where('encerrada', FALSE)
            ->order_by('data_planejada_entrega', 'ASC');

        if ($this->input->get('search'))
        {
            $this->db
                ->group_start()
                ->or_like('livro.codigo', $this->input->get('search'))
                ->or_like('livro.titulo', $this->input->get('search'))
                ->or_like('escritor.nome', $this->input->get('search'))
                ->or_like('categoria.categoria', $this->input->get('search'))
                ->or_like('prateleira.prateleira', $this->input->get('search'))
                ->or_like('pessoa.codigo', $this->input->get('search'))
                ->or_like('pessoa.nome', $this->input->get('search'))
                ->or_like('locacao.observacao', $this->input->get('search'))
                ->or_like('corredor.corredor', $this->input->get('search'))
                ->group_end();
        }

        if (!is_null($paginacao))
        {
            $data['total_rows'] = $this->db->count_all_results('', FALSE);

            $this->db->limit($paginacao['per_page'], $paginacao['offset']);
        }

        $data['result'] = $this->db->get()->result();

        return $data;
    }

    /**
     * Retornar locação
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        return $this->db->get_where(self::TABLENAME, ['id_locacao' => $id])->row();
    }

    /**
     * Encerrar locação
     *
     * @param integer $id_locacao
     * @param string $data_entrega
     * @return void
     */
    public function encerrar(int $id_locacao, string $data_entrega, float $multa = 0)
    {
        $locacao = $this->find($id_locacao);

        if (empty($locacao)) throw new Exception("Locação inexistente");

        if ($locacao->encerrada) throw new Exception("Locação já foi encerrada");

        $this->db->update(
            self::TABLENAME,
            [
                'data_entrega' => $data_entrega,
                'encerrada' => TRUE,
                'multa' => $multa
            ],
            ['id_locacao' => $id_locacao]
        );

        $locacao = $this->find($id_locacao);

        $this->Exemplar->atualizar_status($locacao->id_exemplar, Exemplar::STATUS_LIVRE);
    }

    public function excluir(int $id_locacao)
    {
        $locacao = $this->find($id_locacao);

        if (empty($locacao)) throw new Exception("Locação inexistente");

        if ($locacao->encerrada) throw new Exception("Locação já foi encerrada");

        $this->db->delete(self::TABLENAME, ['id_locacao' => $id_locacao]);

        $this->Exemplar->atualizar_status($locacao->id_exemplar, Exemplar::STATUS_LIVRE);
    }

    public function carregar_pessoas()
    {
        $this->load->model('Pessoa');

        return
            $this->db
                 ->select("
                    pessoa.id_pessoa,
                    pessoa.codigo,
                    pessoa.nome,
                    COALESCE(COUNT(locacao.id_locacao), 0) AS total_locacao,
                    COALESCE(COUNT(locacao.id_locacao), 0) <= (SELECT numero_maximo_locacoes FROM config_locacao) AS pode_locar
                 ")
                 ->from(Pessoa::TABLENAME)
                 ->join('(SELECT * FROM locacao WHERE encerrada IS FALSE) AS locacao', 'id_pessoa', 'left')
                 ->where('pessoa.inativo', FALSE)
                 ->group_by("pessoa.id_pessoa, pessoa.codigo, pessoa.nome")
                 ->get()
                 ->result();
    }

    private function validar(int $id_exemplar, int $id_pessoa, string $data_locacao, string $data_planejada_entrega) : void
    {
        if (empty($id_exemplar) || $id_exemplar <= 0) throw new Exception("Exemplar não informado");
        if (empty($id_pessoa) || $id_pessoa <= 0) throw new Exception("Pessoa não informada");
        if (empty($data_locacao)) throw new Exception("Data da locação não indicada");
        if (empty($data_planejada_entrega)) throw new Exception("Data de entrega não indicada");
    }

}