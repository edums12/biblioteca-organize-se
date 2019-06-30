<!-- Header -->
<div class="header pb-8 pt-5 pt-lg-12 d-flex align-items-center" style="min-height: 300px;">
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1 class="display-2 text-white">Cadastro de corredor</h1>
                <p class="text-white mt-0 mb-5">O cadastro de corredor serve para adicionar corredores da biblioteca e organizar os livros em prateleiras.</p>
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
                            <h3 class="mb-0">Corredor</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('corredores/cadastrar') ?>" method="POST" id="cadastrar-corredor">
                        <h6 class="heading-small text-muted mb-4">Informações</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-corredor">Corredor</label>
                                    <input type="text" id="input-corredor" name="input-corredor" class="form-control form-control-alternative" required>
                                </div>
                            </div>
                        </div>
                        <h6 class="heading-small text-muted mb-4">Prateleiras</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-adicionar-prateleira">Adicionar prateleira</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="card shadow">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush" id="table-prateleiras">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Prateleiras</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3">
                            <input type="submit" class="btn btn-primary mt-4" value="Cadastrar" />
                        </div>
                    </form>

                    <form id="adicionar-prateleira" method="POST" action="">
                        <div class="modal fade" id="modal-adicionar-prateleira" tabindex="-1" role="dialog" aria-labelledby="modal-adicionar-prateleira" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title-default">Nova prateleira</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-0">
                                                    <label class="form-control-label" for="input-prateleira">Prateleira</label>
                                                    <input type="text" id="input-prateleira" class="form-control form-control-alternative" required>
                                                    <small class="danger text-danger mt-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Adicionar">
                                        <button id="fechar-modal" type="button" class="btn btn-link ml-auto" data-dismiss="modal">Cancelar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        var prateleiras = new Array()

        $('form#adicionar-prateleira').submit((e) => {
            e.preventDefault()

            var table = $('#table-prateleiras')
            var input = $('#input-prateleira')
            var modal = $('#modal-adicionar-prateleira')

            var prateleira = input.val().trim()

            if (prateleiraCadastrada(prateleira))
            {
                input.addClass('invalid')

                input.parent().find('small.danger').text('Prateleira já adicionada')

                return false
            }

            prateleiras.push(prateleira)

            input.removeClass('invalid')
            input.parent().find('small.danger').text('')

            table
                .find('tbody')
                .append(
                    `<tr>
                        <td>
                            <a class="remover-prateleira text-red a-without-href mr-3"><i class="far fa-trash-alt"></i> </a>
                            <span>${prateleira}</span>
                        </td>
                    </tr>`)
            
            input.val('')

            modal.find('#fechar-modal').click()
        })

        $('#table-prateleiras').on('click', '.remover-prateleira', (e) => {
            e.preventDefault()

            var target = $(e.currentTarget)

            prateleiras.splice(prateleiras.indexOf(target.parent().find('span').text()), 1)

            console.log(prateleiras)

            target.parent().remove()
        })

        $('form#cadastrar-corredor').submit((e) => {
            if (prateleiras.length == 0)
            {
                e.preventDefault()

                $('.alert.alert-danger').removeClass('hide')
                $('.alert.alert-danger').addClass('show')
                $('.alert.alert-danger .message').html("Nenhuma prateleira adicionada")

                setTimeout(() => {
                    $('.alert.alert-danger').fadeOut('slow')
                }, 8000)
                
            }

            $('form#cadastrar-corredor').append(`<input type='hidden' name='input-prateleiras' value='${prateleiras.join(';')}' />`)

        })

        var prateleiraCadastrada = (value) => {
            var finded = false

            prateleiras.forEach(it => {
                if (it == value) 
                    finded = true
            })

            return finded
        }
    })
</script>