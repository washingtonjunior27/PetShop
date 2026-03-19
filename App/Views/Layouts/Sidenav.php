<?php $page = $_GET['route'] ?? 'home' ?>

<div class="sidenav-item w-100 ps-5 <?= $page == "home" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/home" class="nav-link d-flex align-items-center gap-3">
        <i class="fa-solid fa-house text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Inicio</span>
    </a>
</div>

<!-- APENAS ADMIN PODE CADASTRAR FUNCIONARIOS E VETERINARIOS -->
<?php if ($_SESSION['user']['role'] === "Admin") { ?>
    <div class="sidenav-item w-100 ps-5 <?= $page == "funcionarios" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/funcionarios" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-users text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Funcionários</span>
        </a>
    </div>
    <div class="sidenav-item w-100 ps-5 <?= $page == "veterinarios" ? "active" : "" ?>">
        <a href="<?= BASE_URL ?>/veterinarios" class="nav-link d-flex align-items-center gap-3 ">
            <i class="fa-solid fa-user-doctor text-light fs-2"></i>
            <span class="text-light fs-6 fw-semibold">Veterinarios</span>
        </a>
    </div>
<?php } ?>


<div class="sidenav-item w-100 ps-5 <?= $page == "clientes" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/clientes" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-user text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Clientes</span>
    </a>
</div>

<div class="sidenav-item w-100 ps-5 <?= $page == "especies" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/especies" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-paw text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Especies</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "racas" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/racas" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-dna text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Raças</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "servicos" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/servicos" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-briefcase text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Serviços</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "vacinas" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/vacinas" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-syringe text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Vacinas</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "pets" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/pets" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-dog text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Pets</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "agendamentos" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/agendamentos" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-regular fa-calendar-days text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Agendamentos</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "consultas" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/consultas" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-stethoscope text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Consultas</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "atendimentos" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/atendimentos" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-clipboard-check text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Atendimentos</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "lembrete" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/lembrete" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-solid fa-bookmark text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Lembrete</span>
    </a>
</div>
<div class="sidenav-item w-100 ps-5 <?= $page == "historico" ? "active" : "" ?>">
    <a href="<?= BASE_URL ?>/historico" class="nav-link d-flex align-items-center gap-3 ">
        <i class="fa-regular fa-file-lines text-light fs-2"></i>
        <span class="text-light fs-6 fw-semibold">Historico</span>
    </a>
</div>