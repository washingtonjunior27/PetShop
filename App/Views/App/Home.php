<div class="container">
    <h2 class="fs-3 fw-bold my-5">Inicio</h2>

    <!-- AGENDAMENTOS HOJE - TODOS -->
    <div class="row g-3">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card shadow-lg">
                <div class="card-body">
                    <?php if ($_SESSION['user']['role'] === "Esteticista") { ?>
                        <h5 class="card-title fs-5 fw-bold mb-4">Serviços<br>Hoje</h5>
                    <?php } elseif ($_SESSION['user']['role'] === "Veterinario") { ?>
                        <h5 class="card-title fs-5 fw-bold mb-4">Atendimentos<br>Hoje</h5>
                    <?php } else { ?>
                        <h5 class="card-title fs-5 fw-bold mb-4">Agendamentos<br>Hoje</h5>
                    <?php } ?>

                    <div class="d-flex justify-content-between">
                        <p class="card-text fs-2 fw-bold mb-0"><?= $agendsHoje ?></p>
                        <i class="fa-solid fa-calendar fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADMIN -->
        <?php if ($_SESSION['user']['role'] === "Admin") { ?>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Receita<br>Mensal</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0">R$ <?= $orcamento ?></p>
                            <i class="fa-solid fa-sack-dollar fs-1 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Total <br>Clientes</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $totalClientes ?></p>
                            <i class="fa-solid fa-user fs-1 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Vacinas <br> Pendentes</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $vacPends ?></p>
                            <i class="fa-solid fa-syringe fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- ATENDENTE -->
        <?php if ($_SESSION['user']['role'] === "Atendente") { ?>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Agendamentos não <br> Confirmados Hoje</h5>

                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $agendsNaoConf ?></p>
                            <i class="fa-solid fa-calendar-xmark fs-1 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($_SESSION['user']['role'] == "Atendente") { ?>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Vacinas <br> Proximas</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $vacProx ?></p>
                            <i class="fa-solid fa-hourglass-half fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Vacinas <br> Atrasadas</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $vacAtras ?></p>
                            <i class="fa-solid fa-circle-exclamation fs-1 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- VETERINARIO E ESTETICISTA 2 PRIMEIROS CARDS-->
        <?php if ($_SESSION['user']['role'] == "Veterinario" || $_SESSION['user']['role'] == "Esteticista") { ?>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Atendimentos <br> Pendentes Hoje</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $agendsPendentes ?></p>
                            <i class="fa-solid fa-house-medical-circle-exclamation fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Atendimentos <br> Concluidos Hoje</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $agendsFinalizados ?></p>
                            <i class="fa-solid fa-house-medical-circle-check fs-1 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- VETERINARIO -->
        <?php if ($_SESSION['user']['role'] == "Veterinario") { ?>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Vacinas <br> Hoje</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $vacinasHoje ?></p>
                            <i class="fa-solid fa-crutch fs-1 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- ESTETICISTA -->
        <?php if ($_SESSION['user']['role'] == "Esteticista") { ?>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title fs-5 fw-bold mb-4">Atendimentos <br> Futuros</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-2 fw-bold mb-0"><?= $agendsPendentesFuturo ?></p>
                            <i class="fa-solid fa-calendar-plus fs-1 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


    <div class="container p-0 my-4">
        <div class="row g-3">
            <div class="col-12 col-xl-7 bg-white shadow-lg p-3 rounded align-self-start">
                <div class="rounded">
                    <?php if ($_SESSION['user']['role'] == "Veterinario" || $_SESSION['user']['role'] == "Esteticista") { ?>
                        <h2 class="fs-4 fw-bold ">Atendimentos Pendentes Hoje</h2>
                    <?php } else { ?>
                        <h2 class="fs-4 fw-bold ">Agendamentos Hoje</h2>
                    <?php } ?>
                    <?php if (count($agendsHojeRead) > 0) {
                        foreach ($agendsHojeRead as $agHj) {
                            $statusAgend = "";
                            if ($agHj['status_agend'] === "Agendado") {
                                $statusAgend = "🟠 Agendado";
                            } elseif ($agHj['status_agend'] === "Confirmado") {
                                $statusAgend = "🟢 Confirmado";
                            } elseif ($agHj['status_agend'] === "Em atendimento") {
                                $statusAgend = "🔵 Em atendimento";
                            } elseif ($agHj['status_agend'] === "Finalizado") {
                                $statusAgend = "🟢 Finalizado";
                            } else {
                                $statusAgend = "🔴 Cancelado";
                            }

                    ?>
                            <div
                                class="text-light main-bg py-3 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                <span><?= date('H:i', strtotime($agHj['hora_agend_inicio'])) ?></span>
                                <div class="d-flex flex-column text-light gap-2">
                                    <p class="mb-0"><?= $agHj['nome_pet'] ?> - <?= $agHj['nomes_servicos'] ?></p>
                                    <small><?= $agHj['cliente_nome'] ?></small>
                                </div>
                                <div class="d-flex text-light gap-2">
                                    <p class="mb-0"><?= $statusAgend ?></p>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <?php if ($_SESSION['user']['role'] == "Veterinario" || $_SESSION['user']['role'] == "Esteticista") { ?>
                            <div
                                class="text-light main-bg py-4 d-flex align-items-center justify-content-center rounded mt-4 px-3">
                                <div class="d-flex text-light gap-2">
                                    <p class="mb-0 text-uppercase fw-bold">Nenhum atendimento pendente hoje!</p>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div
                                class="text-light main-bg py-4 d-flex align-items-center justify-content-center rounded mt-4 px-3">
                                <div class="d-flex text-light gap-2">
                                    <p class="mb-0 text-uppercase fw-bold">Nenhum agendamento hoje!</p>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <div class="bg-white shadow-lg p-3 rounded">
                    <?php if ($_SESSION['user']['role'] == "Veterinario") { ?>
                        <h2 class="fs-4 fw-bold ">Histórico Recente</h2>
                        <p class="text-secondary">Ultimos Atendimentos</p>

                        <div class="rounded">
                            <?php if (count($histMedRecentes) > 0) {
                                foreach ($histMedRecentes as $hmr) {
                            ?>
                                    <div
                                        class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                        <div class="d-flex flex-column text-light">
                                            <small><?= $hmr['nome_pet'] ?></small>
                                            <small><?= $hmr['cliente_nome'] ?></small>
                                            <small><?= $hmr['nomes_servicos'] ?></small>
                                        </div>
                                        <div class="d-flex flex-column text-light gap-2 align-items-end">
                                            <small>
                                                <?= date('d/m/Y', strtotime($hmr['created_at'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <div
                                    class="text-light main-bg py-3 d-flex align-items-center justify-content-center rounded mt-4 px-3">
                                    <div class="d-flex text-light gap-2">
                                        <p class="mb-0 text-uppercase fw-bold">Nenhum atendimento recente!</p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    <?php } elseif ($_SESSION['user']['role'] == "Esteticista") { ?>
                        <h2 class="fs-4 fw-bold ">Atendimentos Futuros</h2>
                        <p class="text-secondary">Próximos Dias</p>

                        <div class="rounded">
                            <?php if (count($agendsProxRead) > 0) {
                                foreach ($agendsProxRead as $apr) {
                            ?>
                                    <div
                                        class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                        <div class="d-flex flex-column text-light">
                                            <small><?= $apr['nome_pet'] ?></small>
                                            <small><?= $apr['cliente_nome'] ?></small>
                                            <small><?= $apr['nomes_servicos'] ?></small>
                                        </div>
                                        <div class="d-flex flex-column text-light gap-2 align-items-end">
                                            <small>
                                                <?= date('d/m/Y', strtotime($apr['data_agend'])) ?>
                                            </small>
                                            <small>
                                                <?= date('H:i', strtotime($apr['hora_agend_inicio'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <div
                                    class="text-light main-bg py-3 d-flex align-items-center justify-content-center rounded mt-4 px-3">
                                    <div class="d-flex text-light gap-2">
                                        <p class="mb-0 text-uppercase fw-bold">Nenhum atendimento para os próximos dias!</p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    <?php } else { ?>
                        <h2 class="fs-4 fw-bold ">Vacinas</h2>
                        <p class="text-secondary">Vacinas proximas do vencimento</p>

                        <div class="rounded">
                            <?php if (count($readVacsPends) > 0) {
                                foreach ($readVacsPends as $rvp) {
                            ?>
                                    <div
                                        class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                        <div class="d-flex flex-column text-light">
                                            <small><?= $rvp['nome_pet'] ?></small>
                                            <small><?= $rvp['nome_servico'] ?></small>
                                            <small><?= $rvp['cliente_nome'] ?></small>
                                        </div>
                                        <div class="d-flex flex-column text-light gap-2 align-items-end">
                                            <small>
                                                <?= $rvp['data_prox_dose'] != "0000-00-00" && !empty($rvp['data_prox_dose']) ?
                                                    date('d/m/Y', strtotime($rvp['data_prox_dose'])) :
                                                    date('d/m/Y', strtotime($rvp['data_aplicacao']))
                                                ?>
                                            </small>
                                            <small class="align-self-end"><?= $rvp['status_real'] ?></small>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <div
                                    class="text-light main-bg py-3 d-flex align-items-center justify-content-center rounded mt-4 px-3">
                                    <div class="d-flex text-light gap-2">
                                        <p class="mb-0">Nenhuma vacina proxima do vencimento!</p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>