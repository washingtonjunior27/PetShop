<?php require "Header.php" ?>

<div class="container">
    <h1 class="fs-3 fw-bold my-5">Usuários</h1>

    <div class="container p-0 my-4">
        <div class="row g-3">
            <div class="col-12 col-xl-7 bg-white shadow-lg p-3 rounded">
                <div class="rounded">
                    <h2 class="fs-4 fw-bold ">Cadastrar Usuários</h2>
                    <form class="mt-3">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" id="nome" placeholder="Informe o nome do usuário">
                        </div>
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" name="login" class="form-control" id="login" placeholder="Informe o login do usuário">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Informe o email do usuário">
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="number" name="telefone" class="form-control" id="telefone" placeholder="Informe o telefone do usuário">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option selected>Selecionar</option>
                                <option value="Atendente">Atendente</option>
                                <option value="Esteticista">Esteticista</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Informe a senha do usuário">
                        </div>
                        <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg" type="submit">Pesquisar</button>
                </form>

                <div class="bg-white shadow-lg p-3 rounded mt-3">
                    <h2 class="fs-4 fw-bold ">Lista de usuários</h2>

                    <div class="rounded">
                        <div
                            class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                            <div class="d-flex flex-column text-light gap-1">
                                <small>Washington.Junior</small>
                                <small>Esteticista</small>
                                <small>Ativo</small>
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
                    </div>
                </div>

                <nav class="mt-2 d-flex justify-content-center">
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
    </div>
</div>

<?php require "MobileSidenav.php" ?>

<?php require "Footer.php" ?>