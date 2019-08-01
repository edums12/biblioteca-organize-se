<?php

defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller de configurações
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Configuracao_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        Usuario::permitir_entrada([Usuario::ADMIN]);
    }

    public function atualizar_configuracao_locacao()
    {
        $http_referer = str_replace($this->config->item('base_url'), '', $_SERVER['HTTP_REFERER']);

        try
        {
            $dias = $this->input->post('input-tempo-dias-locacao');
            $multa = $this->input->post('input-tempovalor-multa-dia-atraso');
            $numero_maximo_locacoes = $this->input->post('input-numero-maximo-locacoes');

            $this->Configuracao->set_config_locacao($dias, $multa, $numero_maximo_locacoes);
            $this->session->set_flashdata('success', 'Configuração salva com sucesso');
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        finally
        {
            redirect(base_url($http_referer));
        }

    }
}