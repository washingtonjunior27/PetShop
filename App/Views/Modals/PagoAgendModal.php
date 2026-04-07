 <!-- Modal -->
 <div class="modal fade" id="pagoAgendModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar Pagamento</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p class="mb-0">Deseja confirmar o pagamento desse agendamento??</p>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                 <form action="<?= BASE_URL ?>/confirmacoes/PagoAgend" method="POST">
                     <input type="hidden" name="id_agend" id="id_agend_pago">
                     <button type="submit" class="btn btn-success">Confirmar</button>
                 </form>
             </div>
         </div>
     </div>
 </div>