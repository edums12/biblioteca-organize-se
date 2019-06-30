<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="">
            <img src="<?= base_url("assets/img/brand/blue.png") ?>" class="navbar-brand-img" alt="...">
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="">
                            <img src="<?= base_url("assets/img/brand/blue.png") ?>">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("locacoes/listar")?>">
                        <i class="ni ni-tag text-blue"></i> Locações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('livros/listar') ?>">
                        <i class="ni ni-books text-blue"></i> Livros e Exemplares
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('pessoas/listar') ?>">
                        <i class="ni ni-badge text-blue"></i> Pessoas
                    </a>
                </li>
                <?php if (in_array($this->session->userdata('tipo_acesso'), [Usuario::ADMIN])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('usuarios/listar') ?>">
                            <i class="ni ni-circle-08 text-blue"></i> Usuários
                        </a>
                    </li>
                <?php endif; ?>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="ni ni-single-copy-04 text-blue"></i> Relatórios
                    </a>
                </li> -->
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            
            <?php if (in_array($this->session->userdata('tipo_acesso'), [Usuario::ADMIN])): ?>
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Configurações</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-badge"></i> Pessoas
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-configuracao-locacoes">
                        <i class="ni ni-money-coins"></i> Locações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('corredores/listar') ?>">
                        <i class="fa fa-archive"></i> Corredores
                    </a>
                </li>
            </ul>
            <?php endif; ?>


            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('sair') ?>">
                        <i class="ni ni-button-power text-red"></i>Desconectar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content">

    <!-- Configuração de locações -->
    <div class="modal fade" id="modal-configuracao-locacoes" tabindex="-1" role="dialog" aria-labelledby="modal-configuracao-locacoes" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <form id="form-adicionar-categoria" method="POST" action="<?= base_url('configuracao/locacao')?>">
                    <?php $configLocacao = $this->Configuracao->get_config_locacao(); ?>

                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-default">Configurar locação</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label class="form-control-label" for="input-tempo-dias-locacao">Dias para a locação</label>
                                    <input type="number" id="input-tempo-dias-locacao" name="input-tempo-dias-locacao" class="form-control form-control-alternative" min="0" required value="<?= $configLocacao->dias_para_locacao?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label class="form-control-label" for="input-valor-multa-dia-atraso">Valor multa por dia de atraso</label>
                                    <input type="number" id="input-tempovalor-multa-dia-atraso" name="input-tempovalor-multa-dia-atraso" class="form-control form-control-alternative" min="0" step="0.01" required value="<?= $configLocacao->valor_multa_por_dia?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary right" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </div>