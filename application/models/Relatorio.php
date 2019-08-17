<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para relatórios
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Relatorio extends CI_Model
{
    public function exemplares_disponiveis()
    {
        $this->load->model('Exemplar');
        $this->load->model('Livro');
        $this->load->model('Escritor');
        $this->load->model('Categoria');

        return 
        $this->db
             ->select("
                livro.codigo,
                livro.titulo,
                escritor.nome AS escritor,
                categoria.categoria,
                edicao,
                COUNT(*) AS quantidade_disponivel
             ")
             ->from(Exemplar::TABLENAME)
             ->join(Livro::TABLENAME, 'id_livro', 'inner')
             ->join(Escritor::TABLENAME, 'id_escritor', 'left')
             ->join(Categoria::TABLENAME, 'id_categoria', 'left')
             ->where('livro.inativo', FALSE)
             ->where('exemplar.status_exemplar', Exemplar::STATUS_LIVRE)
             ->where('exemplar.inativo', FALSE)
             ->group_by("
                livro.codigo,
                livro.titulo,
                escritor.nome,
                categoria.categoria,
                edicao
             ")
             ->order_by('livro.titulo')
             ->get()
             ->result();

    }
}