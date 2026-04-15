<div class="container">
    <h1 class="fs-3 fw-bold my-5">Raças</h1>

    <div class="container p-0 my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <h2 class="fs-4 fw-bold ">Cadastrar Raça</h2>

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

                <form class="mt-3" method="POST" action="<?= BASE_URL ?>/racas/CriarRaca">
                    <div class="mb-3">
                        <label for="role" class="form-label">Espécie</label>
                        <select name="id_especie_fk" id="id_especie_fk" class="form-select">
                            <option value="" selected>Selecionar</option>
                            <?php foreach ($especies as $especie) { ?>
                                <option value="<?= $especie['id_especie'] ?>"><?= $especie['nome_especie'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nome_raca" class="form-label">Nome da Raça</label>
                        <input type="text" name="nome_raca" class="form-control" id="nome_raca" placeholder="Informe a raça">
                    </div>
                    <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                </form>
            </div>
        </div>

        <form class="d-flex mt-3" role="search" method="GET" action="<?= BASE_URL ?>/racas">
            <input class="form-control me-2" name="search" type="search" placeholder="Pesquisar" aria-label="Search" />
            <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
        </form>

        <div class="bg-white shadow-lg p-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Lista de Raças</h2>

            <div class="rounded">
                <?php
                if (count($racas) > 0) {
                    foreach ($racas as $raca) { ?>
                        <div
                            class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                            <div class="d-flex flex-column text-light gap-1">
                                <span><?= $raca['nome_raca'] ?></span>
                                <span><?= $raca['nome_especie'] ?></span>
                            </div>
                            <div class="d-flex align-items-center text-light gap-2">
                                <button
                                    data-bs-id_raca="<?= $raca['id_raca'] ?>"
                                    data-bs-nome_raca="<?= $raca['nome_raca'] ?>"
                                    data-bs-id_especie_fk="<?= $raca['id_especie_fk'] ?>"
                                    type="button"
                                    class="btn btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editarRacaModal">Editar
                                </button>
                                <button
                                    data-bs-id_raca="<?= $raca['id_raca'] ?>"
                                    data-bs-nome_raca="<?= $raca['nome_raca'] ?>"
                                    type="button"
                                    class="btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#excluirRacaModal">
                                    Excluir
                                </button>
                            </div>
                        </div>
                    <?php    }
                } else { ?>
                    <div
                        class="text-light main-bg py-4 d-flex align-items-center justify-content-center rounded mt-4 px-3">
                        <div class="d-flex flex-column text-light gap-1">
                            <span class="text-uppercase fw-bold">Nenhuma raça encontrada!</span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php
        require __DIR__ . "/../Modals/EditarRaca.php";
        require __DIR__ . "/../Modals/ExcluirRaca.php";
        ?>

        <!-- PAGINAÇÃO -->
        <nav class="mt-2 d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <?php
                $query = $_GET;
                unset($query['route']);
                $range = 2;
                $start = max(1, $currentPage - $range);
                $end = min($totalRacas, $currentPage + $range);
                ?>

                <?php if ($currentPage > 1) {
                    $query['page'] = $currentPage - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/racas?<?= http_build_query($query) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = $start; $i <= $end; $i++) {
                    $query['page'] = $i; ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/racas?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage < $totalRacas) {
                    $query['page'] = $currentPage + 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/racas?<?= http_build_query($query) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

</div>