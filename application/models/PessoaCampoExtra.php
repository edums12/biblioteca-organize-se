<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle dos campos extras de pessoas
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class PessoaCampoExtra extends CI_Model
{
    const TABLENAME = "pessoa_campo_extra";

    /**
     * Colunas da tabela:
     *  id_pessoa_campo_extra
     *  campo
     *  obrigatorio
     *  observacao
     *  inativo   
     */ 

    /**
     * Retorna todos os campos extras do cadastro de pessoas
     *
     * @param boolean $inativo - Exibir inativo
     * @return void
     */
    public function get(bool $inativo = FALSE)
    {
        return $this->db->get_where(self::TABLENAME, ['inativo' => $inativo])->result();
    }

    /**
     * Método para cadastrar o campo extra
     *
     * @param string $campo
     * @param boolean $obrigatorio
     * @param string $observacao
     * @return integer
     */
    public function cadastrar(string $campo, bool $obrigatorio, string $observacao) :int
    {
        $this->validar($campo);

        $this->db->insert(
            self::TABLENAME, 
            [
                'campo' => $campo,
                'obrigatorio' => $obrigatorio,
                'observacao' => $observacao
            ]
        );  

        return $this->db->insert_id();
    }

    /**
     * Método para editar um campo extra
     *
     * @param integer $id
     * @param string $campo
     * @param boolean $obrigatorio
     * @param string $observacao
     * @return void
     */
    public function editar(int $id, string $campo, bool $obrigatorio, string $observacao)
    {
        $this->validar($campo);

        $this->db->update(
            self::TABLENAME, 
            [
                'campo' => $campo,
                'obrigatorio' => $obrigatorio,
                'observacao' => $observacao
            ],
            ['id_pessoa_campo_extra' => $id]
        );
    }

    /**
     * Método para ativar
     *
     * @param integer $id
     * @return void
     */
    public function ativar(int $id)
    {
        return $this->db->update(self::TABLENAME, ['inativo' => false], ['id_pessoa_campo_extra' => $id]);
    }

    /**
     * Método para inativar
     *
     * @param integer $id
     * @return void
     */
    public function inativar(int $id)
    {
        return $this->db->update(self::TABLENAME, ['inativo' => true], ['id_pessoa_campo_extra' => $id]);
    }

    /**
     * Método para validar as informações necessárias
     *
     * @param string $campo
     * @return void
     */
    public function validar(string $campo) :void
    {
        if (empty($campo)) throw new Exception("Campo não informado");
    }
}