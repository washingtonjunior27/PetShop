<!-- Modal -->
<div class="modal fade" id="editarEspecieModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/especies/EditarEspecie">
                    <input type="hidden" name="id_especie" id="modal_id_especie">
                    <div class="mb-3">
                        <label for="nome_especie" class="form-label">Nome da Espécie</label>
                        <input type="text" name="nome_especie" class="form-control" id="modal_nome_especie" placeholder="Informe a espécie">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning">Editar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>