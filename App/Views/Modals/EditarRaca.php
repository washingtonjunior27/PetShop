<!-- Modal -->
<div class="modal fade" id="editarRacaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Raça</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/racas/EditarRaca">
                    <input type="hidden" name="id_raca" id="modal_id_raca">
                    <div class="mb-3">
                        <label for="role" class="form-label">Espécie</label>
                        <select name="id_especie_fk" id="id_especie_fk" class="form-select">
                            <option value="" selected>Selecionar</option>
                            <?php foreach ($especies as $especie) { ?>
                                <option value="<?= $especie['id_especie'] ?>"><?= $especie['nome_especie'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome_raca" class="form-control" id="modal_nome_raca" placeholder="Informe o nome da raça">
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