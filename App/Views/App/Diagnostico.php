<div class="container">
    <h1 class="fs-3 fw-bold mt-5">Diagnóstico</h1>

    <div class="my-4">
        <a href="<?= BASE_URL ?>/atendimentos" class="btn btn-primary">
            Voltar
        </a>
    </div>

    <div class="container p-0 my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <h2 class="fs-4 fw-bold ">Dados do Paciente</h2>

                <?php if (isset($_SESSION['erro'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $_SESSION['erro'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }
                unset($_SESSION['erro']) ?>

                <?php if (isset($_SESSION['sucesso'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION['sucesso'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }
                unset($_SESSION['sucesso']) ?>

                <form class="mt-3" method="POST" action="<?= BASE_URL ?>/especies/CriarEspecie">
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
                    <div class="mb-3">
                        <label for="tratamento" class="form-label">Tratamento</label>
                        <textarea name="tratamento" class="form-control" rows="3" placeholder="Tratamento para o problema apresentado"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

</div>