<div class="container">
    <h1 class="fs-3 fw-bold my-5">Vacinação</h1>

    <button
        type="button"
        class="btn main-bg text-light"
        data-bs-toggle="modal"
        data-bs-target="#cadastrarVacinacaoModal">
        Nova
    </button>

    <?php if (isset($_SESSION['erro'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <?= $_SESSION['erro'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }
    unset($_SESSION['erro']) ?>

    <?php if (isset($_SESSION['sucesso'])) { ?>
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            <?= $_SESSION['sucesso'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }
    unset($_SESSION['sucesso']) ?>

    <div class="container p-0 my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/meusServicos">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>



        <div class="bg-white shadow-lg px-3 pt-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Lista de Vacinações</h2>

            <div class="table-responsive mt-4">
                <table class="table table-striped-columns align-middle text-nowrap">
                    <thead class="main-bg">
                        <tr>
                            <th class="fw-bold text-uppercase" scope="col">Ações</th>
                            <th class="fw-bold text-uppercase" scope="col">Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Dono</th>
                            <th class="fw-bold text-uppercase" scope="col">Vacina</th>
                            <th class="fw-bold text-uppercase" scope="col">Data de Aplicação</th>
                            <th class="fw-bold text-uppercase" scope="col">Prox. Dose</th>
                            <th class="fw-bold text-uppercase" scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <i class="fa-solid fa-check-double fs-3 text-success"></i>
                                <i class="fa-solid fa-calendar-xmark fs-3 text-danger"></i>
                            </td>
                            <td>Lady</td>
                            <td>Erica Penafort</td>
                            <td>V8</td>
                            <td>29/03/2026</td>
                            <td>29/03/2027</td>
                            <td>🟢 Em dia</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-check-double fs-3 text-success"></i>
                                <i class="fa-solid fa-calendar-xmark fs-3 text-danger"></i>
                            </td>
                            <td>Lady</td>
                            <td>Erica Penafort</td>
                            <td>V8</td>
                            <td>29/03/2026</td>
                            <td>---</td>
                            <td>🟢 Finalizada</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-check-double fs-3 text-success"></i>
                                <i class="fa-solid fa-calendar-xmark fs-3 text-danger"></i>
                            </td>
                            <td>Lady</td>
                            <td>Erica Penafort</td>
                            <td>V8</td>
                            <td>10/04/2025</td>
                            <td>10/04/2026</td>
                            <td>🟠 Atenção</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa-solid fa-check-double fs-3 text-success"></i>
                                <i class="fa-solid fa-calendar-xmark fs-3 text-danger"></i>
                            </td>
                            <td>Lady</td>
                            <td>Erica Penafort</td>
                            <td>V8</td>
                            <td>10/03/2025</td>
                            <td>10/03/2026</td>
                            <td>🔴 Atrasada</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <nav class="mt-2 d-flex justify-content-center align-items-center">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php require __DIR__ . "/../Modals/CadastrarVacinacao.php"; ?>