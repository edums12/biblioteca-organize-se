<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle das configurações
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Configuracao extends CI_Model
{
    const TABLENAME_CONFIG_LOCACOES = "config_locacao";
    const TABLENAME_CONFIG_AJUSTES = "config_ajustes";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Adiciona a configuração da locação
     *
     * @param integer $dias - Dias para a locação
     * @param float $multa - Valor da multa por dia de atraso
     * @return void
     */
    public function set_config_locacao(int $dias, float $multa, int $numero_maximo_locacoes)
    {
        $this->db->update(
            self::TABLENAME_CONFIG_LOCACOES, 
            [
                'dias_para_locacao' => $dias, 
                'valor_multa_por_dia' => $multa,
                'numero_maximo_locacoes' => $numero_maximo_locacoes
            ]
        );
    }

    public function get_config_locacao()
    {
        return $this->db->get(self::TABLENAME_CONFIG_LOCACOES)->row();
    }

    public function set_config_ajustes(bool $exibir_pessoas_inativas)
    {
        $this->db->update(
            self::TABLENAME_CONFIG_AJUSTES, 
            [
                'exibir_pessoas_inativas' => $exibir_pessoas_inativas
            ]
        );
    }

    public function get_config_ajustes()
    {
        return $this->db->get(self::TABLENAME_CONFIG_AJUSTES)->row();
    }

    
}