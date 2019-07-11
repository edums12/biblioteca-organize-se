<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle do exemplar
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */
class Exemplar extends CI_Model
{
    //Eduardo: Tabela do banco de dados
    const TABLENAME = "exemplar";

    //Status do exemplar
    const STATUS_LIVRE   = "livre";
    const STATUS_LOCADO  = "locado";
    const STATUS_PERDIDO = "perdido";
    const STATUS_RESERVADO = "reservado";


    /**
     * Colunas da tabela livro:
     * id_exemplar
     * id_livro
     * codigo
     * observacao
     * status_exemplar
     * criado_em 
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Livro');
        $this->load->model('Escritor');
        $this->load->model('Categoria');
        $this->load->model('Prateleira');
        $this->load->model('Corredor');
    }

    public function cadastrar(int $id_livro, string $codigo, string $status, string $observacao) : int
    {
        $this->validar($id_livro, $codigo, $status);

        $this->db->insert(
            self::TABLENAME,
            [
                'id_livro' => $id_livro,
                'codigo' => $codigo,
                'status_exemplar' => $status,
                'observacao' => $observacao
            ]
        );

        return $this->db->insert_id();
    }

    public function get(int $id_livro)
    {
        return $this->db->order_by('codigo')->get_where(self::TABLENAME, ['id_livro' => $id_livro])->result();
    }

    public function listar_exemplares_para_locar()
    {
        return
            $this->db
                 ->select('exemplar.id_exemplar, exemplar.codigo, livro.titulo')
                 ->from(self::TABLENAME)
                 ->join('livro', 'id_livro', 'inner')
                 ->where('status_exemplar', self::STATUS_LIVRE)
                 ->order_by('livro.titulo', 'asc')
                 ->order_by('exemplar.codigo', 'asc')
                 ->get()->result();
    }

    public function atualizar_status(int $id_exemplar, string $status)
    {
        if (empty($status) || !in_array($status, [self::STATUS_LIVRE, self::STATUS_LOCADO, self::STATUS_PERDIDO, self::STATUS_RESERVADO])) throw new Exception("Status não informado ou não permitido");

        $this->db->update(self::TABLENAME, ['status_exemplar' => $status], ['id_exemplar' => $id_exemplar]);
    }

    private function validar(int $id_livro, string $codigo, string $status) : void
    {
        if (empty($id_livro)) throw new Exception("Livro não informado");
        if (empty($codigo)) throw new Exception("Código não informado");
        if (empty($status) || !in_array($status, [self::STATUS_LIVRE, self::STATUS_LOCADO, self::STATUS_PERDIDO, self::STATUS_RESERVADO])) throw new Exception("Status não informado ou não permitido");
    }

}