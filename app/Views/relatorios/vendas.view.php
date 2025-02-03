<div class="col-12">
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
        <h3 class="card-title">Relatório de Vendas</h3>
        <div class="float-right">
            <label for="filtroPeriodo">Selecionar Período:</label>
            <select id="filtroPeriodo" class="form-control">
                <option value="dia">Hoje</option>
                <option value="semana">Última Semana</option>
                <option value="mes">Último Mês</option>
                <option value="ano">Último Ano</option>
                <option value="total" selected>Total</option>
            </select>

            <label for="tipoGrafico">Tipo de Gráfico:</label>
            <select id="tipoGrafico" class="form-control">
                <option value="bar" selected>Barras</option>
                <option value="line">Linha</option>
                <option value="pie">Pizza</option>
                <option value="doughnut">Rosquinha</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <canvas id="graficoVendas"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('filtroPeriodo').addEventListener('change', function() {
        let periodo = this.value;
        window.location.href = '?periodo=' + periodo;
    });

    document.getElementById('tipoGrafico').addEventListener('change', function() {
    myChart.destroy(); // Remove o gráfico anterior
    chartConfig.type = this.value; // Atualiza o tipo
    myChart = new Chart(ctx, chartConfig); // Recria o gráfico
    });


    var ctx = document.getElementById('graficoVendas').getContext('2d');

    var chartData = {
        labels: [<?php foreach ($vendas as $venda) echo "'" . date('d/m', strtotime($venda->pagamento_data)) . "',"; ?>],
        datasets: [{
            label: 'Vendas',
            data: [<?php foreach ($vendas as $venda) echo $venda->getValorTotal() . ","; ?>],
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

