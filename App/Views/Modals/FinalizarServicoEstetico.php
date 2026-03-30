 <!-- Modal -->
 <div class="modal fade" id="finalizarServicoEsteticoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Finalizar Serviço</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="">
                     <label class="form-label" for="observacao">Observação</label>
                     <textarea class="form-control" name="observacao" id="observacao" rows="3" placeholder="Adicione uma observação caso desejar"></textarea>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                 <form action="<?= BASE_URL ?>/servicos/ExcluirServico" method="POST">
                     <input type="hidden" name="id_servico" id="id_servico_delete">
                     <button type="submit" class="btn btn-success">Finalizar</button>
                 </form>
             </div>
         </div>
     </div>
 </div>