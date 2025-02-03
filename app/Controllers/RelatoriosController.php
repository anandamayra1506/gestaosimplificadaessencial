<?php 

namespace Controllers;

use Core\Controller;
use Core\View;
use Models\Atendimento;
use Models\Pedido;
use Models\Produto;
use Models\Pagamento;
use Models\PagamentoTipo;

class RelatoriosController extends Controller
{
    public function vendas()
    {
        $atendimentos = new Atendimento();
        $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : 'total';

        // Filtragem por período
        $dataInicio = null;
        switch ($periodo) {
            case 'dia':
                $dataInicio = date('Y-m-d 00:00:00'); // Hoje
                break;
            case 'semana':
                $dataInicio = date('Y-m-d 00:00:00', strtotime('-7 days')); // Últimos 7 dias
                break;
            case 'mes':
                $dataInicio = date('Y-m-01 00:00:00'); // Primeiro dia do mês
                break;
            case 'ano':
                $dataInicio = date('Y-01-01 00:00:00'); // Primeiro dia do ano
                break;
        }

        if ($dataInicio) {
            $atendimentos->where('pagamento_data', '>=', $dataInicio);
        }

        // Buscar apenas atendimentos finalizados
        $vendas = $atendimentos->where('pagamento_data', 'is not', null)->all();

        $view = new View('relatorios/vendas');
        $view->vendas = $vendas;
        $view->setTitle('Relatório de Vendas')->show();
    }



    public function recebimentos()
    {
        $pagamentos = new Pagamento();
        $tiposPagamento = (new PagamentoTipo())->all();

        // Parâmetros do filtro
        $dataInicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : date('Y-m-d');
        $dataFim = isset($_GET['data_fim']) ? $_GET['data_fim'] : date('Y-m-d');
        $tipoPagamento = isset($_GET['tipo']) ? $_GET['tipo'] : 'todos';

        // Filtrar por data de recebimento
        if (!empty($dataInicio)) {
            $pagamentos->where('criacao_data', '>=', $dataInicio . ' 00:00:00');
        }
        if (!empty($dataFim)) {
            $pagamentos->where('criacao_data', '<=', $dataFim . ' 23:59:59');
        }

        // Filtrar por tipo de pagamento
        if ($tipoPagamento !== 'todos') {
            $pagamentos->where('pagamentos_tipos_id', '=', $tipoPagamento);
        }

        // Buscar todos os pagamentos dentro do período e com os filtros aplicados
        $recebimentos = $pagamentos->orderByAsc('criacao_data')->all();

        $view = new View('relatorios/recebimentos');
        $view->recebimentos = $recebimentos;
        $view->tiposPagamento = $tiposPagamento;
        $view->dataInicio = $dataInicio;
        $view->dataFim = $dataFim;
        $view->tipoPagamento = $tipoPagamento;
        $view->setTitle('Relatório de Recebimentos')->show();
    }

    public function estoque()
    {
        $produtos = new Produto();
        $estoque = $produtos->all();

        $view = new View('relatorios/estoque');
        $view->estoque = $estoque;
        $view->setTitle('Relatório de Estoque')->show();
    }

        public function produtos()
        {
            $pedidos = new Pedido();
            $produtosModel = new Produto();
    
            // Parâmetros do filtro
            $dataInicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] . ' 00:00:00' : null;
            $dataFim = isset($_GET['data_fim']) ? $_GET['data_fim'] . ' 23:59:59' : null;
            $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : 'total';
    
            // Se não tiver data personalizada, usa os filtros padrão
            if (!$dataInicio || !$dataFim) {
                switch ($periodo) {
                    case 'dia':
                        $dataInicio = date('Y-m-d 00:00:00');
                        $dataFim = date('Y-m-d 23:59:59');
                        break;
                    case 'semana':
                        $dataInicio = date('Y-m-d 00:00:00', strtotime('-7 days'));
                        $dataFim = date('Y-m-d 23:59:59');
                        break;
                    case 'mes':
                        $dataInicio = date('Y-m-01 00:00:00');
                        $dataFim = date('Y-m-t 23:59:59'); // Último dia do mês
                        break;
                    case 'ano':
                        $dataInicio = date('Y-01-01 00:00:00');
                        $dataFim = date('Y-12-31 23:59:59');
                        break;
                }
            }
    
            // Montar a consulta SQL para agrupar os produtos vendidos
            $sql = "SELECT produtos_id, SUM(quantidade) as total FROM pedidos WHERE 1=1";
            $params = [];
    
            if ($dataInicio) {
                $sql .= " AND criacao_data >= ?";
                $params[] = $dataInicio;
            }
            if ($dataFim) {
                $sql .= " AND criacao_data <= ?";
                $params[] = $dataFim;
            }
    
            $sql .= " GROUP BY produtos_id ORDER BY total DESC";
    
            // Executar a consulta
            $produtosVendidos = $pedidos->query($sql, $params);
    
            // Recuperar nomes dos produtos
            $produtos = [];
            foreach ($produtosVendidos as $p) {
                $produto = new Produto($p['produtos_id']);
                $produtos[] = [
                    'nome' => $produto->nome,
                    'total' => $p['total']
                ];
            }
    
            $view = new View('relatorios/produtos');
            $view->produtos = $produtos;
            $view->dataInicio = substr($dataInicio, 0, 10);
            $view->dataFim = substr($dataFim, 0, 10);
            $view->periodo = $periodo;
            $view->setTitle('Relatório de Produtos Mais e Menos Vendidos')->show();
        }
    }    

    