<div class="login-page">
    <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b><?=APPLICATION_NAME?></b></a> 
        </div>
        <div class="card-body">
            <p class="text-center pb-2">Login</p>

        <form action="<?=action(Controllers\Usuarios\Login::class, 'logar', 'POST')?>" method="post">
            <div class="input-group my-3">
            <input type="text" name="cpf" class="form-control" placeholder="CPF">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Senha">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                    Lembre-me
                </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
            <!-- /.col -->
            </div>
        </form>

        <!-- <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
        </div>
        //social-auth-links -->

        <p class="mb-1">
            <a href="#">Esqueci minha senha</a>
        </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
</div>