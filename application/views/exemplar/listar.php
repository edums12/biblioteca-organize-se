<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Exemplares</h1>
                <a href="#" data-toggle="modal" data-target="#modal-adicionar-exemplar" class="btn btn-primary">Adicionar exemplar</a>
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
                    <h3 class="mb-0">Exemplares do livro: <b><?= $livro->titulo ?></b></h3>
                </div>
                <div class="table-responsive">
                <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Código do exemplar</th>
                                <th scope="col">Adicionado em</th>
                                <th scope="col">status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($exemplares as $exemplar): ?>
                            <tr>
                                <th scope="row">
                                    <?= $exemplar->codigo ?>
                                </th>
                                <td>
                                    <?= date('d/m/Y \à\s H:i', strtotime($exemplar->criado_em)) ?>
                                </td>
                                <td>
                                    <?php switch($exemplar->status_exemplar){
                                        case Exemplar::STATUS_LIVRE:
                                            echo "<span class=\"badge badge-dot mr-4\"><i class=\"bg-success\"></i>". Exemplar::STATUS_LIVRE ."</span>";
                                            break;

                                        case Exemplar::STATUS_LOCADO:
                                            echo "<span class=\"badge badge-dot mr-4\"><i class=\"bg-warning\"></i>". Exemplar::STATUS_LOCADO ."</span>";
                                            break;

                                        case Exemplar::STATUS_PERDIDO:
                                            echo "<span class=\"badge badge-dot mr-4\"><i class=\"bg-danger\"></i>". Exemplar::STATUS_PERDIDO ."</span>";
                                            break;
                                    } ?>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?= base_url("exemplares/$livro->id_livro/status/$exemplar->id_exemplar/" . Exemplar::STATUS_LIVRE); ?>">
                                                <span class="badge badge-dot mr-4"><i class="bg-success"></i>Livre</span>
                                            </a>
                                            <a class="dropdown-item" href="<?= base_url("exemplares/$livro->id_livro/status/$exemplar->id_exemplar/" . Exemplar::STATUS_LOCADO); ?>">
                                                <span class="badge badge-dot mr-4"><i class="bg-warning"></i>Locado</span>
                                            </a>
                                            <a class="dropdown-item" href="<?= base_url("exemplares/$livro->id_livro/status/$exemplar->id_exemplar/" . Exemplar::STATUS_PERDIDO); ?>">
                                                <span class="badge badge-dot mr-4"><i class="bg-danger"></i>Perdido</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-red" href="<?= base_url("exemplares/$livro->id_livro/excluir/$exemplar->id_exemplar"); ?>">Excluir</a>
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

    <div class="modal fade" id="modal-adicionar-exemplar" tabindex="-1" role="dialog" aria-labelledby="modal-adicionar-exemplar" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">

                <form action="<?= base_url("exemplares/{$livro->id_livro}/cadastrar");?>" method="POST">

                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-default">Novo exemplar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group form-group-text">
                                    <label class="form-control-label" for="input-codigo">Código</label>
                                    <div class="row">
                                        <div class="col-sm-3 mr-0 pr-0"><span class="input-group-text"><?= $livro->codigo . "-" ?></span></div>
                                        <div class="col-sm-9 ml-0 pl-0"><input type="text" id="input-codigo" name="input-codigo" class="form-control form-control-alternative" required></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="select-status">Status</label>
                                    <select class="form-control form-control-alternative" name="select-status" id="select-status" required>
                                        <option value="<?= Exemplar::STATUS_LIVRE ?>" selected>Livre</option>
                                        <option value="<?= Exemplar::STATUS_LOCADO ?>">Locado</option>
                                        <option value="<?= Exemplar::STATUS_PERDIDO ?>">Perdido</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="textarea-observacao">Observação</label>
                                    <textarea rows="4" class="form-control form-control-alternative" name="textarea-observacao" id="textarea-observacao"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Adicionar">
                        <button id="fechar-modal" type="button" class="btn btn-link ml-auto" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>