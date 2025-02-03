<?php

namespace Controllers;

use Components\ToastsAlert;
use Core\Controller;
use Core\Request;
use Core\View;
use Models\Fornecedor;

class Fornecedores extends Controller
{
    public function index()
    {
        $view = new View('fornecedores.lista');
        $fornecedoresModel = new Fornecedor();
        $view->fornecedores = $fornecedoresModel->orderByAsc('nome')->all();
        $view->setTitle('Cadastro de Fornecedores')->show();

    }
    public function disponivel(Request $request)
    {
        $fornecedor = new Fornecedor($request->id);
        $fornecedor->disponivel = !$fornecedor->disponivel;
        $fornecedor->save();
        ToastsAlert::addAlertSuccess('Fornecedor alterado com sucesso!');
        $this->redirect();
    }

    /**
     * Altera registro da base de dados recebendo as requisições de um formulário
     * @param \Core\Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $fornecedor = new Fornecedor($request->id);
        $fornecedor->nome = $request->nome;
        $fornecedor->nome_vendedor = $request->nome_vendedor;
        $fornecedor->email = $request->email;
        $fornecedor->telefone_empresa = $request->telefone_empresa;
        $fornecedor->celular_vendedor = $request->celular_vendedor;
        $fornecedor->descricao = $request->descricao;
        $fornecedor->forma_pagamento = $request->forma_pagamento;
        $fornecedor->cnpj_empresa = $request->cnpj_empresa;
        $fornecedor->save();
        ToastsAlert::addAlertSuccess("{$fornecedor->nome} Salvo com Sucesso!");
        $this->redirect();
    }

    public function delete(Request $request)
    {
        $fornecedor = new Fornecedor($request->id);
        if($fornecedor->isStorage()){
            ToastsAlert::addAlertSuccess("{$fornecedor->nome} Excluido com Sucesso!");
            $fornecedor->delete();
            $this->redirect();
        }
        ToastsAlert::addAlertError("Fornecedor não encontrado!");
        $this->redirect();
    }

    /**
     * Abre a tela de criação de um novo registro
     * @return void
     */
    public function novo()
    {
        $view = new View('fornecedores.item');
        $view->setTitle('Novo fornecedor')->show();
    }
    /**
     * Carrega os dados da base e passa para a view para edição.
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
        $fornecedor = new Fornecedor($id);
        if(!$fornecedor->isStorage()){
            ToastsAlert::addAlertError('Requisição inválida!');
            $this->redirect();
        }
        $view = new View('fornecedores.item');
        $view->setTitle("Fornecedor {$fornecedor->nome}")->show($fornecedor->getData());
    }

}