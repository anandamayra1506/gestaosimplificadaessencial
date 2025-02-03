<div class="container-fluid">
    <div class="row">
        <?php for ($venda = 1; $venda <= N_VENDAS; $venda++):
            $status = (array_key_exists($venda, $vendas)) ? 'ocupada' : 'livre';    
        ?>
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2" >
                <!-- Default box -->
                <div class="card card-outline card-<?=($status == 'livre')?'danger':'success'?> text-center">
                    <div class="card-body">
                        <h3 class="text-align">CAIXA <?php echo $venda ?></h3>
                        <img src="<?= assets("images/mesas/$status.png") ?>">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="<?= action(\Controllers\Home::class,'atendimento','GET',['venda'=>$venda])?>" class="btn btn-primary"><i class="fas fa-bars"></i></a>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
        <?php endfor; ?>
    </div>
</div>