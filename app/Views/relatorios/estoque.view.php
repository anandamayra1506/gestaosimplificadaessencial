<div class="card">
    <div class="card-header">
        <h3 class="card-title">Relatório de Estoque</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade em Estoque</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estoque as $produto): ?>
                <tr>
                    <td><?= $produto->nome ?></td>
                    <td><?= $produto->quantidade ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

