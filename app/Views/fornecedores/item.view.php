<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <form action="<?= action(\Controllers\Fornecedores::class, 'update', 'POST') ?>" method="post">
            <div class="card card-primary">
                <div class="card-header cursor-pointer" data-card-widget="collapse">
                    <h3 class="card-title">Formulário de cadastro de fornecedores</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputNome">Nome da empresa</label>
                        <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Nome da empresa"
                            value="<?= value($nome) ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="inputNome">Nome do vendedor</label>
                        <input type="text" class="form-control" name="nome_vendedor" id="inputNomeVendedor" placeholder="Nome do vendedor"
                            value="<?= value($nome_vendedor) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-mail</label>
                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail"
                            value="<?= value($email) ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputTelefone">Telefone da empresa</label>
                        <input type="text" class="form-control" name="telefone_empresa" id="inputTelefone" placeholder="Telefone da empresa"
                            value="<?= value($telefone_empresa) ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputCelular">Celular do vendedor</label>
                        <input type="text" class="form-control" name="celular_vendedor" id="inputCelular" placeholder="Celular do vendedor"
                            value="<?= value($celular_vendedor) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="textDescricao">Descrição</label>
                        <textarea class="form-control" id="textDescricao" placeholder="Descrição da empresa"
                            name="descricao" ><?= value($descricao) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="selectFormas">Formas de Pagamentos</label>
                        <?php component(\Components\Select::class)
                            ->addAttr('class', 'form-control')
                            // ->addAttr('required', '')
                            ->addAttr('id', 'selectFormas')
                            ->addAttr('name', 'forma_pagamento')
                            ->setValue(value($forma_pagamento))
                            ->setPlaceholder('Selecione formas de pagamento')
                            ->addOption('Boleto', 'Boleto')
                            ->addOption('Cheque', 'Cheque')
                            ->addOption('Cartão de Crédito', 'Cartão de Crédito')
                            ->addOption('Cartão de Débito', 'Cartão de Débito')
                            ->addOption('Pix', 'Pix')
                            ->addOption('Dinheiro', 'Dinheiro')

                            ->show(); ?>
                    </div>
                    <div class="form-group">
                        <label for="inputCnpj">CNPJ da empresa</label>
                        <input type="text" class="form-control" name="cnpj_empresa" id="inputCnpj" placeholder="CNPJ da empresa"
                            value="<?= value($cnpj_empresa) ?>">
                    </div>
                    <input type="hidden" name="id" value="<?= value($id) ?>">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?= action(\Controllers\Fornecedores::class) ?>" class="btn btn-info"><i
                            class="fas fa-undo-alt"></i> Voltar</a>
                    <button type="reset" class="btn btn-warning"><i class="fas fa-eraser"></i> Limpar</button>
                    <?php if (isset($id)): ?>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmar-exclusao">
                            <i class="fas fa-trash"></i> Excluir</button>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                        Salvar</button>
                </div>
                <!-- /.card-footer-->
            </div>
        </form>
        <!-- /.card -->
    </div>
</div>
<?php if (isset($id)): ?>
    <div class="modal fade" id="confirmar-exclusao">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Confirmar Exclusão</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirma a exclusão do fornecedor <b>"
                            <?= $nome ?>" ?
                        </b></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="<?= action(\Controllers\Fornecedores::class, 'delete', 'POST') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="submit" class="btn btn-outline-danger">Excluir</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endif; ?>