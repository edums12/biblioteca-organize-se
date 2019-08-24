<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="display-2 text-white">Cadastro de livros</h1>
                <p class="text-white mt-0 mb-5">O cadastro de livros serve para adicionar o livro aos dados do sistema.</p>
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
                            <h3 class="mb-0">Livro</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('livros/cadastrar') ?>" method="POST">
                        <h6 class="heading-small text-muted mb-4">Informações</h6>
                        <div class="row">
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-codigo">Código</label>
                                    <input type="text" id="input-codigo" name="input-codigo" class="form-control form-control-alternative" required value="<?= @Base::$flashdata['post']['input-codigo']?>">
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-titulo">Título</label>
                                    <input type="text" id="input-titulo" name="input-titulo" class="form-control form-control-alternative" required value="<?= @Base::$flashdata['post']['input-titulo']?>">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-isbn">ISBN</label>
                                    <input type="text" id="input-isbn" name="input-isbn" class="form-control form-control-alternative" value="<?= @Base::$flashdata['post']['input-isbn']?>">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-quantidade-exemplares">Qtd</label>
                                    <input type="number" id="input-quantidade-exemplares" name="input-quantidade-exemplares" class="form-control form-control-alternative" min="1" value="<?= @Base::$flashdata['post']['input-codigo'] or '1'?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group form-group-icon">
                                    <label class="form-control-label" for="input-escritor">Escritor</label>
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    <input type="text" id="input-escritor" name="input-escritor" class="form-control form-control-alternative" data-toggle="modal" data-target="#modal-escritor" readonly value="<?= @Base::$flashdata['post']['input-escritor']?>">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group form-group-icon">
                                    <label class="form-control-label" for="input-categoria">Categoria</label>
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    <input type="text" id="input-categoria" name="input-categoria" class="form-control form-control-alternative" data-toggle="modal" data-target="#modal-categoria" value="<?= @Base::$flashdata['post']['input-categoria']?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group form-group-icon">
                                    <label class="form-control-label" for="input-prateleira">Prateleira</label>
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    <input type="text" id="input-prateleira" name="input-prateleira" class="form-control form-control-alternative" data-toggle="modal" data-target="#modal-prateleira" value="<?= @Base::$flashdata['post']['input-prateleira']?>" readonly required>
                                    <input type="hidden" name="input-id-prateleira" id="input-id-prateleira" value="<?= @Base::$flashdata['post']['input-id-prateleira']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-edicao">Edição</label>
                                    <input type="text" id="input-edicao" name="input-edicao" class="form-control form-control-alternative" value="<?= @Base::$flashdata['post']['input-edicao']?>">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-numero-paginas">Nº de páginas</label>
                                    <input type="number" id="input-numero-paginas" name="input-numero-paginas" class="form-control form-control-alternative" value="<?= @Base::$flashdata['post']['input-numero-paginas']?>">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-ano">Ano</label>
                                    <input type="number" id="input-ano" name="input-ano" class="form-control form-control-alternative" minlength="4" maxlength="4" value="<?= @Base::$flashdata['post']['input-ano']?>">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-uf">UF</label>
                                    <select class="form-control form-control-alternative" name="input-uf" id="input-uf">
                                        <option value="">Selecione o estado</option>
                                        <option value="AC" <?= @Base::$flashdata['post']['input-uf'] == 'AC' ? 'selected' : ''?>>AC - Acre</option>
                                        <option value="AL" <?= @Base::$flashdata['post']['input-uf'] == 'AL' ? 'selected' : ''?>>AL - Alagoas</option>
                                        <option value="AP" <?= @Base::$flashdata['post']['input-uf'] == 'AP' ? 'selected' : ''?>>AP - Amapá</option>
                                        <option value="AM" <?= @Base::$flashdata['post']['input-uf'] == 'AM' ? 'selected' : ''?>>AM - Amazonas</option>
                                        <option value="BA" <?= @Base::$flashdata['post']['input-uf'] == 'BA' ? 'selected' : ''?>>BA - Bahia</option>
                                        <option value="CE" <?= @Base::$flashdata['post']['input-uf'] == 'CE' ? 'selected' : ''?>>CE - Ceará</option>
                                        <option value="DF" <?= @Base::$flashdata['post']['input-uf'] == 'DF' ? 'selected' : ''?>>DF - Distrito Federal</option>
                                        <option value="ES" <?= @Base::$flashdata['post']['input-uf'] == 'ES' ? 'selected' : ''?>>ES - Espirito Santo</option>
                                        <option value="GO" <?= @Base::$flashdata['post']['input-uf'] == 'GO' ? 'selected' : ''?>>GO - Goiás</option>
                                        <option value="MA" <?= @Base::$flashdata['post']['input-uf'] == 'MA' ? 'selected' : ''?>>MA - Maranhão</option>
                                        <option value="MS" <?= @Base::$flashdata['post']['input-uf'] == 'MS' ? 'selected' : ''?>>MS - Mato Grosso do Sul</option>
                                        <option value="MT" <?= @Base::$flashdata['post']['input-uf'] == 'MT' ? 'selected' : ''?>>MT - Mato Grosso</option>
                                        <option value="MG" <?= @Base::$flashdata['post']['input-uf'] == 'MG' ? 'selected' : ''?>>MG - Minas Gerais</option>
                                        <option value="PA" <?= @Base::$flashdata['post']['input-uf'] == 'PA' ? 'selected' : ''?>>PA - Pará</option>
                                        <option value="PB" <?= @Base::$flashdata['post']['input-uf'] == 'PB' ? 'selected' : ''?>>PB - Paraíba</option>
                                        <option value="PR" <?= @Base::$flashdata['post']['input-uf'] == 'PR' ? 'selected' : ''?>>PR - Paraná</option>
                                        <option value="PE" <?= @Base::$flashdata['post']['input-uf'] == 'PE' ? 'selected' : ''?>>PE - Pernambuco</option>
                                        <option value="PI" <?= @Base::$flashdata['post']['input-uf'] == 'PI' ? 'selected' : ''?>>PI - Piauí</option>
                                        <option value="RJ" <?= @Base::$flashdata['post']['input-uf'] == 'RJ' ? 'selected' : ''?>>RJ - Rio de Janeiro</option>
                                        <option value="RN" <?= @Base::$flashdata['post']['input-uf'] == 'RN' ? 'selected' : ''?>>RN - Rio Grande do Norte</option>
                                        <option value="RS" <?= @Base::$flashdata['post']['input-uf'] == 'RS' ? 'selected' : ''?>>RS - Rio Grande do Sul</option>
                                        <option value="RO" <?= @Base::$flashdata['post']['input-uf'] == 'RO' ? 'selected' : ''?>>RO - Rondônia</option>
                                        <option value="RR" <?= @Base::$flashdata['post']['input-uf'] == 'RR' ? 'selected' : ''?>>RR - Roraima</option>
                                        <option value="SC" <?= @Base::$flashdata['post']['input-uf'] == 'SC' ? 'selected' : ''?>>SC - Santa Catarina</option>
                                        <option value="SP" <?= @Base::$flashdata['post']['input-uf'] == 'SP' ? 'selected' : ''?>>SP - São Paulo</option>
                                        <option value="SE" <?= @Base::$flashdata['post']['input-uf'] == 'SE' ? 'selected' : ''?>>SE - Sergipe</option>
                                        <option value="TO" <?= @Base::$flashdata['post']['input-uf'] == 'TO' ? 'selected' : ''?>>TO - Tocantins</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="textarea-observacao">Observação</label>
                                    <textarea rows="4" class="form-control form-control-alternative" name="textarea-observacao" id="textarea-observacao"><?= @Base::$flashdata['post']['textarea-observacao']?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3">
                            <input type="submit" class="btn btn-primary mt-4" value="Cadastrar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PRATELEIRA -->
<div class="modal fade" id="modal-prateleira" tabindex="-1" role="dialog" aria-labelledby="modal-prateleira" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-default">Prateleiras</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body pt-0">
                <p>Clique sobre a prateleira para adicioná-la</p>
                <div class="list-scroll list-scroll-md prateleiras">
                    <input class="form-control" id="procurar-prateleiras" placeholder="Prateleiras" type="text">
                    <br>
                    <div class="prateleira-itens"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- CATEGORIA -->
<div class="modal fade" id="modal-categoria" tabindex="-1" role="dialog" aria-labelledby="modal-categoria" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-default">Categorias</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body pt-0">
                <p>Clique sobre a categoria para adicioná-la</p>
                <div class="list-scroll list-scroll-md categorias">
                    <input class="form-control" id="procurar-categorias" placeholder="Categoria" type="text">
                    <br>
                    <div class="categoria-itens"></div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="" class="btn btn-link limpar-categorias"><i class="fa fa-times" aria-hidden="true"></i> Limpar</a>
                <button type="button" class="btn btn-link ml-auto" data-toggle="modal" data-target="#modal-adicionar-categoria"><i class="fa fa-plus" aria-hidden="true"></i> Nova categoria</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-adicionar-categoria" tabindex="-1" role="dialog" aria-labelledby="modal-adicionar-categoria" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-adicionar-categoria" method="POST" action="">

                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Nova categoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="form-control-label" for="input-adicionar-nova-categoria">Categoria</label>
                                <input type="text" id="input-adicionar-nova-categoria" class="form-control form-control-alternative" required>
                                <small class="danger text-danger mt-1"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Adicionar">
                    <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ESCRITOR -->
<div class="modal fade" id="modal-escritor" tabindex="-1" role="dialog" aria-labelledby="modal-escritor" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-default">Escritores</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body pt-0">
                <p>Clique sobre o escritor para adicioná-lo</p>
                <div class="list-scroll list-scroll-md escritores">
                    <input class="form-control" id="procurar-escritores" placeholder="Escritor" type="text">
                    <br>
                    <div class="escritor-itens"></div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="" class="btn btn-link limpar-escritores"><i class="fa fa-times" aria-hidden="true"></i> Limpar</a>
                <button type="button" class="btn btn-link ml-auto" data-toggle="modal" data-target="#modal-adicionar-escritor"><i class="fa fa-plus" aria-hidden="true"></i> Novo escritor</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-adicionar-escritor" tabindex="-1" role="dialog" aria-labelledby="modal-adicionar-escritor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-adicionar-escritor" method="POST" action="">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Novo escritor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="form-control-label" for="input-adicionar-novo-escritor">Escritor</label>
                                <input type="text" id="input-adicionar-novo-escritor" class="form-control form-control-alternative" required>
                                <small class="danger text-danger mt-1"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Adicionar">
                    <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var categorias = <?= $categorias ?>;

    var escritores = <?= $escritores ?>;

    var prateleiras = <?= $prateleiras ?>;

    $(() => {
        $('form#form-adicionar-categoria').submit((e) => {
            e.preventDefault()

            let form = $('form#form-adicionar-categoria')
            let modalCategoria = $('#modal-categoria')
            let modalNovaCategoria = $('#modal-adicionar-categoria')

            let input = form.find('#input-adicionar-nova-categoria')

            modalCategoria.find('.modal-body').append(
                `<a href="#" class="d-block list-group-item categoria-item-select">
                    ${input.val()}
                </a>`)

            $('#input-categoria').val(input.val())

            input.val('')

            modalNovaCategoria.modal('hide')
            modalCategoria.modal('hide')
        })

        $('form#form-adicionar-escritor').submit((e) => {
            e.preventDefault()

            let form = $('form#form-adicionar-escritor')
            let modalEscritor = $('#modal-escritor')
            let modalNovoEscritor = $('#modal-adicionar-escritor')

            let input = form.find('#input-adicionar-novo-escritor')

            modalEscritor.find('.modal-body').append(
                `<a href="#" class="d-block list-group-item escritor-item-select">
                    ${input.val()}
                </a>`)

            $('#input-escritor').val(input.val())

            input.val('')

            modalNovoEscritor.modal('hide')
            modalEscritor.modal('hide')
        })

        $('.limpar-escritores').click(function(e) {
            e.preventDefault()
            
            $('#input-escritor').val('')
            $('#modal-escritor').modal('hide')
        })

        $('.limpar-categorias').click(function(e) {
            e.preventDefault()
            
            $('#input-categoria').val('')
            $('#modal-categoria').modal('hide')
        })

        filtrarPrateleiras(null)
        filtrarCategorias(null)
        filtrarEscritores(null)
    })

    $(document).on('click', '.categoria-item-select', (e) => {
        e.preventDefault()

        let target = $(e.currentTarget)
        let modal = $('#modal-categoria')
        let input = $('#input-categoria')

        let categoria = target.text().trim()

        input.val(categoria)

        modal.modal('hide')
    })

    $(document).on('click', '.escritor-item-select', (e) => {
        e.preventDefault()

        let target = $(e.currentTarget)
        let modal = $('#modal-escritor')
        let input = $('#input-escritor')

        let escritor = target.text().trim()

        input.val(escritor)

        modal.modal('hide')
    })

    $(document).on('click', '.prateleira-item-select', (e) => {
        e.preventDefault()

        let target = $(e.currentTarget)
        let modal = $('#modal-prateleira')
        let input = $('#input-prateleira')
        let inputId = $('#input-id-prateleira')

        let id = target.data('id')
        let prateleira = target.text().trim()

        input.val(prateleira)
        inputId.val(target.data('id'))

        modal.modal('hide')
    })

    var filtrarCategorias = (value) => {
        var lista = $('.list-scroll.categorias .categoria-itens');

        lista.html("")

        categorias.filter(it => {
            if (value != null)
                return (it.categoria.toLowerCase().includes(value.toLowerCase()))
            else
                return true
        }).map(it => {
            let a =
                $('<a>')
                .addClass('d-block')
                .addClass('list-group-item')
                .addClass('categoria-item-select')
                .attr('data-id', it.id_categoria)
                .attr('href', '#')
                .text(it.categoria)

            lista.append(a);
        })
    }

    var filtrarEscritores = (value) => {
        var lista = $('.list-scroll.escritores .escritor-itens');

        lista.html("")

        escritores.filter(it => {
            if (value != null)
                return (it.nome.toLowerCase().includes(value.toLowerCase()))
            else
                return true
        }).map(it => {
            let a =
                $('<a>')
                .addClass('d-block')
                .addClass('list-group-item')
                .addClass('escritor-item-select')
                .attr('data-id', it.id_escritor)
                .attr('href', '#')
                .text(it.nome)

            lista.append(a);
        })
    }

    var filtrarPrateleiras = (value) => {
        var lista = $('.list-scroll.prateleiras .prateleira-itens');

        lista.html("")

        prateleiras.filter(it => {
            if (value != null)
                return (it.prateleira.toLowerCase().includes(value.toLowerCase()) || it.corredor.toLowerCase().includes(value.toLowerCase()))
            else
                return true
        }).map(it => {
            let a =
                $('<a>')
                .addClass('d-block')
                .addClass('list-group-item')
                .addClass('prateleira-item-select')
                .attr('data-id', it.id_prateleira)
                .attr('href', '#')
                .text(`${it.corredor} - ${it.prateleira}`)

            lista.append(a);
        })
    }

    $('#procurar-categorias').on('keyup', (e) => filtrarCategorias($(e.currentTarget).val()))
    $('#procurar-escritores').on('keyup', (e) => filtrarEscritores($(e.currentTarget).val()))
    $('#procurar-prateleiras').on('keyup', (e) => filtrarPrateleiras($(e.currentTarget).val()))
</script>