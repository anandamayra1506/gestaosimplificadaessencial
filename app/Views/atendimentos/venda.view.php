<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Resumo da Venda</h5>
                    </div>
                    <!-- DADOS DO CUPOM -->
                <div class="card-body bg-cupom">
                    <table class="printer-ticket" style="max-width:100%">
                        <tbody>
                            <?php
                            foreach ($atendimento->getPedidos() as $pedido): ?>
                                <tr class="top">
                                    <td colspan="2" class="font-weight-bold">
                                        <?= $pedido->getProduto()->nome . " (Cod. $pedido->produtos_id)"; ?>
                                    </td>
                                    <td class="text-right">
                                        <?= $pedido->date('criacao_data', 'H:i') ?>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="pb-2">
                                        <?= $pedido->money('valor_un') ?>
                                    </td>
                                    <td class="pb-2">
                                        <?= $pedido->quantidade ?>
                                    </td>
                                    <td class="pb-2">
                                        <?= $pedido->getSubTotal() ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- IMPRIMIR CUPOM -->
                <div class="card-footer text-center">
                    <button class="btn btn-secondary" onclick="window.print()"><i class="fas fa-print"></i> Imprimir Nota</button>
                </div>
            </div>
        </div>
        <!-- VENDA -->
        <div class="col-md-6 order-first order-md-last">
            <div class="row">
                   <!-- SELECIONAR CLIENTE -->
                   <div class="col-12">
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <?php component(\Components\Select::class)
                            ->addAttr('class', 'form-control')
                            ->addAttr('name', 'clientes_id')
                            ->addModel(model('Cliente')->orderByAsc('nome'), 'id', 'nome')
                            ->show(); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card text-white bg-info mb-3 ">
                        <div class="card-body text-center">
                            <div class="">
                                Total:
                            </div>
                            <h1 class="text-center"> R$
                                <?= number_format($atendimento->getValorTotal(), 2, ',', '.') ?>
                            </h1>
                        </div>
                        <div class="card-footer">
                            código
                            <?= $atendimento->id ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <a href="<?= action(\Controllers\Home::class) ?>" class="btn btn-warning btn-lg w-100 mb-2"> <i
                            class="fas fa-angle-left"></i> Voltar</a>
                    <a href="#" class="btn btn-success btn-lg w-100 mb-2" data-toggle="modal"
                        data-target="#registrar-pagamento"> <i class="fas fa-cash-register"></i> Registrar Pagamento</a>
                        <a href="#" class="btn btn-danger btn-lg w-100 mb-2" data-toggle="modal" data-target="#cancelar-venda"><i class="fas fa-ban"></i> Cancelar Venda</a>
                    <a href="#" class="btn btn-primary btn-lg w-100 mb-2" data-toggle="modal"
                        data-target="#finalizar-atendimento"> <i class="fas fa-handshake"></i> Finalizar Atendimento</a>
                </div>
                <!-- CAIXA DE PAGAMENTO -->
                <div class="col-12 order-first order-md-last">
                    <form
                        action="<?= action(\Controllers\Home::class, 'addPedido', 'POST', ['id' => $atendimento->id]) ?>"
                        method="POST">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="card-title">
                                    Adicionar Pedido
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="selectProdutos">Produto</label>
                                            <?php $produtosSelect->show() ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="inputQuantidade">Quantidade</label>
                                            <input type="number" name="quantidade" class="form-control"
                                                id="inputQunatidade" min="0.01" step="0.01" value="1">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="reset" class="btn btn-warning"><i class="fas fa-eraser"></i>
                                    Limpar</button>
                                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-plus"></i>
                                    Adicionar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12"> 
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <!-- <div class="card-title">
                                Pagamentos
                            </div> -->
                            <h5 class="mb-0">Pagamentos</h5>
                        </div>
                        <div class="card-body">
                            <?php if (count($atendimento->getPagamentos())): ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Hora</th>
                                            <th>Valor</th>
                                            <th>Tipo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($atendimento->getPagamentos() as $pagamento): ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $pagamento->date('criacao_data', 'H:i');
                                                    $obs = $pagamento->observacao;
                                                    if (!empty($obs)):
                                                        ?>
                                                        <i class="fas fa-info-circle text-info" title="<?= $obs ?>"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?= $pagamento->money('valor') ?>
                                                </td>
                                                <td>
                                                    <?= $pagamento->getPagamentoTipo()->descricao ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="text-center text-muted"> Sem registros de pagamento</div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Modal - Registrar Pagamento -->
    <div class="modal fade" id="registrar-pagamento">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= action(\Controllers\Home::class, 'addPagamento', 'POST', ['id' => $atendimento->id]) ?>" method="post">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title"><i class="fas fa-cash-register"></i> Registrar Pagamento</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 form-group">
                                <label>Total</label>
                                <input type="text" class="form-control" value="R$ <?= number_format($atendimento->getValorTotal(), 2, ',', '.') ?>" disabled>
                            </div>
                            <div class="col-6 form-group">
                                <label>Valor Pago</label>
                                <input type="number" name="valor" class="form-control" step="0.01" min="0.01" value="<?= round($atendimento->getValorTotal(), 2) ?>">
                            </div>
                            <div class="col-6 form-group">
                                <label>Troco</label>
                                <input type="text" class="form-control" id="troco" value="0,00" disabled>
                            </div>
                            <div class="col-6 form-group">
                                <label>Tipo de Pagamento</label>
                                <?php component(\Components\Select::class)
                                    ->addAttr('class', 'form-control')
                                    ->addAttr('name', 'pagamentos_tipos_id')
                                    ->addModel(model('PagamentoTipo')->orderByAsc('descricao'), 'id', 'descricao')
                                    ->show() ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 <!-- Modal - Cancelar Venda -->
 <div class="modal fade" id="cancelar-venda">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= action(\Controllers\Home::class) ?>" method="post">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title"><i class="fas fa-ban"></i> Cancelar Venda</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza de que deseja cancelar esta venda?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-danger">Sim, Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




<div class="modal fade" id="finalizar-atendimento">
    <div class="modal-dialog">
        <div class="modal-content">
            <form
                action="<?= action(\Controllers\Home::class, 'finalizarAtendimento', 'POST', ['id' => $atendimento->id]) ?>"
                method="post">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"> <i class="fas fa-handshake"></i> Finalizar Atendimento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php if ($atendimento->getValorTotal() > 0): ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>
                                Ao finalizar um atendiemnto que ainda possui saldo, você estará adicionando
                                um desconto a comanda do cliente.
                            </div>
                            <div class="col-12">
                                <div class="text-center">Confirma a finalização do Atendimento?</div>
                            </div>
                            <div class="col-12 text-danger text-center">
                                Valor do Desconto:<h5>
                                    R$ <?= number_format($atendimento->getValorTotal(), 2, ',', '.') ?>
                                </h5>
                                <input type="checkbox" required name="desconto"> Autorizo o desconto para o cliente.
                            </div>
                        <?php else: ?>
                            <div class="col">
                                <div class="text-center">Confirma a finalização do Atendimento?</div>
                            </div>
                        <?php endif ?>
                        <input type="hidden" name="desconto" value="<?= $atendimento->getValorTotal() ?>">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> <i
                            class="fas fa-undo-alt"></i> Cancelar</button>
                    <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-handshake"></i>
                        Finalizar</button>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>