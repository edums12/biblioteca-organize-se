<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Relatório</h1>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--8">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow card-print-table">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <h3 class="mb-0 title-print-table">Exemplares disponíveis</h3>  
                        </div>
                        <div class="col-auto">
                            <a href="" class="text-primary print-table">
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="table-exemplares-disponiveis">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Título</th>
                                <th scope="col">Escritor</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Edição</th>
                                <th scope="col">Qtd. Disponível</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($relatorio as $dado) : ?>
                            <tr>
                                <th scope="row">
                                    <?= $dado->codigo ?>
                                </th>
                                <td><?= $dado->titulo ?></td>
                                <td><?= $dado->escritor ?></td>
                                <td><?= $dado->categoria ?></td>
                                <td><?= $dado->edicao ?></td>
                                <td class="text-center"><?= $dado->quantidade_disponivel ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>