 <!-- Modal -->
 <div class="modal fade" id="resetSenhaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success text-light">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Resetar Senha</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p class="mb-0">Deseja resetar a senha do usuario??</p>
             </div>
             <form action="<?= BASE_URL ?>/funcionarios/ResetSenha" method="POST">
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                     <input type="hidden" name="id_usuario" id="modal_reset_senha_id_usuario">
                     <input type="hidden" name="pagina" id="modal_reset_senha_pag">
                     <button type="submit" class="btn btn-success">Resetar</button>
                 </div>
             </form>
         </div>
     </div>
 </div>