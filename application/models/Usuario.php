<?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para o controle de usuário
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */
class Usuario extends CI_Model
{
    //Eduardo: Tabela do banco de dados
    const TABLENAME = "usuario";

    const ADMIN = "administrador";
    const BIBLIOTECARIO = "bibliotecário";

    /**
     * Colunas da tabela usuário:
     * 	id_usuario
     *  nome
     *  acesso
     *  senha
     *  tipo_acesso
     *  criado_em
     *  observacao
     *  inativo
     */

    /**
     * Verifica se o usuário existe. [Somente usuários ativos]
     *
     * @param string $acesso - Acesso do usuário
     * @param string $senha - Senha já deve vir criptografada
     * @return boolean
     */
    public function usuario_existe(string $acesso, string $senha) :bool
    {
        $usuario = 
            $this->db->get_where(
                self::TABLENAME, 
                array(
                    'acesso' => $acesso,
                    'senha' => $senha,
                    'inativo' => FALSE
                )
            )->row();

        return !empty($usuario);
    }

    /**
     * Retorna o usuário através do acesso dele
     *
     * @param string $acesso - Login do usuário
     * @return object - Usuário
     */
    public function buscar_usuario(string $acesso)
    {
        return $this->db->get_where(self::TABLENAME, array('acesso' => $acesso))->row();
    }

    /**
     * Método para preparar a sessão do usuário logado
     *
     * @param string $acesso - Acesso do usuário
     * @param string $senha - Senha do usuário
     * @return void
     */
    public function preparar_sessao(string $acesso, string $senha) :void
    {
        $usuario = 
            $this->db->get_where(
                self::TABLENAME, 
                array(
                    'acesso' => $acesso,
                    'senha' => $senha,
                    'inativo' => FALSE
                )
            )->row();

        if (!empty($usuario))
        {
            $this->session->set_userdata(
                array(
                    'id' => $usuario->id_usuario,
                    'nome' => $usuario->nome,
                    'acesso' => $usuario->acesso,
                    'logado' => TRUE,
                    'tipo_acesso' => $usuario->tipo_acesso
                )
            );
        }
        else
        {
            throw new Exception("Usuário não existe");
        }
    }

    /**
     * Destroi a sessão conectada
     *
     * @return void
     */
    public function destruir_sessao() :void
    {
        $this->session->sess_destroy();

        redirect(base_url('login'));
    }

    /**
     * Método para criar um novo usuário
     *
     * @param string $nome
     * @param string $acesso
     * @param string $senha - Senha já deve vir criptografada
     * @param string $tipo_acesso
     * @param string $observacao
     * @return integer
     */
    public function criar_usuario(string $nome, string $acesso, string $senha, string $tipo_acesso, string $observacao) :int
    {
        //Validação
        $this->validar($nome, $acesso, $senha, $tipo_acesso, TRUE);

        //Insere o usuário
        $this->db->insert(
            self::TABLENAME,
            array(
                'nome' => $nome,
                'acesso' => $acesso,
                'senha' => $senha,
                'tipo_acesso' => $tipo_acesso,
                'observacao' => $observacao
            )
        );

        //Retorna o ID do novo usuário
        return $this->db->insert_id();
    }

    /**
     * Método para atualizar o usuário
     *
     * @param integer $id_usuario
     * @param object $usuario
     * @return boolean
     */
    public function atualizar_usuario(int $id_usuario, string $nome, string $acesso, string $senha, string $tipo_acesso, string $observacao) :bool
    {
        //Validação
        $this->validar($nome, $acesso, $senha, $tipo_acesso, FALSE);
        
        $usuario = array(
            'nome' => $nome,
            'acesso' => $acesso,
            'senha' => $senha,
            'tipo_acesso' => $tipo_acesso,
            'observacao' => $observacao
        );

        return $this->db->update(self::TABLENAME, $usuario, array('id_usuario' => $id_usuario));
    }

    /**
     * Método para retornar todos os usuários
     *
     * @return void
     */
    public function get()
    {
        if ($this->input->get('search'))
        {
            $this->db
                ->or_like('nome', $this->input->get('search'))
                ->or_like('acesso', $this->input->get('search'))
                ->or_like('observacao', $this->input->get('search'));
        }

        return $this->db->order_by('nome', 'ASC')->get(self::TABLENAME)->result();
    }

    /**
     * Método para retornar o usuário
     *
     * @param integer $id_usuario
     * @return void
     */
    public function find(int $id_usuario)
    {
        return $this->db->get_where(self::TABLENAME, array('id_usuario' => $id_usuario))->row();
    }

    /**
     * Inativa o usuário
     *
     * @param integer $id_usuario
     * @return void
     */
    public function inativar(int $id_usuario)
    {
        return $this->db->update(self::TABLENAME, array('inativo' => true), array('id_usuario' => $id_usuario));
    }

    /**
     * Ativa o usuário
     *
     * @param integer $id_usuario
     * @return void
     */
    public function ativar(int $id_usuario)
    {
        return $this->db->update(self::TABLENAME, array('inativo' => false), array('id_usuario' => $id_usuario));
    }

    /**
     * Valida os campos do usuário
     *
     * @param string $nome
     * @param string $acesso
     * @param string $senha
     * @param string $tipo_acesso
     * @param boolean $novo_usuario
     * @throws Exception
     * @return void
     */
    private function validar(string $nome, string $acesso, string $senha, string $tipo_acesso, bool $novo_usuario)
    {
        //Validações
        if (empty(trim($nome))) throw new Exception("O nome do usuário é obrigatório");
        if (empty(trim($acesso))) throw new Exception("O acesso do usuário é obrigatório");
        if (strlen(trim($senha)) < 3) throw new Exception("A senha do usuário deve conter 3 ou mais caracteres");
        if (empty(trim($tipo_acesso))) throw new Exception("O tipo de acesso do usuário é obrigatório");

        //Confere se o tipo de acesso passado for os configurados
        if (!in_array($tipo_acesso, array(self::ADMIN, self::BIBLIOTECARIO))) throw new Exception("Tipo de acesso inválido");

        //Verifia se já não existe usuário cadastrado com esse acesso
        if ($novo_usuario && !empty($this->buscar_usuario($acesso))) throw new Exception("Acesso já usado por outro usuário");
    }

    /**
     * Controla a permissão de entrada do usuário
     *
     * @param array $tipos_entrada
     * @return void
     */
    public static function permitir_entrada(array $tipos_entrada) : void
    {
        $_CI = get_instance();

        $session = (object)$_CI->session->userdata();

        if (!@isset($session->logado))
            redirect(base_url('login'));

        if (!in_array($session->tipo_acesso, $tipos_entrada))
            redirect(base_url('livros/listar'));
    }

    public static function logado() :bool
    {
        $CI =& get_instance();
        
        return @$CI->session->userdata('logado') === TRUE;
    }
}