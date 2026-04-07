<!-- Modal -->
<div class="modal fade" id="cadastrarVacinacaoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Vacinação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/vacinacao/CriarVacinacao">
                    <!-- CLIENTE -->
                    <div class="mb-3">
                        <label for="id_cliente_vacinacao" class="form-label">Cliente (Dono)</label>
                        <select name="id_cliente_vacinacao" id="modal_cliente_id_fk_vacinacao" class="form-select">
                            <option value="" selected>Selecionar</option>
                            <?php foreach ($clientes as $cliente) { ?>
                                <option value="<?= $cliente['id'] ?>"><?= $cliente['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- PET -->
                    <div class="mb-3">
                        <label for="id_pet_vacinacao" class="form-label">Pet</label>
                        <select name="id_pet_vacinacao" id="pet_id_fk_vacinacao" class="form-select">
                            <option value="">Selecione primeiro o cliente</option>
                        </select>
                    </div>
                    <?php
                    if ($_SESSION['user']['role'] == "Admin") { ?>
                        <!-- VETERINARIO SELECT PRO ADMIN -->
                        <div class="mb-3">
                            <label for="id_vet_vacinacao" class="form-label">Veterinario</label>
                            <select name="id_vet_vacinacao" id="pet_id_fk_vacinacao" class="form-select">
                                <option value="">Selecione o veterinario</option>
                            </select>
                        </div>
                    <?php    } else { ?>
                        <!-- VETERINARIO DISABLED -->
                        <div class="mb-3">
                            <label for="proxima_dose" class="form-label">Veterinario</label>
                            <input disabled type="text" class="form-control" value="<?= $usuario['nome'] ?>">
                            <input type="hidden" value="<?= $usuario['id'] ?>" name="id_vet_vacinacao" class="form-control" id="proxima_dose">
                        </div>
                    <?php } ?>
                    <!-- DATA APLICAÇÃO -->
                    <div class="mb-3">
                        <label for="data_aplicacao" class="form-label">Data de Aplicação</label>
                        <input type="date" name="data_aplicacao" class="form-control" id="data_aplicacao">
                    </div>
                    <!-- DATA PROX DOSE -->
                    <div class="mb-3">
                        <label for="proxima_dose" class="form-label">Data de Prox. Dose</label>
                        <input type="date" name="proxima_dose" class="form-control" id="proxima_dose">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>