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
                    <form action="<?= base_url('livros/cadastrar')?>" method="POST">
                        <h6 class="heading-small text-muted mb-4">Informações</h6>
                        <div class="row">
                            <div class="col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-codigo">Código</label>
                                    <input type="text" id="input-codigo" name="input-codigo" class="form-control form-control-alternative" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-titulo">Título</label>
                                    <input type="text" id="input-titulo" name="input-titulo" class="form-control form-control-alternative" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-isbn">ISBN</label>
                                    <input type="text" id="input-isbn" name="input-isbn" class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group form-group-icon">
                                    <label class="form-control-label" for="input-escritor">Escritor</label>
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    <input type="text" id="input-escritor" name="input-escritor" class="form-control form-control-alternative" data-toggle="modal" data-target="#modal-escritor" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group form-group-icon">
                                    <label class="form-control-label" for="input-categoria">Categoria</label>
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    <input type="text" id="input-categoria" name="input-categoria" class="form-control form-control-alternative" data-toggle="modal" data-target="#modal-categoria" value="" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group form-group-icon">
                                    <label class="form-control-label" for="input-prateleira">Prateleira</label>
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    <input type="text" id="input-prateleira" name="input-prateleira" class="form-control form-control-alternative" data-toggle="modal" data-target="#modal-prateleira" value="" readonly required>
                                    <input type="hidden" name="input-id-prateleira" id="input-id-prateleira">
                                </div>
                            </div>
                        </div>
                        <div class="row">        
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-edicao">Edição</label>
                                    <input type="text" id="input-edicao" name="input-edicao" class="form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-numero-paginas">Nº de páginas</label>
                                    <input type="number" id="input-numero-paginas" name="input-numero-paginas" class="form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-ano">Ano</label>
                                    <input type="number" id="input-ano" name="input-ano" class="form-control form-control-alternative" minlength="4" maxlength="4">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-uf">UF</label>
                                    <select class="form-control form-control-alternative" name="input-uf" id="input-uf">
                                        <option value="">Selecione o estado</option>
                                        <option value="AC">AC - Acre</option>
                                        <option value="AL">AL - Alagoas</option>
                                        <option value="AP">AP - Amapá</option>
                                        <option value="AM">AM - Amazonas</option>
                                        <option value="BA">BA - Bahia</option>
                                        <option value="CE">CE - Ceará</option>
                                        <option value="DF">DF - Distrito Federal</option>
                                        <option value="ES">ES - Espirito Santo</option>
                                        <option value="GO">GO - Goiás</option>
                                        <option value="MA">MA - Maranhão</option>
                                        <option value="MS">MS - Mato Grosso do Sul</option>
                                        <option value="MT">MT - Mato Grosso</option>
                                        <option value="MG">MG - Minas Gerais</option>
                                        <option value="PA">PA - Pará</option>
                                        <option value="PB">PB - Paraíba</option>
                                        <option value="PR">PR - Paraná</option>
                                        <option value="PE">PE - Pernambuco</option>
                                        <option value="PI">PI - Piauí</option>
                                        <option value="RJ">RJ - Rio de Janeiro</option>
                                        <option value="RN">RN - Rio Grande do Norte</option>
                                        <option value="RS">RS - Rio Grande do Sul</option>
                                        <option value="RO">RO - Rondônia</option>
                                        <option value="RR">RR - Roraima</option>
                                        <option value="SC">SC - Santa Catarina</option>
                                        <option value="SP">SP - São Paulo</option>
                                        <option value="SE">SE - Sergipe</option>
                                        <option value="TO">TO - Tocantins</option>
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
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
        	
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-default">Prateleiras</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body pt-0">
                <p>Clique sobre a prateleira para adicioná-la</p>
                <?php foreach($prateleiras as $prateleira): ?>
                <a href="#" class="d-block list-group-item prateleira-item-select" data-id="<?= $prateleira->id_prateleira?>">
                    <?= $prateleira->corredor . ' - ' . $prateleira->prateleira?>
                </a>
                <?php endforeach; ?>
            </div>
            
        </div>
    </div>
</div>

<!-- CATEGORIA -->
<div class="modal fade" id="modal-categoria" tabindex="-1" role="dialog" aria-labelledby="modal-categoria" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
        	
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-default">Categorias</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body pt-0">
                <?php if(count($categorias) > 0): ?>
                    <p>Clique sobre a categoria para adicioná-la</p>
                    <?php foreach($categorias as $categoria): ?>
                    <a href="#" class="d-block list-group-item categoria-item-select" data-id="<?= $categoria->id_categoria?>">
                        <?= $categoria->categoria ?>
                    </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Clique em "<i class="fa fa-plus" aria-hidden="true"></i> Nova categoria" para adicionar uma nova categoria</p>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link ml-auto" data-toggle="modal" data-target="#modal-adicionar-categoria"><i class="fa fa-plus" aria-hidden="true"></i> Nova categoria</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="modal-adicionar-categoria" tabindex="-1" role="dialog" aria-labelledby="modal-adicionar-categoria" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
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
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
        	
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-default">Escritores</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body pt-0">
                <?php if(count($escritores) > 0): ?>
                    <p>Clique sobre o escritor para adicioná-lo</p>
                    <?php foreach($escritores as $escritor): ?>
                    <a href="#" class="d-block list-group-item escritor-item-select" data-id="<?= $escritor->id_escritor?>">
                        <?= $escritor->nome ?>
                    </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Clique em "<i class="fa fa-plus" aria-hidden="true"></i> Novo escritor" para adicionar um novo escritor</p>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link ml-auto" data-toggle="modal" data-target="#modal-adicionar-escritor"><i class="fa fa-plus" aria-hidden="true"></i> Novo escritor</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="modal-adicionar-escritor" tabindex="-1" role="dialog" aria-labelledby="modal-adicionar-escritor" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
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
    $(() => {
        $('.prateleira-item-select').on('click', (e) => {
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

        $('.categoria-item-select').on('click', (e) => {
            let target = $(e.currentTarget)
            let modal = $('#modal-categoria')
            let input = $('#input-categoria')

            let categoria = target.text().trim()

            input.val(categoria)

            modal.modal('hide')
        })

        $('.escritor-item-select').on('click', (e) => {
            let target = $(e.currentTarget)
            let modal = $('#modal-escritor')
            let input = $('#input-escritor')

            let escritor = target.text().trim()

            input.val(escritor)

            modal.modal('hide')
        })

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
    })
</script>