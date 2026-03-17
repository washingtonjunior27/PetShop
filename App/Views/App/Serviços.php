<?php require __DIR__ . "/../Layouts/Header.php" ?>

<div class="container">
    <h1 class="fs-3 fw-bold my-5">Serviços</h1>

    <div class="container p-0 my-4">
        <div class="row g-3">
            <div class="col-12 col-xl-7 bg-white shadow-lg p-3 rounded">
                <div class="rounded">
                    <h2 class="fs-4 fw-bold ">Cadastrar Serviços</h2>
                    <form class="mt-3">
                        <div class="mb-3">
                            <label for="nome_servico" class="form-label">Nome</label>
                            <input type="text" name="nome_servico" class="form-control" id="nome_servico" placeholder="Informe o nome do serviço">
                        </div>
                        <div class="mb-3">
                            <label for="preço_servico" class="form-label">Preço</label>
                            <input type="text" name="preço_servico" class="form-control" id="preço_servico" placeholder="Informe o preço do serviço">
                        </div>
                        <div class="mb-3">
                            <label for="duracao_servico" class="form-label">Duração</label>
                            <input type="text" name="duracao_servico" class="form-control" id="duracao_servico" placeholder="Informe a duração do serviço">
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
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg" type="submit">Pesquisar</button>
                </form>

                <div class="bg-white shadow-lg p-3 rounded mt-3">
                    <h2 class="fs-4 fw-bold ">Lista de Serviços</h2>

                    <div class="rounded">
                        <div
                            class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                            <div class="d-flex flex-column text-light gap-1">
                                <small>Banho</small>
                                <small>R$60,00</small>
                                <small>60 minutos</small>
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

<?php require __DIR__ . "/../Layouts/MobileSidenav.php" ?>

<?php require __DIR__ . "/../Layouts/Footer.php" ?>