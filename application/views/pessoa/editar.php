<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="display-2 text-white">Atualizar pessoa</h1>
                <p class="text-white mt-0 mb-5">Editar o cadastro de uma pessoa serve para atualizar as Informações de quem irá poder locar algum livro.</p>
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
                            <h3 class="mb-0">Pessoa: <?= $pessoa->nome?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('pessoas/atualizar')?>" method="POST">
                        <h6 class="heading-small text-muted mb-4">Informações</h6>
                        <div class="row">
                            <div class="col-lg-2 col-sm-12">
                                <input type="hidden" name="input-id" value="<?= $pessoa->id_pessoa?>">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-codigo">Código</label>
                                    <input type="text" id="input-codigo" name="input-codigo" class="form-control form-control-alternative" value="<?= $pessoa->codigo?>" readonly required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nome">Nome</label>
                                    <input type="text" id="input-nome" name="input-nome" class="form-control form-control-alternative" value="<?= $pessoa->nome?>" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="input-data-nascimento">Data de nascimento</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control datepicker" id="input-data-nascimento" name="input-data-nascimento" placeholder="Data de nascimento" type="text" value="<?= date('m/d/Y', strtotime($pessoa->data_nascimento))?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-telefone">Número de telefone</label>
                                    <input type="text" id="input-telefone" name="input-telefone" class="form-control form-control-alternative" value="<?= $pessoa->telefone?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">E-mail</label>
                                    <input type="email" id="input-email" name="input-email" class="form-control form-control-alternative" value="<?= $pessoa->email?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="textarea-observacao">Observação</label>
                                    <textarea rows="4" class="form-control form-control-alternative" name="textarea-observacao" id="textarea-observacao"><?= $pessoa->observacao?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- <h6 class="heading-small text-muted mt-2 mb-4">Campos adicionais</h6> -->
                        <div class="row pl-3">
                            <input type="submit" class="btn btn-primary mt-4" value="Atualizar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>