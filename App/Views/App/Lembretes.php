<div class="px-4">
    <h1 class="fs-3 fw-bold my-5">Lembretes</h1>

    <div class="my-4">
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

                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/lembretes">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>

        <span class="d-block my-4 p-2  shadow-lg text-bg-light rounded text-center">
            <strong>Atenção!!!</strong> Finalize as vacinações que passaram do prazo e não terão retorno ou as que foram confirmadas por clientes.
            <br><strong>Lembre-se</strong> de abrir novo agendamento para as confirmações.
        </span>

        <div class="bg-white shadow-lg px-3 pt-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Lista de Vacinações Pendentes</h2>

            <div class="table-responsive mt-4">
                <table class="table table-striped-columns align-middle text-nowrap">
                    <thead class="main-bg">
                        <tr>
                            <th class="fw-bold text-uppercase" scope="col">Ações</th>
                            <th class="fw-bold text-uppercase" scope="col">Data de Aplicação</th>
                            <th class="fw-bold text-uppercase" scope="col">Segunda Dose</th>
                            <th class="fw-bold text-uppercase" scope="col">Responsavel</th>
                            <th class="fw-bold text-uppercase" scope="col">Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Cliente</th>
                            <th class="fw-bold text-uppercase" scope="col">Telefone</th>
                            <th class="fw-bold text-uppercase" scope="col">Vacina</th>
                            <th class="fw-bold text-uppercase" scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($lembretes) > 0) {
                            foreach ($lembretes as $lemb) { ?>
                                <tr>
                                    <td>
                                        <button
                                            data-bs-id_vacinacao="<?= $lemb['id_vacinacao'] ?>"
                                            type="button"
                                            class="border-0 bg-white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#resolvidoLembreteModal">
                                            <i class="fa-solid fa-check fs-3 text-success"></i>
                                        </button>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($lemb['data_aplicacao'])) ?></td>
                                    <td><?= !empty($lemb['data_prox_dose']) && $lemb['data_prox_dose'] !== '0000-00-00' ? date('d/m/Y', strtotime($lemb['data_prox_dose'])) : '---' ?></td>
                                    <td><?= $lemb['responsavel_login'] ?></td>
                                    <td><?= $lemb['nome_pet'] ?></td>
                                    <td><?= $lemb['cliente_nome'] ?></td>
                                    <td><?= $lemb['telefone_cliente'] ?></td>
                                    <td><?= $lemb['nome_servico'] ?></td>
                                    <td><?= $lemb['status_real'] ?></td>
                                </tr>
                            <?php   }
                        } else { ?>
                            <tr>
                                <td colspan="9" class="text-center py-3 fs-5">Nenhum lembrete de vacinação encontrado!!</td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <?php require __DIR__ . "/../Modals/ResolvidoLembrete.php" ?>


        <!-- PAGINAÇÃO -->
        <nav class="mt-2 d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <?php
                $query = $_GET;
                unset($query['route']);
                $range = 8;
                $start = max(1, $currentPage - $range);
                $end = min($totalLembretes, $currentPage + $range);
                ?>

                <?php if ($currentPage > 1) {
                    $query['page'] = $currentPage - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/lembretes?<?= http_build_query($query) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = $start; $i <= $end; $i++) {
                    $query['page'] = $i; ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/lembretes?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage < $totalLembretes) {
                    $query['page'] = $currentPage + 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/lembretes?<?= http_build_query($query) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>