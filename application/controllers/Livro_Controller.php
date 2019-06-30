<?php

defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller de Livro
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Livro_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Livro');
        $this->load->model('Prateleira');
        $this->load->model('Categoria');
        $this->load->model('Escritor');

        Usuario::permitir_entrada([Usuario::ADMIN, Usuario::BIBLIOTECARIO]);
    }

    public function novo()
    {
        $data['prateleiras'] = $this->Prateleira->carregar();
        $data['categorias'] = $this->Categoria->get();
        $data['escritores'] = $this->Escritor->get();

        // Monta a tela de visualização
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('livro/novo', $data);
        $this->load->view('include/footer');
    }

    public function cadastrar()
    {
        try
        {
            $codigo = $this->input->post('input-codigo');
            $titulo = $this->input->post('input-titulo');
            $isbn = $this->input->post('input-isbn');
            $escritor = $this->input->post('input-escritor');
            $categoria = $this->input->post('input-categoria');
            $id_prateleira = $this->input->post('input-id-prateleira');
            $edicao = $this->input->post('input-edicao');
            $numero_paginas = $this->input->post('input-numero-paginas');
            $ano = $this->input->post('input-ano');
            $uf = $this->input->post('input-uf');
            $observacao = $this->input->post('textarea-observacao');
    
            $this->Livro->cadastrar($codigo, $titulo, $isbn, $escritor, $categoria, intval($id_prateleira), $edicao, intval($numero_paginas), $ano, $uf, $observacao);

            redirect(base_url('livros/listar'));
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('livros/novo'));
        }
    }

    public function listar()
    {
        $data['livros'] = $this->Livro->get();

        // Monta a tela de visualização
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('livro/listar', $data);
        $this->load->view('include/footer');
    }

}