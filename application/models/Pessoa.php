<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle de pessoa
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Pessoa extends CI_Model
{
    const TABLENAME = "pessoa";

    /**
     * Colunas da tabela:
     *  id_pessoa
     *  codigo
     *  nome
     *  data_nascimento
     *  telefone
     *  email
     *  observacao
     *  inativo
     *  criado_em
     */ 

     /**
      * Retorna todas as pessoas cadastradas
      *
      * @param boolean $inativo
      * @return void
      */
    public function get(bool $inativo = FALSE, array &$paginacao = NULL)
    {
        $where = array();

        if (!$inativo)
            $where = ['inativo' => FALSE];

        $this->db->select('pessoa.*, TO_CHAR(AGE(now()::DATE, pessoa.data_nascimento::DATE), \'YY anos\') as idade')->from(self::TABLENAME)->where($where)->order_by('pessoa.nome');
        
        if (!is_null($paginacao))
        {
            $data['total_rows'] = $this->db->count_all_results('', FALSE);

            $this->db->limit($paginacao['per_page'], $paginacao['offset']);
        }

        $data['result'] = $this->db->get()->result();

        return $data;
    }

    public function cadastrar(string $codigo, string $nome, string $data_nascimento, string $telefone, string $email, string $observacao, array $campos_extras) :int
    {
        $this->validar($nome, $data_nascimento);

        $this->db->insert(
            self::TABLENAME,
            [
                'codigo' => $codigo,
                'nome' => $nome,
                'data_nascimento' => $data_nascimento,
                'telefone' => $telefone,
                'email' => $email,
                'observacao' => $observacao
            ]
        );

        $id_pessoa = $this->db->insert_id();

        $this->db->reset_query();

        foreach ($campos_extras as $campo_extra)
        {
            $this->adicionar_campo_extra_pessoa($id_pessoa, $campo_extra['id_pessoa_campo_extra'], $campo_extra['valor']);
        }

        return $id_pessoa;
    }

    public function find(int $id)
    {
        return $this->db->select('pessoa.*, age(now()::date, pessoa.data_nascimento::date) as idade')->get_where(self::TABLENAME, ['id_pessoa' => $id])->row();
    }

    public function atualizar(int $id_pessoa, string $nome, string $data_nascimento, string $telefone, string $email, string $observacao, array $campos_extras)
    {
        $this->validar($nome, $data_nascimento);

        $this->db->update(
            self::TABLENAME,
            [
                'nome' => $nome,
                'data_nascimento' => $data_nascimento,
                'telefone' => $telefone,
                'email' => $email,
                'observacao' => $observacao
            ],
            [
                'id_pessoa' => $id_pessoa
            ]
        );

        $this->db->reset_query();

        foreach ($campos_extras as $campo_extra)
        {
            $this->editar_campo_extra_pessoa($campo_extra['id_pessoa_campo_extra_valor'], $campo_extra['valor']);
        }
    }

    public function adicionar_campo_extra_pessoa(int $id_pessoa, int $id_pessoa_campo_extra, string $valor) :int
    {
        /**
         * id_pessoa_campo_extra_valor
         * id_pessoa
         * id_pessoa_campo_extra
         * valor
         */

        $this->db->insert('pessoa_campo_extra_valor', ['id_pessoa' => $id_pessoa, 'id_pessoa_campo_extra' => $id_pessoa_campo_extra, 'valor' => $valor]);

        $id = $this->db->insert_id();

        $this->db->reset_query();

        return $id;
    }

    public function editar_campo_extra_pessoa(int $id_pessoa_campo_extra_valor, string $valor)
    {
        return $this->db->update('pessoa_campo_extra_valor', ['valor' => $valor], ['id_pessoa_campo_extra_valor' => $id_pessoa_campo_extra_valor]);
    }

    /**
     * Inativa o pessoa
     *
     * @param integer $id_pessoa
     * @return mixed
     */
    public function inativar(int $id_pessoa)
    {
        return $this->db->update(self::TABLENAME, array('inativo' => true), array('id_pessoa' => $id_pessoa));
    }

    /**
     * Ativa o pessoa
     *
     * @param integer $id_pessoa
     * @return mixed
     */
    public function ativar(int $id_pessoa)
    {
        return $this->db->update(self::TABLENAME, array('inativo' => false), array('id_pessoa' => $id_pessoa));
    }

    private function validar(string $nome, string $data_nascimento)
    {
        if (empty($nome)) throw new Exception("Nome não informado");
        if (empty($data_nascimento)) throw new Exception("Data de nascimento não informada");
    }
    
}