<?php

defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller de corredor e prateleiras
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Corredor_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Corredor');

        Usuario::permitir_entrada([Usuario::ADMIN]);
    }

    public function listar()
    {
        $data['corredores'] = $this->Corredor->get();
        
        // Monta a tela de visualização
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('corredor/listar', $data);
        $this->load->view('include/footer');
    }

    public function novo()
    {
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('corredor/novo');
        $this->load->view('include/footer');
    }

    public function cadastrar()
    {
        try
        {
            $corredor = $this->input->post('input-corredor');
            $prateleiras = explode(';', $this->input->post('input-prateleiras'));

            if (count($prateleiras) == 0)
                throw new Exception("Nenhuma prateleira informada");

            $this->Corredor->cadastrar($corredor, $prateleiras);

            $this->session->set_flashdata('success', 'Corredor adicionado com successo');

            redirect(base_url('corredores/listar'));
        }
        catch (Exception $ex)
        {
            $this->session->set_flashdata('error', $ex->getMessage());

            redirect(base_url('corredores/novo'));
        }
    }

    public function editar(int $id)
    {
        try
        {
            $data['corredor'] = $this->Corredor->find($id);
            $data['corredor']->prateleiras = json_decode($data['corredor']->prateleiras);

            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view('corredor/editar', $data);
            $this->load->view('include/footer');
        }
        catch (Exception $ex)
        {
            $this->session->set_flashdata('error', $ex->getMessage());

            redirect(base_url('corredores/listar'));
        }
    }

    public function atualizar()
    {
        try
        {
            $id = intval($this->input->post('input-id'));
            $corredor = $this->input->post('input-corredor');
            $prateleiras = explode(';', $this->input->post('input-prateleiras'));

            if (count($prateleiras) == 0)
                throw new Exception("Nenhuma prateleira informada");

            $this->Corredor->atualizar($id, $corredor, $prateleiras);

            $this->session->set_flashdata('success', 'Corredor atualizado com successo');

            redirect(base_url('corredores/listar'));
        }
        catch (Exception $ex)
        {
            $this->session->set_flashdata('error', $ex->getMessage());

            redirect(base_url("corredores/editar/$id"));
        }
    }

    public function inativar(int $id)
    {
        try
        {
            $this->Corredor->inativar($id);

            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('success', 'Corredor inativado com sucesso');
            redirect(base_url('corredores/listar'));
        }
        catch (Exception $e)
        {
            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('corredores/listar'));
        }
    }

    public function ativar(int $id)
    {
        try
        {
            $this->Corredor->ativar($id);

            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('success', 'Corredor ativado com sucesso');
            redirect(base_url('corredores/listar'));
        }
        catch (Exception $e)
        {
            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('corredores/listar'));
        }
    }

}