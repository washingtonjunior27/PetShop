<div class="px-4">
    <h1 class="fs-3 fw-bold my-5">Histórico de Vacinações</h1>

    <div class="my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/historicoVacinacao">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>



        <div class="bg-white shadow-lg px-3 pt-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Listagem de Vacinações Finalizadas</h2>

            <div class="table-responsive mt-4">
                <table class="table table-striped-columns align-middle text-nowrap">
                    <thead class="main-bg">
                        <tr>
                            <th class="fw-bold text-uppercase" scope="col">Ações</th>
                            <th class="fw-bold text-uppercase" scope="col">Veterinario</th>
                            <th class="fw-bold text-uppercase" scope="col">Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Dono do Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Vacina</th>
                            <th class="fw-bold text-uppercase" scope="col">Data de Aplicação</th>
                            <th class="fw-bold text-uppercase" scope="col">Segunda Dose</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($histVacs) > 0) {
                            foreach ($histVacs as $histVac) { ?>
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" href="<?= BASE_URL ?>/historicoVacinacao/VisualizarHistoricoVacinacao?id_histVac=<?= $histVac['id_vacinacao'] ?>">
                                            <i class="fa-solid fa-eye fs-3 text-primary"></i>
                                        </a>
                                    </td>
                                    <td><?= $histVac['responsavel_login'] ?></td>
                                    <td><?= $histVac['nome_pet'] ?></td>
                                    <td><?= $histVac['cliente_nome'] ?></td>
                                    <td><?= $histVac['nome_servico'] ?></td>
                                    <td><?= date("d/m/Y", strtotime($histVac['data_aplicacao'])) ?></td>
                                    <td><?= (!empty($histVac['data_prox_dose']) && $histVac['data_prox_dose'] !== '0000-00-00')
                                            ? date("d/m/Y", strtotime($histVac['data_prox_dose']))
                                            : "---"
                                        ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8" class="text-center py-3 fs-5">Nenhum historico de vacinação encontrado!!</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php require __DIR__ . "/../Modals/CadastrarVacinacaoAtendimentos.php" ?>


        <!-- PAGINAÇÃO -->
        <nav class="mt-2 d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <?php
                $query = $_GET;
                unset($query['route']);
                $range = 2;
                $start = max(1, $currentPage - $range);
                $end = min($totalHistVacs, $currentPage + $range);
                ?>

                <?php if ($currentPage > 1) {
                    $query['page'] = $currentPage - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/historicoVacinacao?<?= http_build_query($query) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = $start; $i <= $end; $i++) {
                    $query['page'] = $i; ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/historicoVacinacao?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage < $totalHistVacs) {
                    $query['page'] = $currentPage + 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/historicoVacinacao?<?= http_build_query($query) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>