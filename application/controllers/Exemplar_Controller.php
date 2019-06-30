<?php

defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller de exemplares
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Exemplar_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Exemplar');
        $this->load->model('Livro');

        Usuario::permitir_entrada([Usuario::ADMIN, Usuario::BIBLIOTECARIO]);
    }

    public function listar(int $id_livro)
    {
        $data['exemplares'] = $this->Exemplar->get($id_livro);
        $data['livro'] = $this->Livro->find($id_livro);
        
        // Monta a tela de visualização
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('exemplar/listar', $data);
        $this->load->view('include/footer');
    }

    public function cadastrar(int $id_livro)
    {
        try
        {
            $livro = $this->Livro->find($id_livro);

            $codigo = $livro->codigo . "-" . $this->input->post('input-codigo');
            $status = $this->input->post('select-status');
            $observacao = $this->input->post('textarea-observacao');

            $this->Exemplar->cadastrar($id_livro, $codigo, $status, $observacao);

            $this->session->set_flashdata('success', 'Exemplar adicionado com sucesso');
            redirect(base_url("exemplares/{$id_livro}/listar"));
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url("exemplares/{$id_livro}/listar"));
        }   
    }

    public function alterar_status(int $id_livro, int $id_exemplar, string $status)
    {
        try
        {
            if (!in_array($status, [Exemplar::STATUS_LIVRE, Exemplar::STATUS_LOCADO, Exemplar::STATUS_PERDIDO]))
                throw new Exception("Status \"{$status}\" não é conhecido como status de exemplar");
            
            $this->Exemplar->atualizar_status($id_exemplar, $status);
            
            $this->session->set_flashdata('success', 'Status atualizado com successo');
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        finally
        {
            redirect(base_url("exemplares/{$id_livro}/listar"));
        }
    }
}