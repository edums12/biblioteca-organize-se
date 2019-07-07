 <?php
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para controle do corredor
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Corredor extends CI_Model
{
    const TABLENAME = "corredor";

    /**
     * Tabela do banco de dados:
     *  id_corredor
     *  corredor
     *  criado_em
     *  inativo
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Prateleira');
    }

    /**
     * Método para cadastrar novo corredor
     *
     * @param string $corredor
     * @param array $prateleiras
     * @return integer
     */
    public function cadastrar(string $corredor, array $prateleiras) :int
    {
        $corredor_banco_dados = $this->db->get_where(self::TABLENAME, ['corredor' => $corredor])->row();

        if (empty($corredor_banco_dados))
        {
            $this->db->insert(
                self::TABLENAME, 
                ['corredor' => $corredor]
            );

            $id_corredor =  $this->db->insert_id();
        }
        else
        {
            $id_corredor = $corredor_banco_dados->id_corredor;
        }

        if (count($prateleiras) > 0)
        {
            foreach ($prateleiras as $prateleira)
            {
                $this->adicionar_prateleira($id_corredor, $prateleira);
            }
        }

        return $id_corredor;
    }

    /**
     * Método para retornar todos os corredores da biblioteca
     *
     * @return void
     */
    public function get()
    {
        return
        $this->db
             ->select('
                corredor.id_corredor,
                corredor.corredor,
                corredor.criado_em,
                corredor.inativo,

                count(prateleira.id_prateleira) AS quantidade_prateleiras
             ')
             ->from(self::TABLENAME)
             ->join(Prateleira::TABLENAME, 'id_corredor', 'left')
             ->group_by('corredor.id_corredor, corredor.corredor, corredor.criado_em')
             ->order_by('corredor.corredor', 'ASC')
             ->get()
             ->result();
    }

    public function find(int $id_corredor)
    {
        return
        $this->db
             ->select('
                 corredor.id_corredor,
                 corredor.corredor,
                 corredor.criado_em,
                 corredor.inativo,
 
                 json_agg(prateleira.*) as prateleiras
             ')
             ->from(self::TABLENAME)
             ->join(Prateleira::TABLENAME, 'id_corredor', 'left')
             ->where('id_corredor', $id_corredor)
             ->group_by('corredor.id_corredor, corredor.corredor, corredor.criado_em')
             ->order_by('corredor.corredor', 'ASC')
             ->get()
             ->row();
    }

    public function atualizar(int $id_corredor, string $corredor, $prateleiras) :void
    {
        $this->db->update(self::TABLENAME, ['corredor' => $corredor], ['id_corredor' => $id_corredor]);

        foreach ($prateleiras as $prateleira)
        {
            $this->Prateleira->cadastrar_ou_buscar($id_corredor, $prateleira);
        }
    }

    /**
     * Método para adicinar prateleira para aquele corredor
     *
     * @param integer $id_corredor
     * @param string $prateleira
     * @return integer
     */
    public function adicionar_prateleira(int $id_corredor, string $prateleira) :int
    {
        return $this->Prateleira->cadastrar($id_corredor, $prateleira);
    }

    /**
     * Inativa o corredor
     *
     * @param integer $id_corredor
     * @return void
     */
    public function inativar(int $id_corredor)
    {
        return $this->db->update(self::TABLENAME, array('inativo' => true), array('id_corredor' => $id_corredor));
    }

    /**
     * Ativa o corredor
     *
     * @param integer $id_corredor
     * @return void
     */
    public function ativar(int $id_corredor)
    {
        return $this->db->update(self::TABLENAME, array('inativo' => false), array('id_corredor' => $id_corredor));
    }
}