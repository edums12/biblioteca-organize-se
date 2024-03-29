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
                            <div class="col-sm-12 col-lg-6">
                                <p>Clique sobre a pessoa para selecioná-la</p>
                                <div class="list-scroll pessoas">
                                    <input class="form-control" id="procurar-pessoa" placeholder="Código ou nome da pessoa" type="text">
                                    <br>
                                    <div class="pessoas-itens"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6">
                                <p>Clique sobre o exemplar para selecioná-lo</p>
                                <div class="list-scroll exemplares">
                                    <input class="form-control" id="procurar-exemplar" placeholder="Código ou título do exemplar" type="text">
                                    <br>
                                    <div class="exemplares-itens"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12 col-lg-12">
                                <input type="hidden" name="input-id-pessoa" id="input-id-pessoa" required>
                                <input type="hidden" name="input-id-exemplar" id="input-id-exemplar" required>

                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <label class="form-control-label" for="input-data-locacao">Data da locação</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" id="input-data-locacao" name="input-data-locacao" placeholder="Data da locação" type="text" value="<?= date('d/m/Y') ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-lg-6">
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
    var pessoas = <?= $pessoas?>;

    var exemplares = <?= $exemplares?>;

    var filtrarPessoas = (value) => {

        var lista = $('.list-scroll.pessoas .pessoas-itens');

        lista.html("")

        pessoas.filter(it => {
            if (value != null)
                return (it.codigo.toLowerCase().includes(value.toLowerCase()) || it.nome.toLowerCase().includes(value.toLowerCase()))
            else
                return true
        }).map(it => {
            let a = 
                $('<a>')
                    .addClass('d-block')
                    .addClass('list-group-item')
                    .addClass('prateleira-item-select')
                    .attr('data-pode-locar', it.pode_locar)
                    .attr('data-id', it.id_pessoa)
                    .attr('href', '#')
                    .text(`${it.codigo} - ${it.nome}`)

            if ($('input#input-id-pessoa').val() == it.id_pessoa)
                a.addClass('active').append('<i class="fa fa-check text-success rigth"></i>')

            lista.append(a);
        })
    }

    var filtrarExemplares = (value) => {

        var lista = $('.list-scroll.exemplares .exemplares-itens');

        lista.html("")

        exemplares.filter(it => {
            if (value != null)
                return (it.codigo.toLowerCase().includes(value.toLowerCase()) || it.titulo.toLowerCase().includes(value.toLowerCase()))
            else
                return true
        }).map(it => {
            let a = 
                $('<a>')
                    .addClass('d-block')
                    .addClass('list-group-item')
                    .addClass('prateleira-item-select')
                    .attr('data-id', it.id_exemplar)
                    .attr('href', '#')
                    .text(`${it.codigo} - ${it.titulo}`)

            if ($('input#input-id-exemplar').val() == it.id_exemplar)
                a.addClass('active').append('<i class="fa fa-check text-success rigth"></i>')

            lista.append(a);
        })
    }

    $(document).on('click', '.list-scroll.pessoas .list-group-item', (e) => {
        e.preventDefault()

        var target = $(e.currentTarget)

        var danger = $('.list-scroll.pessoas .list-group-item.inactive');
        danger.removeClass('inactive');
        danger.html(danger.text().replace('<i class="fa fa-exclamation text-danger rigth"></i>', ''));

        if (!target.data('pode-locar'))
        {
            target.addClass('inactive').append('<i class="fa fa-exclamation text-danger rigth"></i>')

            $('.alert.alert-danger').removeClass('hide');
            $('.alert.alert-danger').addClass('show');
            $('.alert.alert-danger .message').html("Locações excedidas para " + target.text());

            setTimeout(() => {
                $('.alert.alert-danger').addClass('hide');
            }, 8000);

            return false;
        }

        $('.list-scroll.pessoas .list-group-item').map((index, it) => {
            let item = $(it)

            item.removeClass('active')
            
            var text = item.text();

            item.html(text.replace('<i class="fa fa-check text-success rigth"></i>', ''))
        })
        
        target.addClass('active').append('<i class="fa fa-check text-success rigth"></i>')

        $('input#input-id-pessoa').val(target.data('id'))
    })

    $(document).on('click', '.list-scroll.exemplares .list-group-item', (e) => {
        e.preventDefault()

        var target = $(e.currentTarget)

        $('.list-scroll.exemplares .list-group-item').map((index, it) => {
            let item = $(it)

            item.removeClass('active')
            
            var text = item.text();

            item.html(text.replace('<i class="fa fa-check text-success rigth"></i>', ''))
        })
        
        target.addClass('active').append('<i class="fa fa-check text-success rigth"></i>')

        $('input#input-id-exemplar').val(target.data('id'))
    })

    $(document).ready(() => {
        filtrarPessoas(null)
        filtrarExemplares(null)
    })

    $('#procurar-pessoa').on('keyup', (e) => filtrarPessoas($(e.currentTarget).val()))
    $('#procurar-exemplar').on('keyup', (e) => filtrarExemplares($(e.currentTarget).val()))
</script>