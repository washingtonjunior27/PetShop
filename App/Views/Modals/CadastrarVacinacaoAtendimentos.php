<!-- Modal -->
<div class="modal fade" id="cadastrarVacinacaoAtendimentosModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Vacinação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/vacinacao/CriarVacinacao>
                    <!-- ID DO AGENDAMENTO -->
                    <input type=" hidden" name="id_agend_vac_atend_modal" id="id_agend_vac_atend_modal">
                    <!-- CLIENTE -->
                    <div class="mb-3">
                        <label for="cliente_id_fk_vacinacao" class="form-label">Cliente (Dono)</label>
                        <input class="form-control" disabled type="text" name="cliente_nome_vac_atend_modal" id="cliente_nome_vac_atend_modal">
                        <input type="hidden" name="cliente_id_vac_atend_modal" id="cliente_id_vac_atend_modal">
                    </div>
                    <!-- PET -->
                    <div class="mb-3">
                        <label for="pet_id_fk_vacinacao" class="form-label">Pet</label>
                        <input class="form-control" disabled type="text" name="pet_nome_vac_atend_modal" id="pet_nome_vac_atend_modal">
                        <input type="hidden" name="pet_id_vac_atend_modal" id="pet_id_vac_atend_modal">
                    </div>
                    <!-- VACINA -->
                    <div class="mb-3">
                        <label for="vacina_id_fk_vacinacao" class="form-label">Veterinario Responsável</label>
                        <input class="form-control" disabled type="text" name="vet_login_vac_atend_modal" id="vet_login_vac_atend_modal">
                        <input type="hidden" name="vet_id_vac_atend_modal" id="vet_id_vac_atend_modal">
                    </div>
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