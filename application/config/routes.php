<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Locacao_Controller/listar';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Login
$route['login'] = 'Login_Controller/login';
$route['sair'] = 'Login_Controller/sair';
$route['login/entrar'] = 'Login_Controller/entrar';

// Usuários
$route['usuarios/novo'] = 'Usuario_Controller/novo';
$route['usuarios/listar'] = 'Usuario_Controller/listar';
$route['usuarios/cadastrar'] = 'Usuario_Controller/cadastrar';
$route['usuarios/atualizar'] = 'Usuario_Controller/atualizar';
$route['usuarios/editar/(:num)'] = 'Usuario_Controller/editar/$1';
$route['usuarios/inativar/(:num)'] = 'Usuario_Controller/inativar/$1';
$route['usuarios/ativar/(:num)'] = 'Usuario_Controller/ativar/$1';

// Painel
$route['painel'] = 'Painel_Controller/inicial';

// Corredores
$route['corredores/novo'] = 'Corredor_Controller/novo';
$route['corredores/listar'] = 'Corredor_Controller/listar';
$route['corredores/cadastrar'] = 'Corredor_Controller/cadastrar';
$route['corredores/editar/(:num)'] = 'Corredor_Controller/editar/$1';
$route['corredores/atualizar'] = 'Corredor_Controller/atualizar';
$route['corredores/inativar/(:num)'] = 'Corredor_Controller/inativar/$1';
$route['corredores/ativar/(:num)'] = 'Corredor_Controller/ativar/$1';

// Livros
$route['livros/novo'] = 'Livro_Controller/novo';
$route['livros/cadastrar'] = 'Livro_Controller/cadastrar';
$route['livros/listar'] = 'Livro_Controller/listar';
$route['livros/editar/(:num)'] = 'Livro_Controller/editar/$1';
$route['livros/atualizar'] = 'Livro_Controller/atualizar';
$route['livros/listar/(:num)'] = 'Livro_Controller/listar';

// Exemplares
$route['exemplares/(:num)/listar'] = 'Exemplar_Controller/listar/$1';
$route['exemplares/(:num)/cadastrar'] = 'Exemplar_Controller/cadastrar/$1';
$route['exemplares/(:num)/status/(:num)/(:any)'] = 'Exemplar_Controller/alterar_status/$1/$2/$3';

// Pessoas
$route['pessoas/novo'] = 'Pessoa_Controller/novo';
$route['pessoas/cadastrar'] = 'Pessoa_Controller/cadastrar';
$route['pessoas/editar/(:num)'] = 'Pessoa_Controller/editar/$1';
$route['pessoas/atualizar'] = 'Pessoa_Controller/atualizar';
$route['pessoas/ativar/(:num)'] = 'Pessoa_Controller/ativar/$1';
$route['pessoas/inativar/(:num)'] = 'Pessoa_Controller/inativar/$1';
$route['pessoas/listar'] = 'Pessoa_Controller/listar';
$route['pessoas/listar/(:num)'] = 'Pessoa_Controller/listar/$1';

// Configurações
$route['configuracao/locacao'] = 'Configuracao_Controller/atualizar_configuracao_locacao';
$route['configuracao/ajustes'] = 'Configuracao_Controller/atualizar_configuracao_ajustes';

// Locação
$route['locacoes/nova'] = 'Locacao_Controller/nova';
$route['locacoes/locar'] = 'Locacao_Controller/locar';
$route['locacoes/encerrar/(:num)'] = 'Locacao_Controller/encerrar/$1';
$route['locacoes/excluir/(:num)'] = 'Locacao_Controller/excluir/$1';
$route['locacoes/listar'] = 'Locacao_Controller/listar';
$route['locacoes/listar/(:num)'] = 'Locacao_Controller/listar';

// Relatórios
$route['relatorios/painel'] = "Relatorio_Controller/index";
$route['relatorios/exemplares-disponiveis'] = "Relatorio_Controller/exemplares_disponiveis";