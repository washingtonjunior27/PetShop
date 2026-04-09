<div class="container">
    <h1 class="fs-3 fw-bold my-5">Atendimentos</h1>

    <div class="container p-0 my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">

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

                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/atendimentos">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>

        <span class="d-block my-4 p-2  shadow-lg text-bg-light rounded text-center">
            <strong>Atenção!!!</strong> Cadastrar vacinação irá finalizar o agendamento. Se necessário realize diagnóstico primeiro.
        </span>


        <div class="bg-white shadow-lg px-3 pt-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Lista de Atendimentos</h2>

            <div class="table-responsive mt-4">
                <table class="table table-striped-columns align-middle text-nowrap">
                    <thead class="main-bg">
                        <tr>
                            <th class="fw-bold text-uppercase" scope="col">Ações</th>
                            <th class="fw-bold text-uppercase" scope="col">Data e Hora Agendada</th>
                            <th class="fw-bold text-uppercase" scope="col">Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Cliente</th>
                            <?php if ($_SESSION['user']['role'] === "Admin") { ?>
                                <th class="fw-bold text-uppercase" scope="col">Responsável</th>
                                <th class="fw-bold text-uppercase" scope="col">Especialidade</th>
                            <?php } ?>
                            <th class="fw-bold text-uppercase" scope="col">Serviços</th>
                            <th class="fw-bold text-uppercase" scope="col">Status</th>
                            <th class="fw-bold text-uppercase" scope="col">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($atendimentos) > 0) {
                            foreach ($atendimentos as $atend) { ?>
                                <tr>
                                    <td>

                                        <button
                                            data-bs-id_agend="<?= $atend['id_agend'] ?>"
                                            type="button"
                                            class="border-0 bg-white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#finalizarAtendimentoModal">
                                            <i class="fa-solid fa-calendar-check fs-3 text-success"></i>
                                        </button>
                                        <?php if (str_contains($atend['categorias_servicos'], "Consulta")) { ?>
                                            <a class="text-decoration-none" href="<?= BASE_URL ?>/atendimentos/Diagnostico?id_agend=<?= $atend['id_agend'] ?>">
                                                <i class="fa-solid fa-comment-medical fs-3 text-primary"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if (str_contains($atend['categorias_servicos'], "Vacina")) { ?>
                                            <button
                                                data-bs-id_agend=<?= $atend['id_agend'] ?>
                                                data-bs-id_cliente=<?= $atend['cliente_id'] ?>
                                                data-bs-nome_cliente=<?= $atend['cliente_nome'] ?>
                                                data-bs-id_pet=<?= $atend['id_pet'] ?>
                                                data-bs-nome_pet=<?= $atend['nome_pet'] ?>
                                                data-bs-responsavel_id=<?= $atend['responsavel_id'] ?>
                                                data-bs-responsavel_login=<?= $atend['responsavel_login'] ?>
                                                data-bs-vacina_id=<?= $atend['vacina_id'] ?>
                                                data-bs-vacina_nome=<?= $atend['vacina_nome'] ?>
                                                class="border-0 bg-white"
                                                type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#cadastrarVacinacaoAtendimentosModal">
                                                <i class="fa-solid fa-syringe fs-3 text-primary"></i>
                                            </button>
                                        <?php } ?>
                                        <button
                                            data-bs-id_agend="<?= $atend['id_agend'] ?>"
                                            type="button"
                                            class="border-0 bg-white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#cancelarAgendModal">
                                            <i class="fa-solid fa-calendar-xmark fs-3 text-danger"></i>
                                        </button>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($atend['data_agend'])) . ' | ' . date("H:i", strtotime($atend['hora_agend_inicio'])) ?></td>
                                    <td><?= $atend['nome_pet'] ?></td>
                                    <td><?= $atend['cliente_nome'] ?></td>
                                    <?php if ($_SESSION['user']['role'] === "Admin") { ?>
                                        <td><?= $atend['responsavel_login'] ?></td>
                                        <td><?= $atend['veterinario_especialidade'] ?></td>
                                    <?php } ?>
                                    <td><?= $atend['nomes_servicos'] ?></td>
                                    <td>
                                        <?= '🔵' . $atend['status_agend'] ?>
                                    </td>
                                    <td>
                                        <?= $atend['status_real'] == "Atrasado" ? "🔴 Atrasado" : "🟢 Confirmado" ?>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="9" class="text-center py-3 fs-5">Nenhum agendamento encontrado!!</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        $caminho = "atendimentos";
        require __DIR__ . "/../Modals/CadastrarVacinacaoAtendimentos.php";
        require __DIR__ . "/../Modals/CancelarAgendModal.php";
        require __DIR__ . "/../Modals/FinalizarAtendimento.php";
        ?>


        <!-- PAGINAÇÃO -->
        <nav class="mt-2 d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <?php
                $query = $_GET;
                unset($query['route']);
                $range = 2;
                $start = max(1, $currentPage - $range);
                $end = min($totalAtendimentos, $currentPage + $range);
                ?>

                <?php if ($currentPage > 1) {
                    $query['page'] = $currentPage - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/atendimentos?<?= http_build_query($query) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = $start; $i <= $end; $i++) {
                    $query['page'] = $i; ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/atendimentos?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage < $totalAtendimentos) {
                    $query['page'] = $currentPage + 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/atendimentos?<?= http_build_query($query) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>