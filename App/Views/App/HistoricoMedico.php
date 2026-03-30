<div class="container">
    <h1 class="fs-3 fw-bold my-5">Histórico Médico</h1>

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
            <h2 class="fs-4 fw-bold ">Listagem de Históricos Médicos</h2>

            <div class="table-responsive mt-4">
                <table class="table table-striped-columns align-middle text-nowrap">
                    <thead class="main-bg">
                        <tr>
                            <th class="fw-bold text-uppercase" scope="col">Ações</th>
                            <th class="fw-bold text-uppercase" scope="col">Data</th>
                            <th class="fw-bold text-uppercase" scope="col">Veterinario</th>
                            <th class="fw-bold text-uppercase" scope="col">Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Dono do Pet</th>
                            <th class="fw-bold text-uppercase" scope="col">Anamnese</th>
                            <th class="fw-bold text-uppercase" scope="col">Diagnostico</th>
                            <th class="fw-bold text-uppercase" scope="col">Tratamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a class="text-decoration-none" href="<?= BASE_URL ?>/historicoMedico/VisualizarHistoricoMedico">
                                    <i class="fa-solid fa-eye fs-3 text-primary"></i>
                                </a>
                            </td>
                            <td>30/03/2026</td>
                            <td>washington.junior</td>
                            <td>Lady</td>
                            <td>Erica Penafort</td>
                            <td class="text-truncate" style="max-width: 250px;">Paciente alega que cachorro está liberando secreção pela vagina, fraco, chorando de dor e com dificuldade para necessidades essencias como respirar e fazer xixi.</td>
                            <td class="text-truncate" style="max-width: 200px;">Piometria</td>
                            <td class="text-truncate" style="max-width: 200px;">Procedimento Cirurgico Necessário!</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <?php require __DIR__ . "/../Modals/CadastrarVacinacaoAtendimentos.php" ?>


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