<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle do livro
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */
class Livro extends CI_Model
{
    //Eduardo: Tabela do banco de dados
    const TABLENAME = "livro";

    /**
     * Colunas da tabela livro:
     *  id_livro
     *  codigo
     *  titulo
     *  isbn
     *  id_escritor
     *  id_categoria
     *  id_prateleira
     *  edicao
     *  numero_paginas
     *  ano
     *  UF
     *  observacao
     *  inativo
     *  criado_em
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Escritor');
        $this->load->model('Categoria');
        $this->load->model('Prateleira');
        $this->load->model('Corredor');
    }

    public function cadastrar(string $codigo, string $titulo, string $isbn, string $escritor, string $categoria, int $id_prateleira, string $edicao, int $numero_paginas, string $ano, string $uf, string $observacao) : int
    {
        $this->validar($codigo, $titulo, $ano, $uf, $id_prateleira);

        if (empty($escritor)) 
            $escritor = NULL;

        if (empty($categoria))
            $categoria = NULL;

        $this->db->insert(
            self::TABLENAME,
            [
                'codigo' => $codigo,
                'titulo' => $titulo,
                'isbn' => $isbn,
                'id_escritor' => $this->Escritor->cadastrar_ou_buscar($escritor),
                'id_categoria' => $this->Categoria->cadastrar_ou_buscar($categoria),
                'id_prateleira' => $id_prateleira,
                'edicao' => $edicao,
                'numero_paginas' => $numero_paginas,
                'ano' => $ano,
                'uf' => strtoupper($uf),
                'observacao' => $observacao,
            ]
        );

        return $this->db->insert_id();
    }

    public function get(array &$paginacao = NULL)
    {
         
        $this->db
             ->select('
                livro.id_livro,
                livro.codigo,
                livro.titulo,
                livro.isbn,
                livro.edicao,
                livro.ano,
                livro.uf,
                livro.observacao,
                livro.inativo,
                livro.criado_em,

                escritor.id_escritor,
                escritor.nome as escritor,

                categoria.id_categoria,
                categoria.categoria,

                prateleira.id_prateleira,
                prateleira.prateleira,

                corredor.id_corredor,
                corredor.corredor,

                corredor.corredor || \' - \' || prateleira.prateleira AS corredor_prateleira,

                (SELECT COUNT(*) FROM exemplar WHERE id_livro = livro.id_livro) AS qtd_exemplares
             ')
            ->from(self::TABLENAME)
            ->join(Escritor::TABLENAME, 'id_escritor', 'inner')
            ->join(Categoria::TABLENAME, 'id_categoria', 'inner')
            ->join(Prateleira::TABLENAME, 'id_prateleira', 'inner')
            ->join(Corredor::TABLENAME, 'id_corredor', 'inner')
            ->order_by('livro.titulo', 'ASC');

        if (!is_null($paginacao))
        {
            $data['total_rows'] = $this->db->count_all_results('', FALSE);

            $this->db->limit($paginacao['per_page'], $paginacao['offset']);
        }

        $data['result'] = $this->db->get()->result();

        return $data;
    }

    public function find(int $id)
    {
        return 
        $this->db
             ->select('
                livro.id_livro,
                livro.codigo,
                livro.titulo,
                livro.isbn,
                livro.edicao,
                livro.ano,
                livro.uf,
                livro.observacao,
                livro.inativo,
                livro.criado_em,

                escritor.id_escritor,
                escritor.nome as escritor,

                categoria.id_categoria,
                categoria.categoria,

                prateleira.id_prateleira,
                prateleira.prateleira,

                corredor.id_corredor,
                corredor.corredor,

                corredor.corredor || \' - \' || prateleira.prateleira AS corredor_prateleira
             ')
            ->from(self::TABLENAME)
            ->join(Escritor::TABLENAME, 'id_escritor', 'inner')
            ->join(Categoria::TABLENAME, 'id_categoria', 'inner')
            ->join(Prateleira::TABLENAME, 'id_prateleira', 'inner')
            ->join(Corredor::TABLENAME, 'id_corredor', 'inner')
            ->where('id_livro', $id)
            ->get()
            ->row();
    }

    public function disponiveis()
    {
        $this->load->model('Exemplar');

        return
            $this->db
                 ->select('
                    livro.id_livro,
                    livro.titulo,
                    COUNT(exemplar.id_exemplar) AS exemplares_disponiveis
                ')
                ->from(self::TABLENAME)
                ->join(Exemplar::TABLENAME, 'id_livro', 'inner')
                ->where('exemplar.status_exemplar', Exemplar::STATUS_LIVRE)
                ->group_by('livro.id_livro, livro.titulo')
                ->get()
                ->result();
    }

    private function validar(string $codigo, string $titulo, string $ano, string $uf, int $id_prateleira) : void
    {
        if (strlen(trim($codigo)) == 0) throw new Exception("Código não informado");
        if (strlen(trim($titulo)) == 0) throw new Exception("Título não informado");
        if (!empty($ano) && strlen($ano) != 4) throw new Exception("Ano deve ter 4 caracteres");
        if (!empty($uf) && strlen($uf) != 2) throw new Exception("UF deve ter 2 caracteres");
        if (empty($id_prateleira) || $id_prateleira <= 0) throw new Exception("Prateleira não informada");
    }

}