<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="display-2 text-white">Nova locação</h1>
                <p class="text-white mt-0 mb-5">Realize uma nova locação de um exemplar para uma pessoa.</p>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--8">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Locação</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('locacoes/locar')?>" method="POST">
                        <div class="row">
                            <div class="col-sm-12 col-lg-4">
                                <div class="list-scroll pessoas">
                                    <p>Clique sobre a pessoa para selecioná-la</p>
                                    <?php foreach($pessoas as $pessoa): ?>
                                        <a href="#" class="d-block list-group-item prateleira-item-select" data-id="<?= $pessoa->id_pessoa?>"><?= "{$pessoa->codigo} - {$pessoa->nome}"?>
                                        </a>
                                    <?php endforeach;?>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-4">
                                <div class="list-scroll livros">
                                    <p>Clique sobre o exemplar para selecioná-lo</p>
                                    <?php foreach($exemplares as $exemplar): ?>
                                        <a href="#" class="d-block list-group-item prateleira-item-select" data-id="<?= $exemplar->id_exemplar?>"><?= "{$exemplar->codigo} - {$exemplar->titulo}"?></a>
                                    <?php endforeach;?>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-4">
                                <input type="hidden" name="input-id-pessoa" id="input-id-pessoa" required>
                                <input type="hidden" name="input-id-exemplar" id="input-id-exemplar" required>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="form-control-label" for="input-data-locacao">Data da locação</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" id="input-data-locacao" name="input-data-locacao" placeholder="Data da locação" type="text" value="<?= date('m/d/Y') ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <label class="form-control-label" for="input-data-entrega">Data de entrega</label> <small><i>(Daqui a <?= $dias_configuracao?> dias)</i></small>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" id="input-data-entrega" name="input-data-entrega" placeholder="Data prevista de entrega" type="text" value="<?= $data_previsao_entrega?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="textarea-observacao">Observação</label>
                                            <textarea rows="4" class="form-control form-control-alternative" name="textarea-observacao" id="textarea-observacao"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3">
                            <input type="submit" class="btn btn-primary mt-4" value="Locar exemplar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $('.list-scroll.pessoas .list-group-item').on('click', (e) => {
       e.preventDefault()

       var target = $(e.currentTarget)

       $('.list-scroll.pessoas .list-group-item').map((index, it) => {
            let item = $(it)

            item.removeClass('active')
            
            var text = item.text();

            item.html(text.replace('<i class="fa fa-check text-success rigth"></i>', ''))
       })
       
       target.addClass('active')

       target.append('<i class="fa fa-check text-success rigth"></i>')

       $('input#input-id-pessoa').val(target.data('id'))
   })

   $('.list-scroll.livros .list-group-item').on('click', (e) => {
       e.preventDefault()

       var target = $(e.currentTarget)

       $('.list-scroll.livros .list-group-item').map((index, it) => {
            let item = $(it)

            item.removeClass('active')
            
            var text = item.text();

            item.html(text.replace('<i class="fa fa-check text-success rigth"></i>', ''))
       })
       
       target.addClass('active')

       target.append('<i class="fa fa-check text-success rigth"></i>')

       $('input#input-id-exemplar').val(target.data('id'))
   })
</script>