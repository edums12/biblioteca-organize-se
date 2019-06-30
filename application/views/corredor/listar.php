<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Corredores</h1>
                <a href="<?= base_url("corredores/novo") ?>" class="btn btn-primary">Adicionar corredor</a>
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
                    <h3 class="mb-0">Corredores cadastrados</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Corredor</th>
                                <th scope="col">Adicionado em</th>
                                <th scope="col">Quant. de prateleiras</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($corredores) == 0): ?>
                            
                            <tr>
                                <td colspan="4">Nenhum corredor cadastrado.</td>
                            </tr>

                            <?php endif; ?>
                            
                            <?php foreach($corredores as $corredor): ?>
                            <tr>
                                <th scope="row">
                                    <?= $corredor->corredor ?>
                                </th>
                                <td>
                                    <?= date('d/m/Y \à\s H:i', strtotime($corredor->criado_em)) ?>
                                </td>
                                <td>
                                    <?= $corredor->quantidade_prateleiras ?>
                                </td>
                                <td>
                                    <?= 
                                    $corredor->inativo 
                                        ? "<span class=\"badge badge-dot mr-4\"><i class=\"bg-danger\"></i>Inativo</span>" 
                                        : "<span class=\"badge badge-dot mr-4\"><i class=\"bg-success\"></i> Ativo</span>" 
                                    ?>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?= base_url("corredores/editar/$corredor->id_corredor"); ?>">Editar</a>
                                            <?php if($corredor->inativo):?>
                                                <a class="dropdown-item text-green" href="<?= base_url("corredores/ativar/$corredor->id_corredor"); ?>">Ativar</a>
                                            <?php else: ?>
                                                <a class="dropdown-item text-red" href="<?= base_url("corredores/inativar/$corredor->id_corredor"); ?>">Inativar</a>
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