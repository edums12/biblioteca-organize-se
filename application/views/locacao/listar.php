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
                    <form method="GET">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-sm-12">
                                <h3 class="mb-0">Locações registradas</h3>
                                <small>Quantidade total de locações exibidas: <?= $total_registros ?></small>
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
                                <th scope="col">Pessoa</th>
                                <th scope="col">Exemplar</th>
                                <th scope="col">Data da locação</th>
                                <th scope="col">Data prevista de entrega</th>
                                <th scope="col">Dias restantes</th>
                                <th scope="col">Multa (R$)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($locacoes as $locacao) : ?>
                                <tr class="<?= $locacao->dias_restantes < 0 ? 'text-danger' : ''?>">
                                    <th scope="row">
                                        <?= $locacao->codigo_pessoa . " - " . $locacao->nome_pessoa ?>
                                    </th>
                                    <td>
                                        <?= "{$locacao->codigo_exemplar} {$locacao->titulo_livro}" ?>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($locacao->data_locacao)) ?>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($locacao->data_planejada_entrega)) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $locacao->dias_restantes ?>
                                    </td>
                                    <td>
                                        <?= number_format($locacao->multa, 2, ',', '.') ?>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <?php if ($locacao->multa > 0) : ?>
                                                    <a class="dropdown-item" data-id="<?= $locacao->id_locacao ?>" data-multa="<?= $locacao->multa ?>" data-toggle="modal" data-target="#modal-notification" href="#">Entregar</a>
                                                <?php else : ?>
                                                    <a class="dropdown-item" href="<?= base_url("locacoes/encerrar/$locacao->id_locacao"); ?>">Entregar</a>
                                                <?php endif; ?>
                                                <a href="<?= base_url("locacoes/excluir/$locacao->id_locacao"); ?>" class="dropdown-item text-red">Excluir</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (count($locacoes) == 0):?>
                                <tr>
                                    <td colspan="7">
                                        Nenhuma locação registrada.
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

<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
            <form method="POST">
                <input type="hidden" name="multa">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Sua atenção é requerida</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-money-coins ni-3x"></i>
                        <h1 class="text-white mb-4 valor-total"></h1>
                        <h4 class="heading mt-4">Essa locação possui multa</h4>
                        <p>Por favor, confirmar recebimento.</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-white" value="Ok, recebido">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('a[data-target="#modal-notification"]').click((e) => {
        let target = $(e.currentTarget)
        let modal = $('#modal-notification')
        let base_route = "<?= base_url("locacoes/encerrar/"); ?>"

        let action = base_route + target.data('id')
        let multa = target.data('multa')

        modal.find('form').attr('action', action)
        modal.find('.valor-total').html('R$ ' + multa.replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1."))
        modal.find('input[name=multa]').val(multa)
    })
</script>