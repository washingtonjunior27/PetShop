 <!-- Modal -->
 <div class="modal fade" id="excluirEspecieModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-danger text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Espécie</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p class="mb-0">Tem certeza que deseja excluir a espécie <strong id="nome_especie_delete"></strong>??</p>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                 <form action="<?= BASE_URL ?>/especies/ExcluirEspecie" method="POST">
                     <input type="hidden" name="id_especie" id="id_especie_delete">
                     <button type="submit" class="btn btn-danger">Excluir</button>
                 </form>
             </div>
         </div>
     </div>
 </div>