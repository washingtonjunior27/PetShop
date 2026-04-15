<div class="px-4">
    <h1 class="fs-3 fw-bold my-5">Pets</h1>

    <div class="my-4">
        <div class="row g-3">
            <div class="col-12 col-xl-7 bg-white shadow-lg p-3 rounded">
                <div class="rounded">
                    <h2 class="fs-4 fw-bold ">Cadastrar Pet</h2>

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

                    <form class="mt-3" method="POST" action="<?= BASE_URL ?>/pets/CriarPet">
                        <!-- Nome -->
                        <div class="mb-3">
                            <label for="nome_pet" class="form-label">Nome</label>
                            <input type="text" name="nome_pet" class="form-control" id="nome_pet" placeholder="Informe o nome do pet">
                        </div>
                        <!-- CLIENTE -->
                        <div class="mb-3">
                            <label for="cliente_id_fk" class="form-label">Cliente (Dono)</label>
                            <select name="cliente_id_fk" id="cliente_id_fk" class="form-select">
                                <option value="" selected>Selecionar</option>
                                <?php foreach ($clientes as $cliente) { ?>
                                    <option value="<?= $cliente['id'] ?>"><?= $cliente['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- ESPECIE -->
                        <div class="mb-3">
                            <label for="especie_id_fk" class="form-label">Espécie</label>
                            <select name="especie_id_fk" id="especie_id_fk" class="form-select" data-url="<?= BASE_URL ?>/pets/buscarRacas">
                                <option value="" selected>Selecionar</option>
                                <?php foreach ($especies as $especie) { ?>
                                    <option value="<?= $especie['id_especie'] ?>"><?= $especie['nome_especie'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- RAÇA -->
                        <div class="mb-3">
                            <label for="raca_id_fk" class="form-label">Raça</label>
                            <select name="raca_id_fk" id="raca_id_fk" class="form-select" disabled>
                                <option value="">Selecione primeiro a espécie</option>
                            </select>
                        </div>
                        <!-- SEXO -->
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input id="sexo_macho" value="Macho" class="form-check-input" type="radio" name="sexo_pet">
                                <label class="form-check-label" for="sexo_pet">
                                    Macho
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input id="sexo_femea" value="Femea" class="form-check-input" type="radio" name="sexo_pet">
                                <label class="form-check-label" for="sexo_pet">
                                    Femea
                                </label>
                            </div>
                        </div>
                        <!-- COR -->
                        <div class="mb-3">
                            <label for="cor_pet" class="form-label">Cor</label>
                            <input type="text" name="cor_pet" class="form-control" id="cor_pet" placeholder="Informe a cor do pet">
                        </div>
                        <!-- PESO -->
                        <div class="mb-3">
                            <label for="peso_pet" class="form-label">Peso (Kg)</label>
                            <input type="number" min="1" step="0.1" name="peso_pet" class="form-control" id="peso_pet" placeholder="Informe o peso do pet">
                        </div>
                        <button type="submit" class="btn btn-primary main-bg w-25">Cadastrar</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <form class="d-flex" role="search" method="GET" action="<?= BASE_URL ?>/pets">
                    <input name="search" class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
                    <button class="btn text-light main-bg" type="submit">Pesquisar</button>
                </form>

                <div class="bg-white shadow-lg p-3 rounded mt-3">
                    <h2 class="fs-4 fw-bold ">Lista de Pets</h2>

                    <div class="rounded">
                        <?php
                        if (count($pets) > 0) {
                            foreach ($pets as $pet) { ?>
                                <div
                                    class="text-light main-bg py-2 d-flex align-items-center justify-content-between rounded mt-4 px-3">
                                    <div class="d-flex flex-column text-light gap-1">
                                        <small><?= $pet['nome_pet'] ?></small>
                                        <small><?= $pet['nome'] ?></small>
                                        <small><?= $pet['nome_especie'] ?></small>
                                    </div>
                                    <div class="d-flex flex-column align-items-center text-light gap-2">
                                        <button
                                            data-bs-id_pet="<?= $pet['id_pet'] ?>"
                                            data-bs-nome_pet="<?= $pet['nome_pet'] ?>"
                                            data-bs-id_cliente="<?= $pet['cliente_id_fk'] ?>"
                                            data-bs-id_especie="<?= $pet['especie_id_fk'] ?>"
                                            data-bs-id_raca="<?= $pet['raca_id_fk'] ?>"
                                            data-bs-sexo_pet="<?= $pet['sexo_pet'] ?>"
                                            data-bs-cor_pet="<?= $pet['cor_pet'] ?>"
                                            data-bs-peso_pet="<?= $pet['peso_pet'] ?>"
                                            type="button"
                                            class="btn btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editarPetModal">
                                            Editar
                                        </button>
                                        <button
                                            data-bs-id_pet="<?= $pet['id_pet'] ?>"
                                            data-bs-nome_pet="<?= $pet['nome_pet'] ?>"
                                            type="button"
                                            class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#excluirPetModal">
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            <?php        }
                        } else { ?>
                            <div
                                class="text-light main-bg py-4 d-flex align-items-center justify-content-center rounded mt-4 px-3">
                                <div class="d-flex flex-column text-light gap-1">
                                    <span>Nenhum pet encontrado!</span>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

                <?php
                require __DIR__ . "/../Modals/EditarPet.php";
                require __DIR__ . "/../Modals/ExcluirPet.php";
                ?>

                <!-- PAGINAÇÃO -->
                <nav class="mt-2 d-flex justify-content-center align-items-center">
                    <ul class="pagination">
                        <?php
                        $query = $_GET;
                        unset($query['route']);
                        $range = 2;
                        $start = max(1, $currentPage - $range);
                        $end = min($totalPets, $currentPage + $range);
                        ?>

                        <?php if ($currentPage > 1) {
                            $query['page'] = $currentPage - 1;
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL ?>/pets?<?= http_build_query($query) ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php for ($i = $start; $i <= $end; $i++) {
                            $query['page'] = $i; ?>
                            <li class="page-item <?= $i == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?= BASE_URL ?>/pets?<?= http_build_query($query) ?>"><?= $i ?></a></li>
                        <?php } ?>

                        <?php if ($currentPage < $totalPets) {
                            $query['page'] = $currentPage + 1;
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= BASE_URL ?>/pets?<?= http_build_query($query) ?>" aria-label="Next">
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