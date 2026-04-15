<div class="px-4">
    <h1 class="fs-3 fw-bold my-5">Histórico de Serviços</h1>

    <div class="my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/historicoServicos">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>



        <div class="bg-white shadow-lg px-3 pt-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Listagem de Históricos de Serviços</h2>

            <div class="table-responsive mt-4">
                <table class="table table-striped-columns align-middle text-nowrap">
                    <thead class="main-bg">
                        <tr>
                            <th class="fw-bold text-uppercase" scope="col">Ações</th>
                            <th class="fw-bold text-uppercase" scope="col">Data</th>
                            <th class="fw-bold text-uppercase" scope="col">Esteticista</th>
                            <th class="fw-bold text-uppercase" scope="col">Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Dono do Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Serviços</th>
                            <th class="fw-bold text-uppercase" scope="col">Observação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($histServs) > 0) {
                            foreach ($histServs as $histServ) { ?>
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" href="<?= BASE_URL ?>/historicoServicos/VisualizarHistoricoServicos?id_histServ=<?= $histServ['id_estetica'] ?>">
                                            <i class="fa-solid fa-eye fs-3 text-primary"></i>
                                        </a>
                                    </td>
                                    <td><?= date('d/m/Y - H:i', strtotime($histServ['created_at'])) ?></td>
                                    <td><?= $histServ['responsavel_login'] ?></td>
                                    <td><?= $histServ['nome_pet'] ?></td>
                                    <td><?= $histServ['cliente_nome'] ?></td>
                                    <td>
                                        <?= $histServ['nomes_servicos'] ?>
                                    </td>
                                    <td class="text-truncate" style="max-width: 250px;"><?= $histServ['observacao'] ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8" class="text-center py-3 fs-5">Nenhum historico de atendimento encontrado!!</td>
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
                $end = min($totalHistServs, $currentPage + $range);
                ?>

                <?php if ($currentPage > 1) {
                    $query['page'] = $currentPage - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/historicoServicos?<?= http_build_query($query) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = $start; $i <= $end; $i++) {
                    $query['page'] = $i; ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/historicoServicos?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage < $totalHistServs) {
                    $query['page'] = $currentPage + 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/historicoServicos?<?= http_build_query($query) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>