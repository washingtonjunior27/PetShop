 <!-- Modal -->
 <div class="modal fade" id="excluirVeterinarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-danger text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Veterinario</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p class="mb-0">Tem certeza que deseja excluir o veterinario <strong id="nome_veterinario_delete"></strong>??</p>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                 <form action="<?= BASE_URL ?>/veterinarios/ExcluirVeterinario" method="POST">
                     <input type="hidden" name="id_veterinario" id="id_veterinario_delete">
                     <button type="submit" class="btn btn-danger">Excluir</button>
                 </form>
             </div>
         </div>
     </div>
 </div>