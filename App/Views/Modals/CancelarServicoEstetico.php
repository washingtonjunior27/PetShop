 <!-- Modal -->
 <div class="modal fade" id="cancelarServicoEsteticoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-danger text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Cancelar Serviço Estetico</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="<?= BASE_URL ?>/meusServicos/CancelarServicoEstetico" method="POST">
                 <div class="modal-body">
                     <p class="mb-0">Tem certeza que deseja cancelar esse serviço estetico??</p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                     <input type="hidden" name="id_servico_estetico" id="id_servico_estetico_cancel">
                     <button type="submit" class="btn btn-danger">Confirmar</button>
                 </div>
             </form>
         </div>
     </div>
 </div>