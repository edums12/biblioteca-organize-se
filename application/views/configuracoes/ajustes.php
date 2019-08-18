 <!-- Configuração de locações -->
 <div class="modal fade" id="modal-configuracao-ajustes" tabindex="-1" role="dialog" aria-labelledby="modal-configuracao-ajustes" aria-hidden="true">
     <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
         <div class="modal-content">
             <form method="POST" action="<?= base_url('configuracao/ajustes') ?>">
                 <?php $config_ajustes = $this->Configuracao->get_config_ajustes(); ?>

                 <div class="modal-header">
                     <h4 class="modal-title" id="modal-title-default">Configurações</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>

                 <div class="modal-body">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="form-group mb-0">
                                 <div class="custom-control custom-checkbox mb-3">
                                     <input class="custom-control-input" id="checkbox-exibir-pessoas-inativas" name="checkbox-exibir-pessoas-inativas" type="checkbox" <?= $config_ajustes->exibir_pessoas_inativas ? 'checked' : ''?>>
                                     <label class="custom-control-label" for="checkbox-exibir-pessoas-inativas">Exibir pessoas inativas</label>
                                 </div>
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