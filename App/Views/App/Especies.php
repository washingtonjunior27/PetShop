<div class="container">
    <h1 class="fs-3 fw-bold my-5">Espécies</h1>

    <div class="container p-0 my-4">
        <div class="bg-white shadow-lg p-3 rounded w-100">
            <div class="rounded">
                <h2 class="fs-4 fw-bold ">Cadastrar Espécie</h2>
                <form class="mt-3">
                    <div class="mb-3">
                        <label for="nome_especie" class="form-label">Nome da Espécie</label>
                        <input type="text" name="nome_especie" class="form-control" id="nome_especie" placeholder="Informe a espécie">
                    </div>
                    <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                </form>
            </div>
        </div>

        <form class="d-flex mt-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
            <button class="btn text-light main-bg w-25" type="submit">Pesquisar</button>
        </form>

        <div class="bg-white shadow-lg p-3 rounded mt-3">
            <h2 class="fs-4 fw-bold ">Lista de Espécies</h2>

            <div class="rounded">
                <div
                    class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                    <div class="d-flex flex-column text-light">
                        <span>Cachorro</span>
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