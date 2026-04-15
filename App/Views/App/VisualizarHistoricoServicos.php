<div class="px-4">
    <h1 class="fs-3 fw-bold mt-5">Histórico de Serviço</h1>

    <div class="my-4">
        <a href="<?= BASE_URL ?>/historicoServicos" class="btn btn-primary">
            Voltar
        </a>
    </div>

    <div class="my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <div class="d-flex justify-content-between">
                    <h2 class="fs-4 fw-bold mb-4">Dados do Serviço</h2>
                    <span><?= date('d/m/Y - H:i', strtotime($atend['created_at'])) ?></span>
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
                    <label class="form-label">Nome do Esteticista</label>
                    <input readonly type="text" class="form-control" value="<?= $atend['responsavel_login'] ?>">
                </div>
                <!-- SERVIÇOS -->
                <div>
                    <label for="anamnese" class="form-label">Serviços Realizados</label>
                    <textarea readonly class="form-control" rows="3"><?= $atend['nomes_servicos'] ?></textarea>
                </div>
                <!-- OBSERVAÇÃO -->
                <div>
                    <label for="anamnese" class="form-label">Observação</label>
                    <textarea readonly class="form-control" rows="3"><?= $atend['observacao'] ?></textarea>
                </div>
            </div>
        </div>
    </div>

</div>