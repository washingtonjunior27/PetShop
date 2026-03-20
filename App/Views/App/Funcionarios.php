<div class="container">
    <h1 class="fs-3 fw-bold my-5">FUNCIONARIOS</h1>

    <div class="container p-0 my-4">
        <div class="row g-3">
            <div class="col-12 col-xl-7 bg-white shadow-lg p-3 rounded">
                <div class="rounded">
                    <h2 class="fs-4 fw-bold ">Cadastrar Funcionarios</h2>

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

                    <form class="mt-3" method="POST" action="<?= BASE_URL ?>/funcionarios/CriarFuncionario">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" id="nome" placeholder="Informe o nome do funcionario">
                        </div>
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" name="login" class="form-control" id="login" placeholder="Informe o login do funcionario">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Informe o email do funcionario">
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="number" name="telefone" class="form-control" id="telefone" placeholder="Informe o telefone do funcionario">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option selected value="">Selecionar</option>
                                <option value="Atendente">Atendente</option>
                                <option value="Esteticista">Esteticista</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Informe a senha do funcionario">
                        </div>
                        <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/funcionarios">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg" type="submit">Pesquisar</button>
                </form>

                <div class="bg-white shadow-lg p-3 rounded mt-3">
                    <h2 class="fs-4 fw-bold ">Lista de usuários</h2>

                    <div class="rounded">
                        <?php
                        if (count($funcionarios) > 0) {
                            foreach ($funcionarios as $result) { ?>
                                <div
                                    class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                    <div class="d-flex flex-column text-light gap-1">
                                        <small><?= $result['login'] ?></small>
                                        <small><?= $result['role'] ?></small>
                                        <small><?= $result['status'] ?></small>
                                    </div>
                                    <div class="d-flex align-items-center text-light gap-2">
                                        <button
                                            data-bs-id="<?= $result['id'] ?>"
                                            data-bs-nome="<?= $result['nome'] ?>"
                                            data-bs-login="<?= $result['login'] ?>"
                                            data-bs-email="<?= $result['email'] ?>"
                                            data-bs-telefone="<?= $result['telefone'] ?>"
                                            data-bs-role="<?= $result['role'] ?>"
                                            data-bs-status="<?= $result['status'] ?>"
                                            type="button"
                                            class="btn btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editarFuncionarioModal">
                                            Editar
                                        </button>
                                        <button
                                            data-bs-id="<?= $result['id'] ?>"
                                            data-bs-role="<?= $result['role'] ?>"
                                            data-bs-login="<?= $result['login'] ?>"
                                            type="button"
                                            class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#excluirFuncionarioModal">
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <div
                                class="text-light main-bg py-4 d-flex align-items-center justify-content-center rounded mt-4 px-3">
                                <div class="d-flex flex-column text-light gap-1">
                                    <h5 class="mb-0">Nenhum funcionário encontrado!</h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- PAGINAÇÃO -->
                <nav class="mt-2 d-flex justify-content-center">
                    <ul class="pagination">
                        <?php
                        $query = $_GET;
                        unset($query['route']);
                        $range = 2;
                        $start = max(1, $currentPage - $range);
                        $end = min($totalFuncionarios, $currentPage + $range);
                        ?>

                        <?php if ($currentPage > 1) {
                            $query['page'] = $currentPage - 1;
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL ?>/funcionarios?<?= http_build_query($query) ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php for ($i = $start; $i <= $end; $i++) {
                            $query['page'] = $i; ?>
                            <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/funcionarios?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                        <?php } ?>

                        <?php if ($currentPage < $totalFuncionarios) {
                            $query['page'] = $currentPage + 1;
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL ?>/funcionarios?<?= http_build_query($query) ?>" aria-label="Next">
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

<!-- MODALS -->
<?php
require __DIR__ . "/../Modals/ExcluirFuncionario.php";
require __DIR__ . "/../Modals/EditarFuncionario.php";
?>