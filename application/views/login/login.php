<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="separator separator-bottom separator-skew zindex-100">
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <img src="<?= base_url("assets/img/brand/blue.png") ?>" height="50" class="mb-2" />
                            <p class="mt-3">Entre com seu usuário e senha</p>
                        </div>
                        <form role="form" method="POST" action="<?= base_url('login/entrar') ?>">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>
                                    <input class="form-control" name="acesso" placeholder="Usuário" type="" minlength="3" required autocorrect="off" autocapitalize="none" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="senha" placeholder="Senha" type="password" minlength="3" required autocorrect="off" autocapitalize="none">
                                </div>
                            </div>
                            <!-- <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span class="text-muted">Mantenha-me conectado</span>
                                </label>
                            </div> -->
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary mt-4" value="Entrar" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>