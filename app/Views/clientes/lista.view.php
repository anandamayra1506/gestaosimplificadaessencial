<!-- filepath: /c:/xampp/htdocs/teste/app/Views/clientes/lista.view.php -->
<div class="row">
    <div class="col-12 py-2">
        <a href="<?= action(\Controllers\Clientes::class, 'novo') ?>" class="btn btn-primary float-right">Novo</a>
    </div>

    <div class="col-12">
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Lista de Clientes Cadastrados</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Apelido</th>
                            <th>Data Nascimento</th>
                            <th>Cel.</th>
                            <th>Tel.</th>
                            <th>CPF</th>
                            <th>RG</th>
                            <th>RG Expedidor</th>
                            <th>Profissão</th>
                            <th>E-mail</th>
                            <th>Endereço</th>
                            <th>Observação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?= $cliente->nome ?></td>
                                <td><?= $cliente->apelido ?></td>
                                <td><?= $cliente->data_nascimento ?></td>
                                <td><?= $cliente->celular ?></td>
                                <td><?= $cliente->telefone ?></td>
                                <td><?= $cliente->cpf ?></td>
                                <td><?= $cliente->rg ?></td>
                                <td><?= $cliente->rg_expedidor ?></td>
                                <td><?= $cliente->profissao ?></td>
                                <td><?= $cliente->email ?></td>
                                <td><?= $cliente->logradouro ?>
                                    <?= $cliente->numero ?>
                                    <?= $cliente->bairro ?>
                                    <?= $cliente->cidade ?>
                                    <?= $cliente->estado ?>
                                    <?= $cliente->cep ?>
                                    <?= $cliente->pais ?>
                                </td>
                                <td><?= $cliente->obs ?></td>

                                <td>
                                    <a href="<?= action(\Controllers\Clientes::class, 'edit', 'GET', ['id' => $cliente->id]) ?>"
                                        class="btn text-primary"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn text-danger" data-toggle="modal"
                                        data-target="#confirmar-exclusao-<?= $cliente->id ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <div class="modal fade" id="confirmar-exclusao-<?= $cliente->id ?>">
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
                                                    <p>Confirma a exclusão do cliente <b>"<?= $cliente->nome ?>" ?</b></p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <form
                                                        action="<?= action(\Controllers\Clientes::class, 'delete', 'POST') ?>"
                                                        method="post">
                                                        <input type="hidden" name="id" value="<?= $cliente->id ?>">
                                                        <button type="submit"
                                                            class="btn btn-outline-danger">Excluir</button>
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