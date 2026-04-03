 <!-- Modal -->
 <div class="modal fade" id="finalizarServicoEsteticoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Finalizar Serviço</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="<?= BASE_URL ?>/meusServicos/FinalizarServicoEstetico" method="POST">
                 <div class="modal-body">
                     <label class="form-label" for="observacao">Observação</label>
                     <textarea class="form-control" name="observacao" id="observacao" rows="3" placeholder="Adicione uma observação caso desejar"></textarea>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                     <input type="hidden" name="id_servico_estetico" id="id_servico_estetico_confirm">
                     <button type="submit" class="btn btn-success">Finalizar</button>
                 </div>
             </form>
         </div>
     </div>
 </div>