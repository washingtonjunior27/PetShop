<div class="container">
    <h1 class="fs-3 fw-bold my-5">Agendamentos</h1>

    <div class="container p-0 my-4">
        <form class="mt-3" method="POST" action="<?= BASE_URL ?>/agendamentos/CriarAgendamento">
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

                        <!-- CLIENTE -->
                        <div class="mb-3">
                            <label for="cliente_id_agend" class="form-label">Cliente</label>
                            <select name="cliente_id_agend" id="cliente_id_agend" class="form-select" data-url="<?= BASE_URL ?>/agendamentos/buscarPets">
                                <option value="" selected>Selecionar</option>
                                <?php foreach ($clientes as $cliente) { ?>
                                    <option value="<?= $cliente['id'] ?>"><?= $cliente['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- PET -->
                        <div class="mb-3">
                            <label for="pet_id_agend" class="form-label">Pet</label>
                            <select name="pet_id_agend" id="pet_id_agend" class="form-select" disabled>
                                <option value="">Selecione primeiro o cliente</option>
                            </select>
                        </div>

                        <!-- DATA AGENDADA -->
                        <div class="mb-3">
                            <label for="data_agend" class="form-label">Data Agendada</label>
                            <input type="date" name="data_agend" class="form-control" id="data_agend">
                        </div>

                        <!-- SERVIÇOS -->
                        <div class="accordion mb-3" id="accordionFlushExample">
                            <label for="" class="form-label">Serviços (Categoria)</label>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Estetica
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body row">
                                        <?php foreach ($servicosEstetica as $estetica) { ?>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check-estet-agend" name="servico_agendamento[]" type="checkbox" value="<?= $estetica['id_servico'] ?>" id="checkDefault">
                                                    <label class="form-check-label" for="checkDefault">
                                                        <?= $estetica['nome_servico'] ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Consulta
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body row g-2">
                                        <?php foreach ($servicosConsulta as $consulta) { ?>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input check-vet-agend" name="servico_agendamento[]" type="checkbox" value="<?= $consulta['id_servico'] ?>" id="checkDefault">
                                                    <label class="form-check-label" for="checkDefault">
                                                        <?= $consulta['nome_servico'] ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-CollapseThree" aria-expanded="false" aria-controls="flush-CollapseThree">
                                        Vacina
                                    </button>
                                </h2>
                                <div id="flush-CollapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body row g-2">
                                        <?php foreach ($servicosVacina as $vacina) { ?>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input check-vet-agend" name="servico_agendamento[]" type="checkbox" value="<?= $vacina['id_servico'] ?>" id="checkDefault">
                                                    <label class="form-check-label" for="checkDefault">
                                                        <?= $vacina['nome_servico'] ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RESPONSAVEIS -->
                        <div class="mb-3">
                            <label for="responsavel_id_agend" class="form-label">Responsável</label>
                            <select name="responsavel_id_agend" id="responsavel_id_agend" class="form-select">
                                <option value="" selected>Selecione primeiro o(s) serviço(s)</option>
                                <?php foreach ($responsavels as $responsavel) { ?>
                                    <option value="<?= $responsavel['id'] ?>" data-role="<?= $responsavel['role'] ?>"><?= $responsavel['login'] . " (" . $responsavel['role'] . ")" ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_agend" class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao_agend" placeholder="Descreva o agendamento (opcional)" id="descricao_agend" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>

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
                                            <input type="radio" value="<?= $horario ?>" name="hora_agend_inicio">
                                            <label for="horario"><?= $horario ?></label>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>