 <!-- Modal -->
 <div class="modal fade" id="resolvidoLembreteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Resolver Lembrete</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="<?= BASE_URL ?>/vacinacao/ResolvidoVacinacao" method="POST">
                 <div class="modal-body">
                     <p class="mb-0">Deseja marcar lembrete como resolvido??</p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                     <input type="hidden" name="id_vacinacao_resolvido" id="id_vacinacao_resolvido">
                     <button type="submit" class="btn btn-success">Resolvido</button>
                 </div>
             </form>
         </div>
     </div>
 </div>