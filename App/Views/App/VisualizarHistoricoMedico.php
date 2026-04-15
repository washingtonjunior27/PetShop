<div class="px-4">
    <h1 class="fs-3 fw-bold mt-5">Visualizar Histórico</h1>

    <div class="my-4">
        <a href="<?= BASE_URL ?>/historicoMedico" class="btn btn-primary">
            Voltar
        </a>
    </div>

    <div class="my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <div class="mb-3 d-flex justify-content-between">
                    <h2 class="fs-4 fw-bold mb-4">Dados do Atendimento</h2>
                    <span><?= date('d/m/Y - H:i:s', strtotime($atend['created_at'])) ?></span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome do Pet</label>
                    <input readonly type="text" class="form-control" value="<?= $atend['nome_pet'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome do Dono</label>
                    <input readonly type="text" class="form-control" value="<?= $atend['cliente_nome'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome do Veterinario</label>
                    <input readonly type="text" class="form-control" value="<?= $atend['responsavel_login'] ?>">
                </div>
                <!-- ANAMNESE -->
                <div class="mb-3">
                    <label for="anamnese" class="form-label">Anamnese</label>
                    <textarea readonly name="anamnese" class="form-control" rows="3"><?= $atend['anamnese'] ?></textarea>
                </div>
                <!-- DIAGNOSTICO -->
                <div class="mb-3">
                    <label for="diagnostico" class="form-label">Diagnostico</label>
                    <textarea readonly name="diagnostico" class="form-control" rows="3"><?= $atend['diagnostico'] ?></textarea>
                </div>
                <!-- TRATAMENTO -->
                <div>
                    <label for="tratamento" class="form-label">Tratamento</label>
                    <textarea readonly name="tratamento" class="form-control" rows="3"><?= $atend['tratamento'] ?></textarea>
                </div>
            </div>
        </div>
    </div>

</div>