<div class="col-12">
        <!-- Default box -->
        <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Relatório de Produtos Mais e Menos Vendidos</h3>
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
                <label>Período Rápido:</label>
                <select name="periodo" class="form-control">
                    <option value="dia" <?= $periodo == 'dia' ? 'selected' : '' ?>>Hoje</option>
                    <option value="semana" <?= $periodo == 'semana' ? 'selected' : '' ?>>Última Semana</option>
                    <option value="mes" <?= $periodo == 'mes' ? 'selected' : '' ?>>Último Mês</option>
                    <option value="ano" <?= $periodo == 'ano' ? 'selected' : '' ?>>Último Ano</option>
                    <option value="total" <?= $periodo == 'total' ? 'selected' : '' ?>>Total</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
            </div>
        </form>

        <!-- Tabela de Produtos Vendidos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade Vendida</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($produtos) > 0): ?>
                    <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= $produto['nome'] ?></td>
                        <td><?= $produto['total'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center text-muted">Nenhuma venda encontrada para este período.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Gráfico -->
        <canvas id="graficoProdutos"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('graficoProdutos').getContext('2d');

    var chartData = {
        labels: [<?php foreach ($produtos as $produto) echo "'" . $produto['nome'] . "',"; ?>],
        datasets: [{
            label: 'Quantidade Vendida',
            data: [<?php foreach ($produtos as $produto) echo $produto['total'] . ","; ?>],
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
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
