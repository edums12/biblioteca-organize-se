<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Locações</h1>
                <a href="<?= base_url("locacoes/nova") ?>" class="btn btn-primary">Nova locação</a>
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
                    <h3 class="mb-0">Locações registradas</h3>
                </div>
                <div class="table-responsive">
                <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Pessoa</th>
                                <th scope="col">Livro</th>
                                <th scope="col">Cod. exemplar</th>
                                <th scope="col">Data da locação</th>
                                <th scope="col">Data prevista de entrega</th>
                                <th scope="col">Multa (R$)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($locacoes as $locacao): ?>
                            <tr>
                                <th scope="row">
                                    <?= $locacao->codigo_pessoa . " - " . $locacao->nome_pessoa ?>
                                </th>
                                <td>
                                    <?= $locacao->titulo_livro ?>
                                </td>
                                <td>
                                    <?= $locacao->codigo_exemplar ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($locacao->data_locacao)) ?>
                                </td>
                                <td class="<?= $locacao->multa > 0 ? "text-danger" : "" ?>">
                                    <?= date('d/m/Y', strtotime($locacao->data_planejada_entrega)) ?>
                                </td>
                                <td>
                                    <?= number_format($locacao->multa, 2, ',', '.')?>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?= base_url("locacoes/encerrar/$locacao->id_locacao"); ?>">Entregar</a>
                                            <!-- <a class="dropdown-item text-danger" href="<?= base_url("locacoes/encerrar/$locacao->id_locacao"); ?>">Excluir</a> -->
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