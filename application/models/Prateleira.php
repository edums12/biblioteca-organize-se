<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle da prateleira
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Prateleira extends CI_Model
{
    const TABLENAME = "prateleira";

    /**
     * Colunas da tabela:
     *  id_prateleira
     *  id_corredor
     *  prateleira
     *  criado_em
     */ 

    public function cadastrar(int $id_corredor, string $prateleira) :int
    {
        $this->db->insert(
            self::TABLENAME, 
            [
                'id_corredor' => $id_corredor,
                'prateleira'  => $prateleira
            ]
        );

        return $this->db->insert_id();
    }

    public function cadastrar_ou_buscar(int $id_corredor, string $prateleira)
    {
        $prateleira_banco_dados = $this->db->get_where(self::TABLENAME, ['id_corredor' => $id_corredor, 'prateleira' => $prateleira])->row();

        if (empty($prateleira_banco_dados))
        {
            $this->db->insert(
                self::TABLENAME, 
                [
                    'id_corredor' => $id_corredor,
                    'prateleira' => $prateleira
                ]
            );

            return $this->db->insert_id();
        }
        else
        {
            return $prateleira_banco_dados->id_prateleira;
        }
    }

    public function get(int $id_corredor)
    {
        return $this->db->get_where(self::TABLENAME, ['id_corredor' => $id_corredor])->result();
    }

    public function carregar()
    {
        $this->load->model('Corredor');

        return
            $this->db
                 ->select('
                        prateleira.id_prateleira,
                        prateleira.prateleira,

                        corredor.corredor
                 ')
                 ->from(self::TABLENAME)
                 ->join(Corredor::TABLENAME, 'id_corredor')
                 ->where(['corredor.inativo' => FALSE])
                 ->get()
                 ->result();
    }
}