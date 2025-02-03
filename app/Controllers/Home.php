<?php

namespace Controllers;

use Components\ToastsAlert;
use Core\Controller;
use Core\Request;
use Core\View;
use Models\Atendimento;
use Models\Pedido;
use Models\Produto;

class Home extends Controller
{
    public function index()
    {
        $atendimento = new Atendimento();
        $atendimento->where('pagamento_data', 'is', null);
        $vendas = [];
        foreach($atendimento->all() as $registro){
            $vendas[$registro->venda] = $registro;
        }
        $view = new View('home');
        $view->vendas = $vendas;
        $view->setTitle('Vendas')->show();
    }

    public function atendimento($venda)
    {
        $atendimento = new Atendimento();
        $atendimento->where('venda','=',$venda)->where('pagamento_data', 'is', null);
        $atendimento = $atendimento->get();
        if($atendimento == false){
            if($venda<1 || $venda > N_VENDAS){
                ToastsAlert::addAlertError('Requisição Inválida');
                $this->redirect();
            }
            $atendimento = new Atendimento();
        }
        $atendimento->venda = $venda;
        $atendimento->save();
        $select  = new \Components\Select();
        $select->addAttr('class', 'form-control')->addAttr('name', 'produtos_id');
        $produtos = new Produto();
        $produtos->where('disponivel','=','1')->orderByAsc('nome');
        foreach($produtos->all() as $produto){
            $select->addOption($produto->id, $produto->nome . " " . $produto->money('valor_un'));
        }
        $view = new View('atendimentos.venda');
        $view->atendimento = new Atendimento($atendimento->id);
        $view->produtosSelect = $select;
        $view->setTitle("Venda $venda")->show();
    }

    public function addPedido($id, Request $request)
    {
        $atendimento = new Atendimento($id);
        $atendimento->addPedido($request->produtos_id, $request->quantidade);
        ToastsAlert::addAlertSuccess("Pedido Adicionado com sucesso!");
        $this->redirect('atendimento', 'GET', ['Venda' => $atendimento->venda]);
    }

    public function addPagamento($id, Request $request)
    {
        $atendimento = new Atendimento($id);
        $atendimento->addPagamento($request->pagamentos_tipos_id, $request->valor, $request->observacao);
        ToastsAlert::addAlertSuccess("Pagamento adicionado com sucesso!");
        $this->redirect('atendimento', 'GET', ['Venda' => $atendimento->venda]);
    }

    public function finalizarAtendimento($id, Request $request)
    {
        $atendimento = new Atendimento($id);
        $atendimento->clientes_id = $request->clientes_id; // Adicione o ID do cliente aqui
        $atendimento->valor_desconto = $request->desconto;
        $atendimento->pagamento_data = date('Y-m-d H:i:s');

        $atendimento->save();
        if($atendimento->valor_desconto>0){
            ToastsAlert::addAlertInfo("Desconto cadastro no valor de R$".number_format($atendimento->valor_desconto,'2',',','.')."!");
        }
        ToastsAlert::addAlertSuccess("Atendimento finalizado!");
        $this->redirect();
    }
}