 <!-- Configuração de locações -->
 <div class="modal fade" id="modal-configuracao-locacoes" tabindex="-1" role="dialog" aria-labelledby="modal-configuracao-locacoes" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <form id="form-adicionar-categoria" method="POST" action="<?= base_url('configuracao/locacao')?>">
                <?php $configLocacao = $this->Configuracao->get_config_locacao(); ?>

                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Configurar locação</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="form-control-label" for="input-numero-maximo-locacoes">Máximo de locações por pessoa</label>
                                <input type="number" id="input-numero-maximo-locacoes" name="input-numero-maximo-locacoes" class="form-control form-control-alternative" min="0" required value="<?= $configLocacao->numero_maximo_locacoes?>">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="form-control-label" for="input-tempo-dias-locacao">Dias para a locação</label>
                                <input type="number" id="input-tempo-dias-locacao" name="input-tempo-dias-locacao" class="form-control form-control-alternative" min="0" required value="<?= $configLocacao->dias_para_locacao?>">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="form-control-label" for="input-valor-multa-dia-atraso">Valor multa por dia de atraso</label>
                                <input type="number" id="input-tempovalor-multa-dia-atraso" name="input-tempovalor-multa-dia-atraso" class="form-control form-control-alternative" min="0" step="0.01" required value="<?= $configLocacao->valor_multa_por_dia?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary right" value="Salvar">
                </div>
            </form>
        </div>
    </div>
</div>