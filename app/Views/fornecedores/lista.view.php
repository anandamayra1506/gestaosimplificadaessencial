<div class="row">
    <div class="col-12 py-2">
        <a href="<?= action(\Controllers\Fornecedores::class, 'novo') ?>" class="btn btn-primary float-right">Novo</a>
    </div>
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Lista de Fornecedores Cadastrados</h3>
            </div>
            <div class="card-body">
                <table class="table w-100 table-striped">
                    <thead>
                        <tr>
                            <th title="Nome da Empresa">Empresa</th>
                            <th title="Nome do Vendedor">Vendedor</th>
                            <th>E-mail</th>
                            <th title="Telefone da Empresa">Tel.</th>
                            <th title="Celular do Vendedor">Celular</th>
                            <th>Descrição</th>
                            <th>Formas de Pagamentos</th>
                            <th title="CNPJ da Empresa">CNPJ</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fornecedores as $fornecedor): ?>
                            <tr>
                                <td>
                                    <?= $fornecedor->nome ?>
                                </td>
                                <td>
                                    <?= $fornecedor->nome_vendedor ?>
                                </td>
                                <td>
                                    <?= $fornecedor->email ?>
                                </td>
                                <td>
                                    <?= $fornecedor->telefone_empresa ?>
                                </td>
                                <td>
                                    <?= $fornecedor->celular_vendedor ?>
                                </td>
                                <td>
                                    <?= $fornecedor->descricao ?>
                                </td>
                                <td>
                                    <?= $fornecedor->forma_pagamento ?>
                                </td>
                                <td>
                                    <?= $fornecedor->cnpj_empresa ?>
                                </td>
                               
                                <td>
                                    <a href="<?= action(\Controllers\Fornecedores::class, 'edit', 'GET', ['id' => $fornecedor->id]) ?>"
                                        class="btn text-primary"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn text-danger" data-toggle="modal"
                                        data-target="#confirmar-exclusao-<?= $fornecedor->id ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <div class="modal fade" id="confirmar-exclusao-<?= $fornecedor->id ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h4 class="modal-title">Confirmar Exclusão</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Confirma a exclusão do fornecedor <b>"<?= $fornecedor->nome ?>" ?</b></p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <form action="<?= action(\Controllers\Fornecedores::class, 'delete', 'POST') ?>"
                                                        method="post">
                                                        <input type="hidden" name="id" value="<?=$fornecedor->id?>">
                                                        <button type="submit" class="btn btn-outline-danger">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>