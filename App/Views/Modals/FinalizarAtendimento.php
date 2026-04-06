 <!-- Modal -->
 <div class="modal fade" id="finalizarAtendimentoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Finalizar Atendimento</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>

             <div class="modal-body">
                 <p>
                     <strong>Atenção!!!</strong>
                 </p>
                 <p>Essa opção está disponível para caso queira finalizar o atendimento sem aplicar vacinação.</p>
                 <p>Tem certeza que deseja finalizar esse atendimento??</p>
             </div>
             <div class="modal-footer">
                 <form action="<?= BASE_URL ?>/agendamentos/FinalizarAgend" method="POST">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                     <input type="hidden" name="id_finalizar_atendimento_modal" id="id_finalizar_atendimento_modal">
                     <button type="submit" class="btn btn-success">Finalizar</button>
                 </form>
             </div>
         </div>
     </div>
 </div>