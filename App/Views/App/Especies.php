<div class="container">
    <h1 class="fs-3 fw-bold my-5">Espécies</h1>

    <div class="container p-0 my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <h2 class="fs-4 fw-bold ">Cadastrar Espécie</h2>

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

                <form class="mt-3" method="POST" action="<?= BASE_URL ?>/especies/CriarEspecie">
                    <div class="mb-3">
                        <label for="nome_especie" class="form-label">Nome da Espécie</label>
                        <input type="text" name="nome_especie" class="form-control" id="nome_especie" placeholder="Informe a espécie">
                    </div>
                    <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                </form>
            </div>
        </div>

        <form class="d-flex mt-3" role="search" method="GET" action="<?= BASE_URL ?>/especies">
            <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
            <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
        </form>

        <div class="bg-white shadow-lg p-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Lista de Espécies</h2>

            <div class="rounded">
                <?php
                if (count($especies)) {
                    foreach ($especies as $especie) { ?>
                        <div
                            class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                            <div class="d-flex flex-column text-light">
                                <span><?= $especie['nome_especie'] ?></span>
                            </div>
                            <div class="d-flex align-items-center text-light gap-2">
                                <form action="">
                                    <button class="btn btn-warning">Editar</button>
                                </form>
                                <form action="">
                                    <button class="btn btn-danger">Excluir</button>
                                </form>
                            </div>
                        </div>
                    <?php  }
                } else { ?>
                    <div
                        class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                        <div class="d-flex flex-column text-light">
                            <span>Nenhuma espécie encontrada!</span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <nav class="mt-2 d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <?php
                $query = $_GET;
                unset($query['route']);
                $range = 2;
                $start = max(1, $currentPage - $range);
                $end = min($totalEspecies, $currentPage + $range);
                ?>

                <?php if ($currentPage > 1) {
                    $query['page'] = $currentPage - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/especies?<?= http_build_query($query) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = $start; $i <= $end; $i++) {
                    $query['page'] = $i; ?>
                    <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/especies?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($currentPage < $totalEspecies) {
                    $query['page'] = $currentPage + 1;
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/especies?<?= http_build_query($query) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

</div>