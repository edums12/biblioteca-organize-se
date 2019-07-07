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
                    <h3 class="mb-0">Livros cadastrados</h3>
                </div>
                <div class="table-responsive">
                <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Título</th>
                                <th scope="col">Qtd. Exemplares</th>
                                <th scope="col">Escritor</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Corredor - Prateleira</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($livros as $livro): ?>
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