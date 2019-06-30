<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle da categoria
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Categoria extends CI_Model
{
    const TABLENAME = "categoria";

    /**
     * Colunas da tabela:
     *  id_categoria
     *  categoria
     *  criado_em
     */ 

    public function cadastrar_ou_buscar(string $categoria) :int
    {
        $categoria_banco_dados = $this->db->get_where(self::TABLENAME, ['categoria' => $categoria])->row();

        if (empty($categoria_banco_dados))
        {
            $this->db->insert(
                self::TABLENAME, 
                ['categoria' => $categoria]
            );

            return $this->db->insert_id();
        }
        else
        {
            return $categoria_banco_dados->id_categoria;
        }
    }

    public function get()
    {
        return $this->db->get(self::TABLENAME)->result();
    }
}