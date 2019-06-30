<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle do escritor
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Escritor extends CI_Model
{
    const TABLENAME = "escritor";

    /**
     * Colunas da tabela:
     *  id_escritor
     *  nome
     *  criado_em
     */

    public function cadastrar_ou_buscar(string $escritor) :int
    {
        $escritor_banco_dados = $this->db->get_where(self::TABLENAME, ['nome' => $escritor])->row();

        if (empty($escritor_banco_dados))
        {
            $this->db->insert(
                self::TABLENAME, 
                ['nome' => $escritor]
            );

            return $this->db->insert_id();
        }
        else
        {
            return $escritor_banco_dados->id_escritor;
        }
    }

    public function get()
    {
        return $this->db->get(self::TABLENAME)->result();
    }
}