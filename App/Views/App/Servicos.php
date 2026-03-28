<div class="container">
    <h1 class="fs-3 fw-bold my-5">Serviços</h1>

    <div class="container p-0 my-4">
        <div class="row g-3">
            <div class="col-12 col-xl-7 bg-white shadow-lg p-3 rounded align-self-start">
                <div class="rounded">
                    <h2 class="fs-4 fw-bold ">Cadastrar Serviços</h2>

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

                    <form class="mt-3" method="POST" action="<?= BASE_URL ?>/servicos/CriarServico">
                        <div class="mb-3">
                            <label for="nome_servico" class="form-label">Nome</label>
                            <input type="text" name="nome_servico" class="form-control" id="nome_servico" placeholder="Informe o nome do serviço">
                        </div>
                        <div class="mb-3">
                            <label for="preço_servico" class="form-label">Preço</label>
                            <input min="1" step="0.01" type="number" name="preco_servico" class="form-control" id="preço_servico" placeholder="Informe o preço do serviço">
                        </div>
                        <div class="d-flex gap-2 flex-column">
                            <label for="categoria_servico">Categoria</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input id="estetica" value="Estetica" class="form-check-input" type="radio" name="categoria_servico">
                                    <label class="form-check-label" for="categoria_servico">
                                        Estetica
                                    </label>
                                </div>
                                <div class="form-check mb-4">
                                    <input id="consulta" value="Consulta" class="form-check-input" type="radio" name="categoria_servico">
                                    <label class="form-check-label" for="categoria_servico">
                                        Consulta
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="duracao_servico" class="form-label">Duração (Minutos) (Min - 30)</label>
                            <input min="30" step="30" type="number" name="duracao_minutos" class="form-control" id="duracao_minutos" placeholder="Informe a duração do serviço em minutos">
                        </div>
                        <div class="mb-3">
                            <label for="descricao_servico" class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao_servico" placeholder="Descreva o serviço caso desejar" id="descricao_servico" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/servicos">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg" type="submit">Pesquisar</button>
                </form>

                <div class="bg-white shadow-lg p-3 rounded mt-3">
                    <h2 class="fs-4 fw-bold ">Lista de Serviços</h2>

                    <div class="rounded">
                        <?php
                        if (count($servicos) > 0) {
                            foreach ($servicos as $servico) { ?>
                                <div
                                    class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                    <div class="d-flex flex-column text-light gap-1">
                                        <small><?= $servico['nome_servico'] ?></small>
                                        <small>R$<?= $servico['preco_servico'] ?></small>
                                        <small><?= $servico['duracao_minutos'] ?> minutos</small>
                                    </div>
                                    <div class="d-flex flex-column align-items-center text-light gap-2">
                                        <button
                                            data-bs-id_servico="<?= $servico['id_servico'] ?>"
                                            data-bs-nome_servico="<?= $servico['nome_servico'] ?>"
                                            data-bs-preco_servico="<?= $servico['preco_servico'] ?>"
                                            data-bs-categoria_servico="<?= $servico['categoria_servico'] ?>"
                                            data-bs-duracao_minutos="<?= $servico['duracao_minutos'] ?>"
                                            data-bs-descricao_servico="<?= $servico['descricao_servico'] ?>"
                                            type="button"
                                            class="btn btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editarServicoModal">
                                            Editar
                                        </button>
                                        <button
                                            data-bs-id_servico="<?= $servico['id_servico'] ?>"
                                            data-bs-nome_servico="<?= $servico['nome_servico'] ?>"
                                            type="button"
                                            class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#excluirServicoModal">
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            <?php    }
                        } else { ?>
                            <div
                                class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                <div class="d-flex flex-column text-light gap-1">
                                    <span>Nenhum serviço encontrado!</span>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

                <?php
                require __DIR__ . "/../Modals/EditarServico.php";
                require __DIR__ . "/../Modals/ExcluirServico.php";
                ?>

                <!-- PAGINAÇÃO -->
                <nav class="mt-2 d-flex justify-content-center align-items-center">
                    <ul class="pagination">
                        <?php
                        $query = $_GET;
                        unset($query['route']);
                        $range = 2;
                        $start = max(1, $currentPage - $range);
                        $end = min($totalServicos, $currentPage + $range);
                        ?>

                        <?php if ($currentPage > 1) {
                            $query['page'] = $currentPage - 1;
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL ?>/servicos?<?= http_build_query($query) ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php for ($i = $start; $i <= $end; $i++) {
                            $query['page'] = $i; ?>
                            <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/servicos?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                        <?php } ?>

                        <?php if ($currentPage < $totalServicos) {
                            $query['page'] = $currentPage + 1;
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL ?>/servicos?<?= http_build_query($query) ?>" aria-label="Next">
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