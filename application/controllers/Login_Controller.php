<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller de login
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Login_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        if (Usuario::Logado())
            redirect(base_url());

        $this->load->view('include/header');
        $this->load->view('login/login');
        $this->load->view('include/footer');
    }

    public function entrar()
    {
        $this->form_validation->set_rules('acesso', 'Acesso', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[3]');

        if ($this->form_validation->run() && !empty($_POST))
        {
            try
            {
                $acesso = $this->input->post('acesso');
                $senha = md5($this->input->post('senha'));

                if($this->Usuario->usuario_existe($acesso, $senha) === FALSE)
                    throw new Exception("Usuário e/ou senha inválido(s).");

                $this->Usuario->preparar_sessao($acesso, $senha);

                redirect(base_url('painel'));
            }
            catch (Exception $e)
            {
                $this->session->set_flashdata('error', $e->getMessage());
                $this->session->set_flashdata('post', $this->input->post());
                
                redirect(base_url('login'));
            }
        }
        else
        {
            redirect(base_url('login'));
        }
    }
    
    public function sair()
    {
        $this->Usuario->destruir_sessao();
    }
}