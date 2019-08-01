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
                    <a class="nav-link <?= $this->uri->segment(1) == 'locacoes' ? 'active' : ''?>" href="<?= base_url("locacoes/listar")?>">
                        <i class="ni ni-tag text-blue"></i> Locações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'livros' ? 'active' : ''?>" href="<?= base_url('livros/listar') ?>">
                        <i class="ni ni-books text-blue"></i> Livros e Exemplares
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'pessoas' ? 'active' : ''?>" href="<?= base_url('pessoas/listar') ?>">
                        <i class="ni ni-badge text-blue"></i> Pessoas
                    </a>
                </li>
                <?php if (in_array($this->session->userdata('tipo_acesso'), [Usuario::ADMIN])) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(1) == 'usuarios' ? 'active' : ''?>" href="<?= base_url('usuarios/listar') ?>">
                            <i class="ni ni-circle-08 text-blue"></i> Usuários
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            
            <?php if (in_array($this->session->userdata('tipo_acesso'), [Usuario::ADMIN])): ?>
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Configurações</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-configuracao-locacoes">
                        <i class="ni ni-money-coins"></i> Locações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'corredores' ? 'active' : ''?>" href="<?= base_url('corredores/listar') ?>">
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

<?php $this->load->view('configuracoes/locacoes') ?>