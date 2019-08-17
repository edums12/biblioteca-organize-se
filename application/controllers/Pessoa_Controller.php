
<?php

defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller de pessoas
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Pessoa_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        Usuario::permitir_entrada([Usuario::ADMIN, Usuario::BIBLIOTECARIO]);

        $this->load->model('Pessoa');
        $this->load->model('Prateleira');
    }

    public function listar()
    {
        $paginacao = Base::configuracao_paginacao('pessoas/listar', 3);

        $result = $this->Pessoa->get(TRUE, $paginacao);
        
        $data['pessoas'] = $result['result'];

        $paginacao['total_rows'] = $result['total_rows'];

        $this->pagination->initialize($paginacao);
        
        $data['paginacao'] = $this->pagination->create_links();

        $data['total_registros'] = $paginacao['total_rows'];
        
        // Monta a tela de visualização
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('pessoa/listar', $data);
        $this->load->view('include/footer');
    }

    public function novo()
    {
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('pessoa/novo');
        $this->load->view('include/footer');
    }

    public function cadastrar()
    {
        try
        {
            $codigo = $this->input->post('input-codigo');
            $nome = $this->input->post('input-nome');
            $telefone = $this->input->post('input-telefone');
            $email = $this->input->post('input-email');
            $observacao = $this->input->post('textarea-observacao');

            $this->Pessoa->cadastrar($codigo, $nome, $telefone, $email, $observacao, array());

            $this->session->set_flashdata('success', 'Pessoa cadastrada com successo');

            redirect(base_url('pessoas/listar'));
        }
        catch (Exception $ex)
        {
            $this->session->set_flashdata('error', $ex->getMessage());
            $this->session->set_flashdata('post', $this->input->post());
            
            redirect(base_url('pessoas/novo'));
        }
    }

    public function editar(int $id)
    {
        try
        {
            $data['pessoa'] = $this->Pessoa->find($id);

            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view('pessoa/editar', $data);
            $this->load->view('include/footer');
        }
        catch (Exception $ex)
        {
            $this->session->set_flashdata('error', $ex->getMessage());

            redirect(base_url('pessoas/listar'));
        }
    }

    public function atualizar()
    {
        try
        {
            $id = intval($this->input->post('input-id'));
            $nome = $this->input->post('input-nome');
            $telefone = $this->input->post('input-telefone');
            $email = $this->input->post('input-email');
            $observacao = $this->input->post('textarea-observacao');

            $this->Pessoa->atualizar($id, $nome, $telefone, $email, $observacao, array());

            $this->session->set_flashdata('success', 'Pessoa atualizada com successo');

            redirect(base_url('pessoas/listar'));
        }
        catch (Exception $ex)
        {
            $this->session->set_flashdata('error', $ex->getMessage());

            redirect(base_url("pessoas/editar/$id"));
        }
    }

    public function inativar(int $id)
    {
        try
        {
            $this->Pessoa->inativar($id);

            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('success', 'Pessoa inativada com sucesso');
            redirect(base_url('pessoas/listar'));
        }
        catch (Exception $e)
        {
            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('pessoas/listar'));
        }
    }

    public function ativar(int $id)
    {
        try
        {
            $this->Pessoa->ativar($id);

            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('success', 'Pessoa ativada com sucesso');
            redirect(base_url('pessoas/listar'));
        }
        catch (Exception $e)
        {
            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('pessoas/listar'));
        }
    }

}