<!-- IDENTIFICA PAGINA PARA ACTIVE CLASS -->
<?php $page = $_GET['route'] ?? 'home' ?>


<!-- HOME -->
<div class="sidenav-item w-100 ps-5 <?= $page == "home" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/home" class="nav-link d-flex align-items-center gap-3">
        <i class="fa-solid fa-house text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Inicio</span>
    </a>
</div>

<!-- DROPDOWN MENU USERS PARA ADMIN -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <a class="btn rounded-0 main-bg text-light w-100 px-5 d-flex justify-content-between align-items-center <?= $page == "funcionarios" || $page == "veterinarios" || $page == "clientes" ? "active" : "" ?>"
        data-bs-toggle="collapse"
        href="#usuariosSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-users text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Usuários</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>
<?php } ?>

<div class="collapse w-100" id="usuariosSidebar">
    <div class="ps-5">
        <div class="main-bg border-2 border-light border-start ps-3 d-flex flex-column gap-3">
            <?php if ($_SESSION['user']['role'] === "Admin") { ?>
                <a href="<?= BASE_URL ?>/funcionarios" class="nav-link <?= $page == "funcionarios" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Funcionários</span>
                </a>
                <a href="<?= BASE_URL ?>/veterinarios" class="nav-link <?= $page == "veterinarios" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Veterinarios</span>
                </a>
            <?php } ?>
            <a href="<?= BASE_URL ?>/clientes" class="nav-link <?= $page == "clientes" ? "active py-2 rounded-start ps-2" : "" ?>">
                <span class="text-light fs-6 fw-semibold">Clientes</span>
            </a>
        </div>
    </div>
</div>

<!-- CLIENTES PARA ATENDENTE FORA DE DROPDOWN -->
<?php if ($_SESSION['user']['role'] == "Atendente") { ?>
    <div class="sidenav-item w-100 ps-5 <?= $page == "clientes" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/clientes" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-user text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Clientes</span>
        </a>
    </div>
<?php } ?>

<!-- DROPDOWN CADASTROS DE ESPECIES, RACAS, SERVICOS E VACINAS PARA ADMIN -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <a class="btn rounded-0 main-bg text-light w-100 px-5 d-flex justify-content-between align-items-center <?= ($page == "especies") || ($page == "racas") || ($page == "servicos") || ($page == "vacinas") ? "active" : "" ?>"
        data-bs-toggle="collapse"
        href="#cadastrosSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-paw text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Cadastros</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="cadastrosSidebar">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start ps-3 d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/especies" class="nav-link <?= $page == "especies" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Especies</span>
                </a>
                <a href="<?= BASE_URL ?>/racas" class="nav-link <?= $page == "racas" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Raças</span>
                </a>
                <a href="<?= BASE_URL ?>/servicos" class="nav-link <?= $page == "servicos" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Serviços</span>
                </a>
                <a href="<?= BASE_URL ?>/vacinas" class="nav-link <?= $page == "vacinas" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Vacinas</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- PETS PARA ADMIN E ATENDENTE-->
<?php if ($_SESSION['user']['role'] === "Admin" || $_SESSION['user']['role'] === "Atendente") { ?>
    <div class="sidenav-item w-100 ps-5 <?= $page == "pets" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/pets" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-dog text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Pets</span>
        </a>
    </div>
<?php } ?>

<!-- AGENDAMENTOS -->
<?php if ($_SESSION['user']['role'] === "Admin" || $_SESSION['user']['role'] === "Atendente") { ?>
    <a class="btn rounded-0 main-bg text-light w-100 px-5 d-flex justify-content-between align-items-center <?= ($page == "agendamentos") || ($page == "confirmacoes") ? "active" : "" ?>"
        data-bs-toggle="collapse"
        href="#agendaSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-regular fa-calendar-days text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Agenda</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="agendaSidebar">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start ps-3 d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/agendamentos" class="nav-link <?= $page == "agendamentos" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Agendamentos</span>
                </a>
                <a href="<?= BASE_URL ?>/confirmacoes" class="nav-link <?= $page == "confirmacoes" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Confirmações</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Atendimento - Meus serviços e Atendimentos - ADMIN -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <a class="btn rounded-0 main-bg text-light w-100 px-5 d-flex justify-content-between align-items-center <?= ($page == "meusServicos") || ($page == "atendimentos") ? "active" : "" ?>"
        data-bs-toggle="collapse"
        href="#atendimentoSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-stethoscope text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Atendimento</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="atendimentoSidebar">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start ps-3 d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/meusServicos" class="nav-link <?= $page == "meusServicos" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Meus Serviços</span>
                </a>
                <a href="<?= BASE_URL ?>/atendimentos" class="nav-link <?= $page == "atendimentos" ? "active py-2 rounded-start ps-2" : "" ?>">

                    <span class="text-light fs-6 fw-semibold">Atendimentos</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- MEUS SERVIÇOS DO ESTETICISTA -->
<?php if ($_SESSION['user']['role'] === "Esteticista") { ?>
    <div class="sidenav-item w-100 ps-5 <?= $page == "meusServicos" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/meusServicos" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-shower text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Meus Serviços</span>
        </a>
    </div>
<?php } ?>

<!-- ATENDIMENTOS VETERINARIO -->
<?php if ($_SESSION['user']['role'] === "Veterinario") { ?>
    <div class="sidenav-item w-100 ps-5 <?= $page == "atendimentos" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/atendimentos" class="nav-link d-flex align-items-center gap-3 ">

            <i class="fa-solid fa-stethoscope text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Atendimentos</span>
        </a>
    </div>
<?php } ?>


<!-- HISTORICOS - ADMIN -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <a class="btn rounded-0 main-bg text-light w-100 px-5 d-flex justify-content-between align-items-center <?= ($page == "historico") || ($page == "historicoServicos") ? "active" : "" ?>"
        data-bs-toggle="collapse"
        href="#historicoSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-regular fa-clock fs-2 text-light"></i>
            <span class="text-light fs-6 fw-semibold">Histórico</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="historicoSidebar">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start ps-3 d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/historico" class="nav-link <?= $page == "historico" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Historico Medico</span>
                </a>
                <a href="<?= BASE_URL ?>/historicoServicos" class="nav-link <?= $page == "historicoServicos" ? "active py-2 rounded-start ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Historico de Serviços</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- HISTORICO MEDICO VETERINARIO -->
<?php if ($_SESSION['user']['role'] === "Veterinario") { ?>
    <div class="sidenav-item w-100 ps-5 <?= $page == "historico" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/historico" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-regular fa-file-lines text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Historico Medico</span>
        </a>
    </div>
<?php } ?>


<!-- HISTORICO DE SERVIÇOS ESTETICISTA -->
<?php if ($_SESSION['user']['role'] === "Esteticista") { ?>
    <div class="sidenav-item w-100 ps-5 <?= $page == "historicoServicos" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/historicoServicos" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-clipboard text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Historico de Serviços</span>
        </a>
    </div>
<?php } ?>


<!-- LEMBRETES -->
<?php if ($_SESSION['user']['role'] === "Admin" || $_SESSION['user']['role'] === "Atendente") { ?>
    <div class="sidenav-item w-100 ps-5 <?= $page == "lembrete" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/lembrete" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-bookmark text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Lembretes</span>
        </a>
    </div>
<?php } ?>