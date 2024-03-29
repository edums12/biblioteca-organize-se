<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Usuários</h1>
                <a href="<?= base_url("usuarios/novo") ?>" class="btn btn-primary">Cadastrar usuário</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <form method="GET">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-sm-12">
                                <h3 class="mb-0">Usuários cadastrados</h3>
                            </div>
                            <div class="col-lg-5 col-sm-12 offset-lg-4">
                                <div class="form-group mb-0">
                                    <input type="search" name="search" class="form-control form-control-alternative" placeholder="Pesquisar..." value="<?= $this->input->get('search')?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Acesso</th>
                                <th scope="col">Cadastrado em</th>
                                <th scope="col">Tipo de acesso</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $usuario): ?>
                            <tr>
                                <th scope="row">
                                    <?= $usuario->nome ?>
                                </th>
                                <td>
                                    <?= $usuario->acesso ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y \à\s H:i', strtotime($usuario->criado_em)) ?>
                                </td>
                                <td>
                                    <?= $usuario->tipo_acesso ?>
                                </td>
                                <td>
                                    <?= 
                                    $usuario->inativo 
                                        ? "<span class=\"badge badge-pill badge-danger text-uppercase\">Inativo</span>" 
                                        : "<span class=\"badge badge-pill badge-success text-uppercase\">Ativo</span>" 
                                    ?>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?= base_url("usuarios/editar/$usuario->id_usuario"); ?>">Editar</a>
                                            <?php if($usuario->inativo):?>
                                                <a class="dropdown-item text-green" href="<?= base_url("usuarios/ativar/$usuario->id_usuario"); ?>">Ativar</a>
                                            <?php else: ?>
                                                <a class="dropdown-item text-red" href="<?= base_url("usuarios/inativar/$usuario->id_usuario"); ?>">Inativar</a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="card-footer py-4">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">
                                    <i class="fas fa-angle-left"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="fas fa-angle-right"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div> -->
            </div>
        </div>
    </div>
</div>