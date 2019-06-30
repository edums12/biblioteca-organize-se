<?php

defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller do usuário
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Usuario_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        Usuario::permitir_entrada([Usuario::ADMIN]);
    }

    public function novo()
    {
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('usuario/cadastrar');
        $this->load->view('include/footer');
    }

    public function editar(int $id)
    {
        try 
        {
            $usuario = $this->Usuario->find($id);
    
            if (empty($usuario)) throw new Exception("Usuário não encontrado");

            $this->load->view('include/header');
            $this->load->view('include/navbar');
            $this->load->view('usuario/editar', ['usuario' => $usuario]);
            $this->load->view('include/footer');
        }
        catch (Exception $e) 
        {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('usuarios/listar'));
        }
        
    }

    public function listar()
    {
        // Carrega todos os usuários
        $data['usuarios'] = $this->Usuario->get();

        // Monta a tela de visualização
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('usuario/listar', $data);
        $this->load->view('include/footer');
    }

    public function cadastrar()
    {
        try
        {
            // Dados do formulário
            $nome            = $this->input->post('input-nome');
            $usuario         = $this->input->post('input-usuario');
            $senha           = $this->input->post('input-senha');
            $confirmar_senha = $this->input->post('input-confirmar-senha');
            $tipo_acesso     = intval($this->input->post('input-radio-acesso')) == 1 ? Usuario::ADMIN : Usuario::BIBLIOTECARIO;
            $observacao      = $this->input->post('textarea-observacao');

            // Validação
            if ($senha !== $confirmar_senha) throw new Exception("A confirmação da senha não é idêntica a senha");

            // Criar usuário no banco de dados
            $this->Usuario->criar_usuario($nome, $usuario, md5($senha), $tipo_acesso, $observacao);

            // Redireciona a tela com o aviso de sucesso
            $this->session->set_flashdata('success', 'Usuário cadastrado com sucesso');
            redirect(base_url('usuarios/listar'));
        }
        catch (Exception $e)
        {
            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('usuarios/novo'));
        }
    }

    public function atualizar()
    {
        try
        {
            // Dados do formulário
            $id              = $this->input->post('input-id');
            $nome            = $this->input->post('input-nome');
            $usuario         = $this->input->post('input-usuario');
            $senha           = $this->input->post('input-senha');
            $confirmar_senha = $this->input->post('input-confirmar-senha');
            $tipo_acesso     = intval($this->input->post('input-radio-acesso')) == 1 ? Usuario::ADMIN : Usuario::BIBLIOTECARIO;
            $observacao      = $this->input->post('textarea-observacao');

            // Validação
            if ($senha !== $confirmar_senha) throw new Exception("A confirmação da senha não é idêntica a senha");

            // Criar usuário no banco de dados
            $this->Usuario->atualizar_usuario($id, $nome, $usuario, md5($senha), $tipo_acesso, $observacao);

            // Redireciona a tela com o aviso de sucesso
            $this->session->set_flashdata('success', 'Usuário atualizado com sucesso');
            redirect(base_url('usuarios/listar'));
        }
        catch (Exception $e)
        {
            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url("usuarios/editar/$id"));
        }
    }

    public function inativar(int $id)
    {
        try
        {
            $this->Usuario->inativar($id);

            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('success', 'Usuário inativado com sucesso');
            redirect(base_url('usuarios/listar'));
        }
        catch (Exception $e)
        {
            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('usuarios/listar'));
        }
    }

    public function ativar(int $id)
    {
        try
        {
            $this->Usuario->ativar($id);

            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('success', 'Usuário ativado com sucesso');
            redirect(base_url('usuarios/listar'));
        }
        catch (Exception $e)
        {
            // Redireciona a tela com aviso de erro
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('usuarios/listar'));
        }
    }
}