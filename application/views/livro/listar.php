<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Livros</h1>
                <a href="<?= base_url("livros/novo") ?>" class="btn btn-primary">Cadastrar livro</a>
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
                            <div class="col-lg-4 col-sm-12">
                                <h3 class="mb-0"> Livros cadastrados</h3>
                                <small>Quantidade total de livros exibidos: <?= $total_registros ?></small>
                            </div>
                            <div class="col-lg-5 col-sm-12 offset-lg-3">
                                <div class="form-group mb-0">
                                    <input type="search" name="search" class="form-control form-control-alternative" placeholder="Pesquisar..." value="<?= $this->input->get('search') ?>">
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
                                <th scope="col">Título</th>
                                <th scope="col">Qtd</th>
                                <th scope="col">Escritor</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Corredor - Prateleira</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($livros as $livro) : ?>
                            <tr>
                                <th scope="row">
                                    <?= $livro->codigo ?>
                                </th>
                                <td>
                                    <?= $livro->titulo ?>
                                </td>
                                <td>
                                    <?= $livro->qtd_exemplares ?>
                                </td>
                                <td>
                                    <?= $livro->escritor ?>
                                </td>
                                <td>
                                    <?= $livro->categoria ?>
                                </td>
                                <td>
                                    <?= $livro->corredor_prateleira ?>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?= base_url("exemplares/$livro->id_livro/listar"); ?>">Exemplares</a>
                                            <a class="dropdown-item" href="<?= base_url("livros/editar/$livro->id_livro"); ?>">Editar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (count($livros) == 0) : ?>
                            <tr>
                                <td colspan="7">
                                    Nenhum livro cadastrado.
                                </td>
                            </tr>
                            <?php endif; ?>
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