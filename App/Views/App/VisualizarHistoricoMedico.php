<div class="container">
    <h1 class="fs-3 fw-bold mt-5">Visualizar Histórico</h1>

    <div class="my-4">
        <a href="<?= BASE_URL ?>/historicoMedico" class="btn btn-primary">
            Voltar
        </a>
    </div>

    <div class="container p-0 my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <h2 class="fs-4 fw-bold mb-4">Dados do Atendimento</h2>
                <div class="mb-3">
                    <label for="nome_especie" class="form-label">Nome do Pet</label>
                    <input disabled type="text" name="nome_especie" class="form-control" id="nome_especie" placeholder="Informe a espécie">
                </div>
                <div class="mb-3">
                    <label for="nome_especie" class="form-label">Nome do Dono</label>
                    <input disabled type="text" name="nome_especie" class="form-control" id="nome_especie" placeholder="Informe a espécie">
                </div>
                <div class="mb-3">
                    <label for="nome_especie" class="form-label">Nome do Veterinario</label>
                    <input disabled type="text" name="nome_especie" class="form-control" id="nome_especie" placeholder="Informe a espécie">
                </div>
                <!-- ANAMNESE -->
                <div class="mb-3">
                    <label for="anamnese" class="form-label">Anamnese</label>
                    <textarea name="anamnese" class="form-control" rows="3" placeholder="Descrição do paciente sobre os problemas"></textarea>
                </div>
                <!-- DIAGNOSTICO -->
                <div class="mb-3">
                    <label for="diagnostico" class="form-label">Diagnostico</label>
                    <textarea name="diagnostico" class="form-control" rows="3" placeholder="Diagnostico com base em analise técnica e anamnese"></textarea>
                </div>
                <!-- TRATAMENTO -->
                <div>
                    <label for="tratamento" class="form-label">Tratamento</label>
                    <textarea name="tratamento" class="form-control" rows="3" placeholder="Tratamento para o problema apresentado"></textarea>
                </div>
            </div>
        </div>
    </div>

</div>