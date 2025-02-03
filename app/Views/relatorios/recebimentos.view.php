

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Relatório de Recebimentos</h3>
    </div>
    <div class="card-body">

        <!-- Filtros -->
        <form method="GET" class="row mb-4">
            <div class="col-md-3">
                <label>Data Início:</label>
                <input type="date" name="data_inicio" class="form-control" value="<?= $dataInicio ?>">
            </div>
            <div class="col-md-3">
                <label>Data Fim:</label>
                <input type="date" name="data_fim" class="form-control" value="<?= $dataFim ?>">
            </div>
            <div class="col-md-3">
                <label>Tipo de Pagamento:</label>
                <select name="tipo" class="form-control">
                    <option value="todos" <?= $tipoPagamento == 'todos' ? 'selected' : '' ?>>Todos</option>
                    <?php foreach ($tiposPagamento as $tipo): ?>
                        <option value="<?= $tipo->id ?>" <?= $tipoPagamento == $tipo->id ? 'selected' : '' ?>>
                            <?= $tipo->descricao ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
            </div>
        </form>

        <!-- Tabela de Recebimentos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($recebimentos) > 0): ?>
                    <?php foreach ($recebimentos as $recebimento): ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($recebimento->criacao_data)) ?></td>
                        <td><?= $recebimento->getPagamentoTipo()->descricao ?></td>
                        <td>R$ <?= number_format($recebimento->valor, 2, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Nenhum recebimento encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Total de Recebimentos -->
        <?php 
            $totalRecebimentos = 0;
            foreach ($recebimentos as $recebimento) {
                $totalRecebimentos += $recebimento->valor;
            }
            ?>
            <h4 class="text-center mt-4">Total do Período: R$ <?= number_format($totalRecebimentos, 2, ',', '.') ?></h4>


        <!-- Gráfico -->
        <canvas id="graficoRecebimentos"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('graficoRecebimentos').getContext('2d');

    var chartData = {
        labels: [<?php foreach ($recebimentos as $recebimento) echo "'" . date('d/m', strtotime($recebimento->criacao_data)) . "',"; ?>],
        datasets: [{
            label: 'Recebimentos (R$)',
            data: [<?php foreach ($recebimentos as $recebimento) echo $recebimento->valor . ","; ?>],
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    var chartConfig = {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    };

    var myChart = new Chart(ctx, chartConfig);
</script>


