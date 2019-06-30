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

        return $this->db->insert_id();
    }

    /**
     * Buscar todas as locações em aberto
     *
     * @return void
     */
    public function get()
    {
        return 
            $this->db
                 ->select('
                    locacao.id_locacao,
                    locacao.data_locacao,
                    locacao.data_planejada_entrega,
                    locacao.data_entrega,
                    locacao.observacao,

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
                 ->join(Pessoa::TABLENAME, 'id_pessoa', 'inner')
                 ->where('encerrada', FALSE)
                 ->order_by('data_planejada_entrega', 'desc')
                 ->get()
                 ->result();
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
    public function encerrar(int $id_locacao, string $data_entrega)
    {
        $locacao = $this->find($id_locacao);

        if (empty($locacao)) throw new Exception("Locação inexistente");

        if ($locacao->encerrada) throw new Exception("Locação já foi encerrada");

        $this->db->update(
            self::TABLENAME,
            [
                'data_entrega' => $data_entrega,
                'encerrada' => TRUE,
                'multa' => 0
            ],
            ['id_locacao' => $id_locacao]
        );

        return $this->find($id_locacao);
    }

    private function validar(int $id_exemplar, int $id_pessoa, string $data_locacao, string $data_planejada_entrega) : void
    {
        if (empty($id_exemplar) || $id_exemplar <= 0) throw new Exception("Exemplar não informado");
        if (empty($id_pessoa) || $id_pessoa <= 0) throw new Exception("Pessoa não informada");
        if (empty($data_locacao)) throw new Exception("Data da locação não indicada");
        if (empty($data_planejada_entrega)) throw new Exception("Data de entrega não indicada");

    }

}