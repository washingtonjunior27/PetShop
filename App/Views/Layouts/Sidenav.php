<!-- IDENTIFICA PAGINA PARA ACTIVE-sidenav CLASS -->
<?php $page = $_GET['route'] ?? 'home' ?>


<!-- HOME -->
<div class="sidenav-item w-100 ps-4 <?= $page == "home" ? "active-sidenav" : "" ?>">
    <a href="<?= BASE_URL ?>/home" class="nav-link d-flex align-items-center gap-3">
        <i class="fa-solid fa-house text-light fs-4"></i>
        <span class="text-light fs-6 fw-semibold">Inicio</span>
    </a>
</div>

<!-- DROPDOWN MENU USERS PARA ADMIN -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <a class="sidenav-item btn rounded-0 main-bg text-light w-100 px-4 d-flex justify-content-between align-items-center <?= $page == "funcionarios" || $page == "veterinarios" || $page == "clientes" ? "active-sidenav" : "" ?>"
        data-bs-toggle="collapse"
        href="#usuariosSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-users text-light fs-4"></i>
            <span class="text-light fw-semibold">Usuários</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>
<?php } ?>

<div class="collapse w-100" id="usuariosSidebar" data-bs-parent="#<?= $sidenavParent ?>">
    <div class="ps-5">
        <div class="main-bg border-2 border-light border-start d-flex flex-column gap-3">
            <?php if ($_SESSION['user']['role'] === "Admin") { ?>
                <a href="<?= BASE_URL ?>/funcionarios" class="nav-link sidenav-item ps-3 <?= $page == "funcionarios" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Funcionários</span>
                </a>
                <a href="<?= BASE_URL ?>/veterinarios" class="nav-link sidenav-item ps-3 <?= $page == "veterinarios" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Veterinarios</span>
                </a>
            <?php } ?>
            <a href="<?= BASE_URL ?>/clientes" class="nav-link sidenav-item ps-3 <?= $page == "clientes" ? "active-sidenav py-2 ps-2" : "" ?>">
                <span class="text-light fs-6 fw-semibold">Clientes</span>
            </a>
        </div>
    </div>
</div>

<!-- CLIENTES PARA ATENDENTE FORA DE DROPDOWN -->
<?php if ($_SESSION['user']['role'] == "Atendente") { ?>
    <div class="sidenav-item w-100 ps-4 <?= $page == "clientes" ? "active-sidenav" : "" ?>">
        <a href="<?= BASE_URL ?>/clientes" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-user text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Clientes</span>
        </a>
    </div>
<?php } ?>

<!-- DROPDOWN CADASTROS DE ESPECIES, RACAS, SERVICOS E VACINAS PARA ADMIN -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <a class="sidenav-item btn rounded-0 main-bg text-light w-100 px-4 d-flex justify-content-between align-items-center <?= ($page == "especies") || ($page == "racas") || ($page == "servicos") || ($page == "vacinas") ? "active-sidenav" : "" ?>"
        data-bs-toggle="collapse"
        href="#cadastrosSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-paw text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Cadastros</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="cadastrosSidebar" data-bs-parent="#<?= $sidenavParent ?>">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/especies" class="nav-link sidenav-item ps-3 <?= $page == "especies" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Especies</span>
                </a>
                <a href="<?= BASE_URL ?>/racas" class="nav-link sidenav-item ps-3 <?= $page == "racas" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Raças</span>
                </a>
                <a href="<?= BASE_URL ?>/servicos" class="nav-link sidenav-item ps-3 <?= $page == "servicos" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Serviços</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- PETS PARA ADMIN E ATENDENTE-->
<?php if ($_SESSION['user']['role'] === "Admin" || $_SESSION['user']['role'] === "Atendente") { ?>
    <div class="sidenav-item w-100 ps-4 <?= $page == "pets" ? "active-sidenav" : "" ?>">
        <a href="<?= BASE_URL ?>/pets" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-dog text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Pets</span>
        </a>
    </div>
<?php } ?>

<!-- AGENDAMENTOS DROPDOWN -->
<?php if ($_SESSION['user']['role'] === "Admin" || $_SESSION['user']['role'] === "Atendente") { ?>
    <a class="sidenav-item btn rounded-0 main-bg text-light w-100 px-4 d-flex justify-content-between align-items-center <?= ($page == "agendamentos") || ($page == "confirmacoes") ? "active-sidenav" : "" ?>"
        data-bs-toggle="collapse"
        href="#agendaSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-regular fa-calendar-days text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Agenda</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="agendaSidebar" data-bs-parent="#<?= $sidenavParent ?>">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/agendamentos" class="nav-link sidenav-item ps-3 <?= $page == "agendamentos" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Agendamentos</span>
                </a>
                <a href="<?= BASE_URL ?>/confirmacoes" class="nav-link sidenav-item ps-3 <?= $page == "confirmacoes" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Confirmações</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Atendimento - Meus serviços, Atendimentos e Vacinação - ADMIN DROPDOWN -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <a class="sidenav-item btn rounded-0 main-bg text-light w-100 px-4 d-flex justify-content-between align-items-center <?= ($page == "meusServicos") || ($page == "atendimentos") || ($page == "vacinacao") || ($page == "atendimentos/Diagnostico") ? "active-sidenav" : "" ?>"
        data-bs-toggle="collapse"
        href="#atendimentoSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-stethoscope text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Atendimento</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="atendimentoSidebar" data-bs-parent="#<?= $sidenavParent ?>">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/meusServicos" class="nav-link sidenav-item ps-3 <?= $page == "meusServicos" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Meus Serviços</span>
                </a>
                <a href="<?= BASE_URL ?>/atendimentos" class="nav-link sidenav-item ps-3 <?= $page == "atendimentos" || $page == "atendimentos/Diagnostico" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Atendimentos</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- MEUS SERVIÇOS DO ESTETICISTA -->
<?php if ($_SESSION['user']['role'] === "Esteticista") { ?>
    <div class="sidenav-item w-100 ps-4 <?= $page == "meusServicos" ? "active-sidenav" : "" ?>">
        <a href="<?= BASE_URL ?>/meusServicos" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-shower text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Meus Serviços</span>
        </a>
    </div>
<?php } ?>

<!-- ATENDIMENTOS VETERINARIO -->
<?php if ($_SESSION['user']['role'] === "Veterinario") { ?>
    <div class="sidenav-item w-100 ps-4 <?= $page == "atendimentos" ? "active-sidenav" : "" ?>">
        <a href="<?= BASE_URL ?>/atendimentos" class="nav-link d-flex align-items-center gap-3">
            <i class="fa-solid fa-stethoscope text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Atendimento</span>
        </a>
    </div>
<?php } ?>


<!-- HISTORICOS - ADMIN -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <a class="sidenav-item btn rounded-0 main-bg text-light w-100 px-4 d-flex 
                justify-content-between align-items-center 
                <?= ($page == "historicoMedico") || ($page == "historicoMedico/VisualizarHistoricoMedico") ||
                    ($page == "historicoServicos") || ($page == "historicoServicos/VisualizarHistoricoServicos") ||
                    ($page == "historicoVacinacao") || ($page == "historicoVacinacao/VisualizarHistoricoVacinacao")
                    ? "active-sidenav" : "" ?>"
        data-bs-toggle="collapse"
        href="#historicoSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-regular fa-clock fs-4 text-light"></i>
            <span class="text-light fs-6 fw-semibold">Histórico</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="historicoSidebar" data-bs-parent="#<?= $sidenavParent ?>">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/historicoMedico" class="nav-link ps-3 sidenav-item <?= ($page == "historicoMedico") || ($page == "historicoMedico/VisualizarHistoricoMedico") ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Historico Medico</span>
                </a>
                <a href="<?= BASE_URL ?>/historicoServicos" class="nav-link ps-3 sidenav-item <?= $page == "historicoServicos" || $page == "historicoServicos/VisualizarHistoricoServicos" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Historico de Serviços</span>
                </a>
                <a href="<?= BASE_URL ?>/historicoVacinacao" class="nav-link ps-3 sidenav-item <?= $page == "historicoVacinacao" || $page == "historicoVacinacao/VisualizarHistoricoVacinacao" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Historico de Vacinação</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<!-- HISTORICO MEDICO VETERINARIO -->
<?php if ($_SESSION['user']['role'] === "Veterinario") { ?>
    <a class="sidenav-item btn rounded-0 main-bg text-light w-100 px-4 d-flex 
            justify-content-between align-items-center 
            <?=
            ($page == "historicoMedico") || ($page == "historicoMedico/VisualizarHistoricoMedico") ||
                ($page == "historicoVacinacao") || ($page == "historicoVacinacao/VisualizarHistoricoVacinacao")
                ? "active-sidenav" : "" ?>"
        data-bs-toggle="collapse"
        href="#historicoSidebar"
        role="button"
        aria-expanded="false">

        <span class="d-flex align-items-center gap-3">
            <i class="fa-regular fa-clock fs-4 text-light"></i>
            <span class="text-light fs-6 fw-semibold">Histórico</span>
        </span>

        <i class="fa-solid fa-angles-down"></i>
    </a>


    <div class="collapse w-100" id="historicoSidebar" data-bs-parent="#<?= $sidenavParent ?>">
        <div class="ps-5">
            <div class="main-bg border-2 border-light border-start d-flex flex-column gap-3">
                <a href="<?= BASE_URL ?>/historicoMedico" class="nav-link ps-3 sidenav-item <?= $page == "historicoMedico" || $page == "historicoMedico/VisualizarHistoricoMedico" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Historico Medico</span>
                </a>
                <a href="<?= BASE_URL ?>/historicoVacinacao" class="nav-link ps-3 sidenav-item <?= $page == "historicoVacinacao" || $page == "historicoVacinacao/VisualizarHistoricoVacinacao" ? "active-sidenav py-2 ps-2" : "" ?>">
                    <span class="text-light fs-6 fw-semibold">Historico de Vacinação</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>


<!-- HISTORICO DE SERVIÇOS ESTETICISTA -->
<?php if ($_SESSION['user']['role'] === "Esteticista") { ?>
    <div class="sidenav-item w-100 ps-4 <?= $page == "historicoServicos" || $page == "historicoServicos/VisualizarHistoricoServicos" ? "active-sidenav" : "" ?>">
        <a href="<?= BASE_URL ?>/historicoServicos" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-clipboard text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Historico de Serviços</span>
        </a>
    </div>
<?php } ?>


<!-- LEMBRETES -->
<?php if ($_SESSION['user']['role'] === "Admin" || $_SESSION['user']['role'] === "Atendente") { ?>
    <div class="sidenav-item w-100 ps-4 <?= $page == "lembretes" ? "active-sidenav" : "" ?>">
        <a href="<?= BASE_URL ?>/lembretes" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-bookmark text-light fs-4"></i>
            <span class="text-light fs-6 fw-semibold">Lembretes</span>
        </a>
    </div>
<?php } ?>