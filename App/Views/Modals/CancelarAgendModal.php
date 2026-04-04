 <!-- Modal -->
 <div class="modal fade" id="cancelarAgendModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-danger text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Cancelar Agendamento</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p class="mb-0">Tem certeza que deseja cancelar esse agendamento??</strong>??</p>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                 <form action="<?= BASE_URL ?>/agendamentos/CancelarAgend" method="POST">
                     <input type="hidden" name="caminho" value="<?= $caminho ?>">
                     <input type="hidden" name="id_agend" id="id_agend_cancel">
                     <button type="submit" class="btn btn-danger">Confirmar</button>
                 </form>
             </div>
         </div>
     </div>
 </div>