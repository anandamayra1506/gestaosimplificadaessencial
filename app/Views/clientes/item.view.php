<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <form action="<?= action(\Controllers\Clientes::class, 'update', 'POST') ?>" method="post">
            <div class="card card-primary">
                <div class="card-header cursor-pointer" data-card-widget="collapse">
                    <h3 class="card-title">Formulário de cadastro de clientes</h3>
                </div>
                <div class="card-body row">
                    <div class="form-group col-md-5">
                        <label for="inputNome">Nome</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Nome do cliente"
                            value="<?= value($nome) ?>" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputNome">Apelido</label>
                        <input type="text" class="form-control" name="apelido" id="inputApelido" placeholder="Apelido"
                            value="<?= value($apelido) ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputDataNasc">Data de Nascimento</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" name="data_nascimento" id="inputDataNasc"
                            placeholder="AAAA/MM/DD" value="<?= value($data_nascimento) ?>" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputCelular">Celular do cliente</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" name="celular" id="inputCelular"
                            placeholder="Celular do cliente" value="<?= value($celular) ?>" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputTelefone">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="inputTelefone"
                            placeholder="Telefone do cliente" value="<?= value($telefone) ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputCPF">
                            CPF
                        </label>
                        <input type="text" name="cpf" class="form-control" placeholder="CPF" id="inputCPF"
                            value="<?= value($cpf) ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputRG">
                            RG
                        </label>
                        <input type="text" name="rg" class="form-control" placeholder="RG" id="inputRG"
                            value="<?= value($rg) ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputRG_Expedidor">
                            RG Expedidor
                        </label>
                        <input type="text" name="rg_expedidor" class="form-control" placeholder="Ex: SSP/SP"
                            id="inputRG_Expedidor" value="<?= value($rg_expedidor) ?>">
                    </div>


                    <div class="form-group col-md-5">
                        <label for="inputProfissao">Profissão</label>
                        <input type="text" class="form-control" name="profissao" id="inputProfissao"
                            placeholder="Profissão" value="<?= value($profissao) ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail">
                            E-mail
                        </label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" id="inputEmail"
                            value="<?= value($email) ?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="textLogradouro">Logradouro</label><span class="text-danger">*</span>
                        <input class="form-control" id="textLogradouro" placeholder="Logradouro" name="logradouro"
                            <?= value($logradouro) ?> required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="textNumero">Número</label><span class="text-danger">*</span>
                        <input class="form-control" id="textNumero" placeholder="Número" name="numero" <?= value($numero) ?> required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="textbairro">Bairro</label>
                        <input class="form-control" id="textBairro" placeholder="Bairro" name="bairro" <?= value($bairro) ?>>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="textCidade">Cidade</label>
                        <input class="form-control" id="textCidade" placeholder="Cidade" name="cidade" <?= value($cidade) ?>>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="textEstado">Estado</label>
                        <input class="form-control" id="textEstado" placeholder="MG" name="estado" <?= value($estado) ?>>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="textCep">CEP</label>
                        <input class="form-control" id="textCep" placeholder="CEP" name="cep" <?= value($cep) ?>>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="textPais">País</label>
                        <input class="form-control" id="textPais" placeholder="País" name="pais" <?= value($pais) ?>>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="textObs">Observação</label>
                        <textarea class="form-control" id="textObs" placeholder="Observação"
                            name="obs"><?= value($obs) ?></textarea>
                    </div>

                    <input type="hidden" name="id" value="<?= value($id) ?>">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?= action(\Controllers\Clientes::class) ?>" class="btn btn-info"><i
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
                    <p>Confirma a exclusão do cliente <b>"
                            <?= $nome ?>" ?
                        </b></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="<?= action(\Controllers\Clientes::class, 'delete', 'POST') ?>" method="post">
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