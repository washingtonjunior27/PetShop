<div class="px-4">
    <h1 class="fs-3 fw-bold my-5">Histórico de Atendimentos</h1>

    <div class=p-0 my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/historicoMedico">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>



        <div class="bg-white shadow-lg px-3 pt-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Listagem de Históricos de Atendimentos</h2>

            <div class="table-responsive mt-4">
                <table class="table table-striped-columns align-middle text-nowrap">
                    <thead class="main-bg">
                        <tr>
                            <th class="fw-bold text-uppercase" scope="col">Ações</th>
                            <th class="fw-bold text-uppercase" scope="col">Data de Atendimento</th>
                            <th class="fw-bold text-uppercase" scope="col">Veterinario</th>
                            <th class="fw-bold text-uppercase" scope="col">Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Dono do Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Anamnese</th>
                            <th class="fw-bold text-uppercase" scope="col">Diagnostico</th>
                            <th class="fw-bold text-uppercase" scope="col">Tratamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($histMeds) > 0) {
                            foreach ($histMeds as $histMed) { ?>
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" href="<?= BASE_URL ?>/historicoMedico/VisualizarHistoricoMedico?id_histAtend=<?= $histMed['id_atendimento'] ?>">
                                            <i class="fa-solid fa-eye fs-3 text-primary"></i>
                                        </a>
                                    </td>
                                    <td><?= date('d/m/Y - H:i', strtotime($histMed['created_at'])) ?></td>
                                    <td><?= $histMed['responsavel_login'] ?></td>
                                    <td><?= $histMed['nome_pet'] ?></td>
                                    <td><?= $histMed['cliente_nome'] ?></td>
                                    <td class="text-truncate" style="max-width: 250px;"><?= $histMed['anamnese'] ?></td>
                                    <td class="text-truncate" style="max-width: 200px;"><?= $histMed['diagnostico'] ?></td>
                                    <td class="text-truncate" style="max-width: 200px;"><?= $histMed['tratamento'] ?></td>
                                </tr>
                            <?php   }
                        } else { ?>
                            <tr>
                                <td colspan="8" class="text-center py-3 fs-5">Nenhum historico de atendimento encontrado!!</td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAGINAÇÃO -->
        <nav class="mt-2 d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <?php
                $query = $_GET;
                unset($query['route']);
                $range = 2;
                $start = max(1, $currentPage - $range);
                $end = min($totalHistMeds, $currentPage + $range);
                ?>

                <?php if ($currentPage > 1) {
                    $query['page'] = $currentPage - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/historicoMedico?<?= http_build_query($query) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = $start; $i <= $end; $i++) {
                    $query['page'] = $i; ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/historicoMedico?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage < $totalHistMeds) {
                    $query['page'] = $currentPage + 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/historicoMedico?<?= http_build_query($query) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>