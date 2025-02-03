<?php

namespace Controllers;

use Components\ToastsAlert;
use Core\Controller;
use Core\Request;
use Core\View;
use Models\Cliente;
use Models\Atendimento;
use Models\Pedido;

class Clientes extends Controller
{
    public function index()
    {
        $view = new View('clientes.lista');
        $clientesModel = new Cliente();
        $clientes = $clientesModel->orderByAsc('nome')->all();

        // Buscar pedidos para cada cliente
        foreach ($clientes as $cliente) {
            $cliente->pedidos = $this->getPedidosByCliente($cliente->id);
        }

        $view->clientes = $clientes;
        $view->setTitle('Cadastro de Clientes')->show();
    }

    private function getPedidosByCliente($clienteId)
    {
        $atendimentoModel = new Atendimento();
        $atendimentos = $atendimentoModel->where('clientes_id', '=', $clienteId)->all();

        $pedidos = [];
        foreach ($atendimentos as $atendimento) {
            $pedidoModel = new Pedido();
            $pedidos = array_merge($pedidos, $pedidoModel->where('atendimentos_id', '=', $atendimento->id)->all());
        }

        return $pedidos;
    }

    public function disponivel(Request $request)
    {
        $cliente = new Cliente($request->id);
        $cliente->disponivel = !$cliente->disponivel;
        $cliente->save();
        ToastsAlert::addAlertSuccess('Cliente alterado com sucesso!');
        $this->redirect();
    }

    public function update(Request $request)
    {
        $cliente = new Cliente($request->id);
        $cliente->nome = $request->nome;
        $cliente->apelido = $request->apelido;
        $cliente->data_nascimento = $request->data_nascimento;
        $cliente->celular = $request->celular;
        $cliente->telefone = $request->telefone;
        $cliente->cpf = $request->cpf;
        $cliente->rg = $request->rg;
        $cliente->rg_expedidor = $request->rg_expedidor;
        $cliente->profissao = $request->fprofissao;
        $cliente->email = $request->email;
        $cliente->logradouro = $request->logradouro;
        $cliente->numero = $request->numero;
        $cliente->bairro = $request->bairro;
        $cliente->estado = $request->estado;
        $cliente->cep = $request->cep;
        $cliente->pais = $request->pais;
        $cliente->cidade = $request->cidade;
        $cliente->obs = $request->obs;

        $cliente->save();
        ToastsAlert::addAlertSuccess("{$cliente->nome} Salvo com Sucesso!");
        $this->redirect();
    }

    public function delete(Request $request)
    {
        $cliente = new Cliente($request->id);
        if($cliente->isStorage()){
            ToastsAlert::addAlertSuccess("{$cliente->nome} Excluido com Sucesso!");
            $cliente->delete();
            $this->redirect();
        }
        ToastsAlert::addAlertError("Cliente não encontrado!");
        $this->redirect();
    }

    public function novo()
    {
        $view = new View('clientes.item');
        $view->setTitle('Novo cliente')->show();
    }

    public function edit($id)
    {
        $cliente = new Cliente($id);
        if(!$cliente->isStorage()){
            ToastsAlert::addAlertError('Requisição inválida!');
            $this->redirect();
        }
        $view = new View('clientes.item');
        $view->setTitle("Cliente {$cliente->nome}")->show($cliente->getData());
    }
}