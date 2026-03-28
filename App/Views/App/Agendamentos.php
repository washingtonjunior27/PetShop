<?php
$horarios = [
    "8:00",
    "8:30",
    "9:00",
    "9:30",
    "10:00",
    "10:30",
    "11:00",
    "11:30",
    "13:00",
    "13:30",
    "14:00",
    "14:30",
    "15:00",
    "15:30",
    "16:00",
    "16:30",
    "17:00",
    "17:30",
]
?>

<div class="container">
    <h1 class="fs-3 fw-bold my-5">Agendamentos</h1>

    <div class="container p-0 my-4">
        <div class="row g-3">
            <div class="col-12 col-xl-7 bg-white shadow-lg p-3 rounded align-self-start">
                <div class="rounded">
                    <h2 class="fs-4 fw-bold ">Novo Agendamento</h2>

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

                    <form class="mt-3" method="POST" action="<?= BASE_URL ?>/agendamentos/CriarAgendamento">
                        <!-- CLIENTE -->
                        <div class="mb-3">
                            <label for="cliente_id_fk" class="form-label">Cliente</label>
                            <select name="cliente_id_fk" id="cliente_id_fk" class="form-select" data-url="<?= BASE_URL ?>/pets/buscarPets">
                                <option value="" selected>Selecionar</option>
                                <?php foreach ($clientes as $cliente) { ?>
                                    <option value="<?= $cliente['id'] ?>"><?= $cliente['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- PET -->
                        <div class="mb-3">
                            <label for="cliente_id_fk" class="form-label">Pet</label>
                            <select name="cliente_id_fk" id="cliente_id_fk" class="form-select" disabled>
                                <option value="">Selecione primeiro o cliente</option>
                            </select>
                        </div>
                        <!-- VETERINARIOS -->
                        <div class="mb-3">
                            <label for="veterinario_id_fk" class="form-label">Veterinario</label>
                            <select name="veterinario_id_fk" id="veterinario_id_fk" class="form-select">
                                <option value="" selected>Selecionar</option>
                                <?php foreach ($veterinarios as $veterinario) { ?>
                                    <option value="<?= $veterinario['id'] ?>"><?= $veterinario['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="data_agendada" class="form-label">Data Agendada</label>
                            <input type="date" name="data_agendada" class="form-control" id="data_agendada">
                        </div>
                        <div class="mb-3">
                            <label for="descricao_agendamento" class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao_agendamento" placeholder="Descreva o agendamento" id="descricao_agendamento" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <div class="bg-white shadow-lg p-3 rounded">
                    <h2 class="fs-4 fw-bold ">Horários</h2>

                    <div class="rounded row g-2">
                        <?php foreach ($horarios as $horario) { ?>
                            <div class="col-md-3">
                                <div
                                    class="text-light main-bg py-3 rounded mt-3">
                                    <div class="d-flex text-light gap-1 justify-content-center">
                                        <input type="radio" value="<?= $horario ?>" name="horario">
                                        <label for="horario"><?= $horario ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>