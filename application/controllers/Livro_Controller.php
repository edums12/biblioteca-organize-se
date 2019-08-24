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
        $data['prateleiras'] = json_encode($this->Prateleira->carregar());
        $data['categorias'] = json_encode($this->Categoria->get());
        $data['escritores'] = json_encode($this->Escritor->get());

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
            $quantidade_exemplares = $this->input->post('input-quantidade-exemplares');
    
            $this->Livro->cadastrar($codigo, $titulo, $isbn, $escritor, $categoria, intval($id_prateleira), $edicao, intval($numero_paginas), $ano, $uf, $observacao, $quantidade_exemplares);

            $this->session->set_flashdata('success', 'Livro cadastrado com sucesso');

            redirect(base_url('livros/listar'));
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
            $this->session->set_flashdata('post', $this->input->post());
            
            redirect(base_url('livros/novo'));
        }
    }

    public function listar()
    {
        $paginacao = Base::configuracao_paginacao('livros/listar', 3);

        $result = $this->Livro->get($paginacao);

        $data['livros'] = $result['result'];

        $paginacao['total_rows'] = $result['total_rows'];

        $this->pagination->initialize($paginacao);
        
        $data['paginacao'] = $this->pagination->create_links();

        $data['total_registros'] = $paginacao['total_rows'];

        // Monta a tela de visualização
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('livro/listar', $data);
        $this->load->view('include/footer');
    }

    public function editar(int $id_livro)
    {
        $data['livro'] = $this->Livro->find($id_livro);

        $data['prateleiras'] = json_encode($this->Prateleira->carregar());
        $data['categorias'] = json_encode($this->Categoria->get());
        $data['escritores'] = json_encode($this->Escritor->get());

        // Monta a tela de visualização
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('livro/editar', $data);
        $this->load->view('include/footer');
    }

    public function atualizar()
    {
        try
        {
            list(
                'input-id' => $id,
                'input-codigo' => $codigo,
                'input-titulo' => $titulo,
                'input-isbn' => $isbn,
                'input-escritor' => $escritor,
                'input-categoria' => $categoria,
                'input-id-prateleira' => $id_prateleira,
                'input-edicao' => $edicao,
                'input-numero-paginas' => $numero_paginas,
                'input-ano' => $ano,
                'input-uf' => $uf,
                'input-quantidade-exemplares' => $quantidade_exemplares,
                'textarea-observacao' => $observacao,
            ) = $this->input->post();

            $this->Livro->atualizar(intval($id), $codigo, $titulo, $isbn, $escritor, $categoria, intval($id_prateleira), $edicao, intval($numero_paginas), $ano, $uf, $observacao, intval($quantidade_exemplares));

            $this->session->set_flashdata('success', 'Livro atualizado com sucesso');

            redirect(base_url('livros/listar'));
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
            $this->session->set_flashdata('post', $this->input->post());

            redirect(base_url("livros/editar/{$id}"));
        }
    }

}