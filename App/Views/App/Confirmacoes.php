<div class="container">
    <h1 class="fs-3 fw-bold my-5">Confirmar Agendamentos</h1>

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

                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/confirmacoes">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>



        <div class="bg-white shadow-lg px-3 pt-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Lista de Agendamentos</h2>

            <div class="table-responsive mt-4">
                <table class="table table-striped-columns align-middle text-nowrap">
                    <thead class="main-bg">
                        <tr>
                            <th class="fw-bold text-uppercase" scope="col">Ações</th>
                            <th class="fw-bold text-uppercase" scope="col">Data e Hora</th>
                            <th class="fw-bold text-uppercase" scope="col">Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Cliente</th>
                            <th class="fw-bold text-uppercase" scope="col">Telefone</th>
                            <th class="fw-bold text-uppercase" scope="col">Responsável</th>
                            <th class="fw-bold text-uppercase" scope="col">Categoria</th>
                            <th class="fw-bold text-uppercase" scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($agendamentos) > 0) {
                            foreach ($agendamentos as $agend) { ?>
                                <tr>
                                    <td>
                                        <button
                                            data-bs-id_agend="<?= $agend['id_agend'] ?>"
                                            type="button"
                                            class="btn p-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmarAgendModal">
                                            <i class="fa-solid fa-calendar-check fs-3 text-success"></i>
                                        </button>
                                        <button
                                            data-bs-id_agend="<?= $agend['id_agend'] ?>"
                                            type="button"
                                            class="btn p-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#cancelarAgendModal">
                                            <i class="fa-solid fa-calendar-xmark fs-3 text-danger"></i>
                                        </button>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($agend['data_agend'])) . ' | ' . date("H:i", strtotime($agend['hora_agend_inicio'])) ?></td>
                                    <td><?= $agend['nome_pet'] ?></td>
                                    <td><?= $agend['cliente_nome'] ?></td>
                                    <td><?= $agend['cliente_telefone'] ?></td>
                                    <td><?= $agend['responsavel_login'] ?></td>
                                    <td><?= $agend['responsavel_role'] ?></td>
                                    <td><?= $agend['status_real'] == "Atrasado" ? "🔴 " . $agend['status_real'] : "🟢" . $agend['status_real'] ?></td>
                                </tr>
                            <?php  }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="text-center py-3 fs-5">Nenhum agendamento encontrado!!</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        require __DIR__ . "/../Modals/ConfirmarAgendModal.php";
        require __DIR__ . "/../Modals/CancelarAgendModal.php";
        ?>

        <!-- PAGINAÇÃO -->
        <nav class="mt-2 d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <?php
                $query = $_GET;
                unset($query['route']);
                $range = 2;
                $start = max(1, $currentPage - $range);
                $end = min($totalAgendamentos, $currentPage + $range);
                ?>

                <?php if ($currentPage > 1) {
                    $query['page'] = $currentPage - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/confirmacoes?<?= http_build_query($query) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = $start; $i <= $end; $i++) {
                    $query['page'] = $i; ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/confirmacoes?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage < $totalAgendamentos) {
                    $query['page'] = $currentPage + 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/confirmacoes?<?= http_build_query($query) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>