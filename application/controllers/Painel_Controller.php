<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller do painel principal
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Painel_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function inicial()
    {
        redirect(base_url('locacoes/listar'));
    }
}