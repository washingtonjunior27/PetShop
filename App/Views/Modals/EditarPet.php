<!-- Modal -->
<div class="modal fade" id="editarPetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Pet</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/pets/EditarPet">
                    <input type="hidden" name="id_pet" id="modal_id_pet">
                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="nome_pet" class="form-label">Nome</label>
                        <input type="text" name="nome_pet" class="form-control" id="modal_nome_pet" placeholder="Informe o nome do pet">
                    </div>
                    <!-- CLIENTE -->
                    <div class="mb-3">
                        <label for="cliente_id_fk" class="form-label">Cliente (Dono)</label>
                        <select name="cliente_id_fk" id="modal_cliente_id_fk" class="form-select">
                            <option value="" selected>Selecionar</option>
                            <?php foreach ($clientes as $cliente) { ?>
                                <option value="<?= $cliente['id'] ?>"><?= $cliente['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- ESPECIE -->
                    <div class="mb-3">
                        <label for="especie_id_fk" class="form-label">Espécie</label>
                        <select name="especie_id_fk" id="modal_especie_id_fk" class="form-select" data-url="<?= BASE_URL ?>/pets/buscarRacas">
                            <option value="" selected>Selecionar</option>
                            <?php foreach ($especies as $especie) { ?>
                                <option value="<?= $especie['id_especie'] ?>"><?= $especie['nome_especie'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- RAÇA -->
                    <div class="mb-3">
                        <label for="raca_id_fk" class="form-label">Raça</label>
                        <select name="raca_id_fk" id="modal_raca_id_fk" class="form-select" disabled>
                            <option value="">Selecione primeiro a espécie</option>
                        </select>
                    </div>
                    <!-- SEXO -->
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input id="sexo_macho" value="Macho" class="form-check-input" type="radio" name="modal_sexo_pet">
                            <label class="form-check-label" for="sexo_pet">
                                Macho
                            </label>
                        </div>
                        <div class="form-check mb-4">
                            <input id="sexo_femea" value="Femea" class="form-check-input" type="radio" name="modal_sexo_pet">
                            <label class="form-check-label" for="sexo_pet">
                                Femea
                            </label>
                        </div>
                    </div>
                    <!-- COR -->
                    <div class="mb-3">
                        <label for="cor_pet" class="form-label">Cor</label>
                        <input type="text" name="cor_pet" class="form-control" id="modal_cor_pet" placeholder="Informe a cor do pet">
                    </div>
                    <!-- PESO -->
                    <div class="mb-3">
                        <label for="peso_pet" class="form-label">Peso (Kg)</label>
                        <input type="number" min="1" step="0.1" name="peso_pet" class="form-control" id="modal_peso_pet" placeholder="Informe o peso do pet">
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