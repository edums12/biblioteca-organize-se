<?php

defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller de relatórios
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Relatorio_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        Usuario::permitir_entrada([Usuario::ADMIN, Usuario::BIBLIOTECARIO]);

        $this->load->model('Relatorio');
    }

    public function index()
    {
        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('relatorio/painel');
        $this->load->view('include/footer');
    }

    public function exemplares_disponiveis()
    {
        $data['relatorio'] = $this->Relatorio->exemplares_disponiveis();

        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('relatorio/exemplares_disponiveis', $data);
        $this->load->view('include/footer');
    }
}