<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Pessoas</h1>
                <a href="<?= base_url("pessoas/novo") ?>" class="btn btn-primary">Cadastrar pessoa</a>
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
                                <h3 class="mb-0">Pessoas cadastradas</h3>
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
                                <th scope="col">Código</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pessoas as $pessoa) : ?>
                                <tr>
                                    <th scope="row">
                                        <?= $pessoa->codigo ?>
                                    </th>
                                    <td>
                                        <?= $pessoa->nome ?>
                                    </td>
                                    <td>
                                        <?= $pessoa->telefone ?>
                                    </td>
                                    <td>
                                        <?=
                                            $pessoa->inativo
                                                ? "<span class=\"badge badge-dot mr-4\"><i class=\"bg-danger\"></i>Inativo</span>"
                                                : "<span class=\"badge badge-dot mr-4\"><i class=\"bg-success\"></i>Ativo</span>"
                                        ?>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="<?= base_url("pessoas/editar/$pessoa->id_pessoa"); ?>">Editar</a>
                                                <?php if ($pessoa->inativo) : ?>
                                                    <a class="dropdown-item text-green" href="<?= base_url("pessoas/ativar/$pessoa->id_pessoa"); ?>">Ativar</a>
                                                <?php else : ?>
                                                    <a class="dropdown-item text-red" href="<?= base_url("pessoas/inativar/$pessoa->id_pessoa"); ?>">Inativar</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (count($pessoas) == 0):?>
                                <tr>
                                    <td colspan="5">
                                        Nenhuma pessoa cadastrada.
                                    </td>
                                </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <?= $paginacao ?>
                </div>
            </div>
        </div>
    </div>
</div>