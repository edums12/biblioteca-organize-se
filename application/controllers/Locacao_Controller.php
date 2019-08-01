<?php

defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Controller de locações
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Locacao_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        Usuario::permitir_entrada([Usuario::ADMIN, Usuario::BIBLIOTECARIO]);

        $this->load->model('Locacao');
        $this->load->model('Exemplar');
        $this->load->model('Livro');
        $this->load->model('Pessoa');
        $this->load->model('Configuracao');
    }

    public function listar()
    {
        $paginacao = Base::configuracao_paginacao('locacoes/listar', 3);

        $result = $this->Locacao->get($paginacao);

        $data['locacoes'] = $result['result'];

        $paginacao['total_rows'] = $result['total_rows'];

        $this->pagination->initialize($paginacao);
        
        $data['paginacao'] = $this->pagination->create_links();

        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('locacao/listar', $data);
        $this->load->view('include/footer');
    }

    public function nova()
    {
        $data['pessoas'] = json_encode($this->Locacao->carregar_pessoas());
        $data['exemplares'] = json_encode($this->Exemplar->listar_exemplares_para_locar());

        $config = $this->Configuracao->get_config_locacao();

        $data['dias_configuracao'] = $config->dias_para_locacao;
        $data['data_previsao_entrega'] = date('d/m/Y', strtotime("now + {$config->dias_para_locacao} days"));

        $this->load->view('include/header');
        $this->load->view('include/navbar');
        $this->load->view('locacao/nova', $data);
        $this->load->view('include/footer');
    }

    public function locar()
    {
        try 
        {
            $id_pessoa = intval($this->input->post('input-id-pessoa'));
            $id_exemplar = intval($this->input->post('input-id-exemplar'));
            $data_locacao = $this->input->post('input-data-locacao');
            $data_entrega = $this->input->post('input-data-entrega');
            $observacao = $this->input->post('textarea-observacao');

            $this->Locacao->cadastrar($id_exemplar, $id_pessoa, $data_locacao, $data_entrega, $observacao);

            $this->session->set_flashdata('success', 'Locação realizada com sucesso');
            redirect(base_url('locacoes/listar'));
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect(base_url('locacoes/nova'));
        }

    }

    public function encerrar(int $id)
    {
        try 
        {
            $multa = $this->input->post('multa') ?? 0;

            $this->Locacao->encerrar($id, date('Y-m-d', strtotime('now')), $multa);
            
            $this->session->set_flashdata('success', 'locação finalizada');
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        finally
        {
            redirect(base_url('locacoes/listar'));
        }
    }

    public function excluir(int $id)
    {
        try 
        {
            $this->Locacao->excluir($id);
            
            $this->session->set_flashdata('success', 'locação excluída');
        }
        catch (Exception $e)
        {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        finally
        {
            redirect(base_url('locacoes/listar'));
        }
    }
}