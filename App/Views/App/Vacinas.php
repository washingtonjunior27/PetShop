<div class="container">
    <h1 class="fs-3 fw-bold my-5">Vacinas</h1>

    <div class="container p-0 my-4">
        <div class="row g-3">
            <div class="col-12 col-xl-7 bg-white shadow-lg p-3 rounded">
                <div class="rounded">
                    <h2 class="fs-4 fw-bold ">Cadastrar Vacinas</h2>

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

                    <form class="mt-3" method="POST" action="<?= BASE_URL ?>/vacinas/CriarVacina">
                        <div class="mb-3">
                            <label for="nome_vacina" class="form-label">Nome</label>
                            <input type="text" name="nome_vacina" class="form-control" id="nome_vacina" placeholder="Informe o nome da vacina">
                        </div>
                        <div class="mb-3">
                            <label for="preço_vacina" class="form-label">Preço</label>
                            <input type="number" min="1" step="0.01" name="preco_vacina" class="form-control" id="preco_vacina" placeholder="Informe o preço da vacina">
                        </div>
                        <div class="mb-3">
                            <label for="duracao_retorno" class="form-label">Duração para Retorno (Dias/Caso necessário)</label>
                            <input type="number" min="1" step="1" name="duracao_retorno" class="form-control" id="duracao_retorno" placeholder="Informe a duração da vacina">
                        </div>
                        <div class="mb-3">
                            <label for="descricao_vacina" class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao_vacina" placeholder="Descreva para que serve a vacina caso desejar" id="descricao_vacina" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/vacinas">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg" type="submit">Pesquisar</button>
                </form>

                <div class="bg-white shadow-lg p-3 rounded mt-3">
                    <h2 class="fs-4 fw-bold ">Lista de Vacinas</h2>

                    <div class="rounded">
                        <?php
                        if (count($vacinas) > 0) {
                            foreach ($vacinas as $vacina) { ?>
                                <div
                                    class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                    <div class="d-flex flex-column text-light gap-1">
                                        <small><?= $vacina['nome_vacina'] ?></small>
                                        <small><?= $vacina['preco_vacina'] ?></small>
                                    </div>
                                    <div class="d-flex flex-column align-items-center text-light gap-2">
                                        <form action="">
                                            <button class="btn btn-warning">Editar</button>
                                        </form>
                                        <form action="">
                                            <button class="btn btn-danger">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            <?php    }
                        } else { ?>
                            <div
                                class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                <div class="d-flex flex-column text-light gap-1">
                                    <span>Nenhuma vacina encontrada!</span>
                                </div>
                            </div>
                        <?php } ?>

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
                        $end = min($totalVacinas, $currentPage + $range);
                        ?>

                        <?php if ($currentPage > 1) {
                            $query['page'] = $currentPage - 1;
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL ?>/vacinas?<?= http_build_query($query) ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php for ($i = $start; $i <= $end; $i++) {
                            $query['page'] = $i; ?>
                            <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/vacinas?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                        <?php } ?>

                        <?php if ($currentPage < $totalVacinas) {
                            $query['page'] = $currentPage + 1;
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL ?>/vacinas?<?= http_build_query($query) ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>