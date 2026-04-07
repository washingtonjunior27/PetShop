<div class="container">
    <h1 class="fs-3 fw-bold my-5">Vacinação</h1>

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

                <form class="mt-3" method="POST" action="<?= BASE_URL ?>/vacinacao/CriarVacinacao">
                    <!-- CLIENTE -->
                    <div class="mb-3">
                        <label for="id_cliente_vacinacao" class="form-label">Cliente (Dono)</label>
                        <select name="id_cliente_vacinacao" id="cliente_id_fk_vacinacao" class="form-select" data-url="<?= BASE_URL ?>/agendamentos/buscarPets">
                            <option value="" selected>Selecionar</option>
                            <?php foreach ($clientes as $cliente) { ?>
                                <option value=" <?= $cliente['id'] ?>"><?= $cliente['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- PET -->
                    <div class="mb-3">
                        <label for="id_pet_vacinacao" class="form-label">Pet</label>
                        <select name="id_pet_vacinacao" id="pet_id_fk_vacinacao" class="form-select" disabled>
                            <option value="">Selecione primeiro o cliente</option>
                        </select>
                    </div>
                    <?php
                    if ($_SESSION['user']['role'] == "Admin") { ?>
                        <!-- VETERINARIO SELECT PRO ADMIN -->
                        <div class="mb-3">
                            <label for="id_vet_vacinacao" class="form-label">Veterinario</label>
                            <select name="id_vet_vacinacao" id="id_vet_vacinacao" class="form-select">
                                <option value="" selected>Selecionar</option>
                                <?php foreach ($veterinarios as $veterinario) { ?>
                                    <option value="<?= $veterinario['id'] ?>"><?= $veterinario['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php    } else { ?>
                        <!-- VETERINARIO DISABLED -->
                        <div class="mb-3">
                            <label for="proxima_dose" class="form-label">Veterinario</label>
                            <input disabled type="text" class="form-control" value="<?= $usuario['login'] ?>">
                            <input type="hidden" value="<?= $usuario['id'] ?>" name="id_vet_vacinacao" class="form-control" id="proxima_dose">
                        </div>
                    <?php } ?>
                    <!-- SERVIÇO (VACINA) -->
                    <div class="mb-3">
                        <label for="id_vacina_servico" class="form-label">Vacina</label>
                        <select name="id_vacina_servico" id="modal_cliente_id_fk_vacinacao" class="form-select">
                            <option value="" selected>Selecionar</option>
                            <?php foreach ($vacinas as $vac) { ?>
                                <option value="<?= $vac['id_servico'] ?>"><?= $vac['nome_servico'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- DATA APLICAÇÃO -->
                    <div class="mb-3">
                        <label for="data_aplicacao" class="form-label">Data de Aplicação</label>
                        <input type="date" name="data_aplicacao" class="form-control" id="data_aplicacao">
                    </div>
                    <!-- DATA PROX DOSE -->
                    <div class="mb-3">
                        <label for="data_prox_dose" class="form-label">Data de Prox. Dose</label>
                        <input type="date" name="data_prox_dose" class="form-control" id="proxima_dose">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Criar Vacinação</button>
                    </div>
                </form>
            </div>
        </div>
    </div>