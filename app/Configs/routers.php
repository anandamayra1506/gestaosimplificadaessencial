<?php

use Core\Router;


//rotas do sistema;
Router::get("/", Controllers\Home::class)->addMiddleware('auth');
Router::get("/404", Controllers\ErrorController::class, 'page404');
Router::get("/500", Controllers\ErrorController::class, 'page500');
Router::get('/login', Controllers\Usuarios\Login::class)->addMiddleware('noAuth');
Router::get('/logout', Controllers\Usuarios\Login::class, 'logout')->addMiddleware('auth');
Router::post('/login', Controllers\Usuarios\Login::class, 'logar')->addMiddleware('noAuth');


Router::get('/perfil', Controllers\Usuarios\Perfil::class)->addMiddleware('auth');
Router::post('/perfil', Controllers\Usuarios\Perfil::class, 'update')->addMiddleware('auth');
Router::post('/perfil/alterarsenha', Controllers\Usuarios\Perfil::class, 'changePassword')->addMiddleware('auth');


//rotas de usuário
Router::get('/usuarios/novo', \Controllers\Usuarios\Cadastro::class);
Router::post('/usuarios/novo', \Controllers\Usuarios\Cadastro::class, 'save');
Router::post('/usuarios/buscar', \Controllers\Usuarios\Cadastro::class, 'find');



//rotas do negocio
////rotas produtos
Router::get("/produtos", Controllers\Produtos::class)->addMiddleware('auth');
Router::post('/produtos/disponivel', Controllers\Produtos::class, 'disponivel')->addMiddleware('auth');
Router::get("/produtos/novo", Controllers\Produtos::class, 'novo')->addMiddleware('auth');
Router::get('/produto/{id}', Controllers\Produtos::class, 'edit')->addMiddleware('auth');
Router::post('/produto', Controllers\Produtos::class, 'update')->addMiddleware('auth');
Router::post('/produto/delete', Controllers\Produtos::class, 'delete')->addMiddleware('auth');

//rotas atendimento
Router::get('/venda/{venda}', Controllers\Home::class, 'atendimento');
Router::post('/atendimento/{id}/pedido', Controllers\Home::class, 'addPedido');
Router::post('/atendimento/{id}/pagamento', Controllers\Home::class, 'addPagamento');
Router::post('/atendimento/{id}/finalizar', Controllers\Home::class, 'finalizarAtendimento');


//ROTAS FORNECEDORES
Router::get("/fornecedores", Controllers\Fornecedores::class)->addMiddleware('auth');
Router::post('/fornecedores/disponivel', Controllers\Fornecedores::class, 'disponivel')->addMiddleware('auth');
Router::get("/fornecedores/novo", Controllers\Fornecedores::class, 'novo')->addMiddleware('auth');
Router::get('/fornecedor/{id}', Controllers\Fornecedores::class, 'edit')->addMiddleware('auth');
Router::post('/fornecedor', Controllers\Fornecedores::class, 'update')->addMiddleware('auth');
Router::post('/fornecedor/delete', Controllers\Fornecedores::class, 'delete')->addMiddleware('auth');

//ROTAS CLIENTES
Router::get("/clientes", Controllers\Clientes::class)->addMiddleware('auth');
Router::post('/clientes/disponivel', Controllers\Clientes::class, 'disponivel')->addMiddleware('auth');
Router::get("/clientes/novo", Controllers\Clientes::class, 'novo')->addMiddleware('auth');
Router::get('/cliente/{id}', Controllers\Clientes::class, 'edit')->addMiddleware('auth');
Router::post('/cliente', Controllers\Clientes::class, 'update')->addMiddleware('auth');
Router::post('/cliente/delete', Controllers\Clientes::class, 'delete')->addMiddleware('auth');

// Rotas para relatórios
Router::get('/relatorios/vendas', Controllers\RelatoriosController::class, 'vendas')->addMiddleware('auth');
Router::get('/relatorios/recebimentos', Controllers\RelatoriosController::class, 'recebimentos')->addMiddleware('auth');

// Router::get('/relatorios/contas', Controllers\RelatoriosController::class, 'contas')->addMiddleware('auth');
Router::get('/relatorios/estoque', Controllers\RelatoriosController::class, 'estoque')->addMiddleware('auth');
Router::get('/relatorios/produtos', Controllers\RelatoriosController::class, 'produtos')->addMiddleware('auth');
