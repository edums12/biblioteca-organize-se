<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Cadastro de usuário</h1>
                <p class="text-white mt-0 mb-5">O cadastro do usuário é para adicionar uma nova pessoa para controlar o sistema.</p>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--8">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Usuário</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('usuarios/cadastrar')?>" method="POST">
                        <h6 class="heading-small text-muted mb-4">Informações</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nome">Nome</label>
                                    <input type="text" id="input-nome" name="input-nome" class="form-control form-control-alternative" required value="<?= @Base::$flashdata['post']['input-nome']?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-usuario">Usuário de acesso</label>
                                    <input type="text" id="input-usuario" name="input-usuario" class="form-control form-control-alternative" required minlength="3" value="<?= @Base::$flashdata['post']['input-usuario']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-senha">Senha</label>
                                    <input type="password" id="input-senha" name="input-senha" class="form-control form-control-alternative" minlength="4" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-confirmar-senha">Confirme a senha</label>
                                    <input type="password" id="input-confirmar-senha" name="input-confirmar-senha" class="form-control form-control-alternative" minlength="4" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-control-label">Tipo de acesso</label>
                                <div class="custom-control custom-control-alternative custom-radio">
                                    <input class="custom-control-input" id="acesso-administrador" name="input-radio-acesso" type="radio" value="1" <?= @Base::$flashdata['post']['input-radio-acesso'] == '1' ? 'checked' : ''?>>
                                    <label class="custom-control-label" for="acesso-administrador" required>
                                        <span class="text-muted">Administrador</span>
                                    </label>
                                </div>
                                <div class="custom-control custom-control-alternative custom-radio mt-2">
                                    <input class="custom-control-input" id="acesso-bibliotecario" name="input-radio-acesso" type="radio" value="2" <?= @Base::$flashdata['post']['input-radio-acesso'] == '2' ? 'checked' : ''?>>
                                    <label class="custom-control-label" for="acesso-bibliotecario" required>
                                        <span class="text-muted">Bibliotecário</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="textarea-observacao">Observação</label>
                                    <textarea rows="4" class="form-control form-control-alternative" name="textarea-observacao" id="textarea-observacao"><?= @Base::$flashdata['post']['textarea-observacao']?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3">
                            <input type="submit" class="btn btn-primary mt-4" value="Cadastrar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>