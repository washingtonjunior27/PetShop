<div class="px-4">
    <h1 class="fs-3 fw-bold mt-5">Histórico de Vacinação</h1>

    <div class="my-4">
        <a href="<?= BASE_URL ?>/historicoVacinacao" class="btn btn-primary">
            Voltar
        </a>
    </div>

    <div class="my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <div class="d-flex justify-content-between">
                    <h2 class="fs-4 fw-bold mb-4">Dados de Vacinação</h2>
                    <span><?= date('d/m/Y - H:i', strtotime($atend['created_at'])) ?></span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome do Veterinario</label>
                    <input readonly type="text" class="form-control" value="<?= $atend['responsavel_login'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome do Dono</label>
                    <input readonly type="text" class="form-control" value="<?= $atend['cliente_nome'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome do Pet</label>
                    <input readonly type="text" class="form-control" value="<?= $atend['nome_pet'] ?>">
                </div>
                <!-- ANAMNESE -->
                <div class="mb-3">
                    <label for="anamnese" class="form-label">Vacina Aplicada</label>
                    <input readonly type="text" class="form-control" value="<?= $atend['nome_servico'] ?>">

                </div>
                <!-- DIAGNOSTICO -->
                <div class="mb-3">
                    <label for="diagnostico" class="form-label">Data de Aplicação</label>
                    <input readonly type="text" class="form-control" value="<?= date('d/m/Y', strtotime($atend['data_aplicacao'])) ?>">

                </div>
                <!-- TRATAMENTO -->
                <div>
                    <label for="tratamento" class="form-label">Segunda Dose</label>
                    <input readonly type="text" class="form-control" value="<?= !empty($atend['data_prox_dose']) && $atend['data_prox_dose'] != "0000-00-00"
                                                                                ? date('d/m/Y', strtotime($atend['data_prox_dose'])) : "---" ?>">

                </div>
            </div>
        </div>
    </div>
</div>