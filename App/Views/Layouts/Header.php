<?php
date_default_timezone_set("America/Manaus");
$hojeData = date("d/m/Y");
$hojeDiaSemana = date("l");

switch ($hojeDiaSemana) {
    case "Monday":
        $diaSemana = "Segunda-Feira";
        break;
    case "Tuesday":
        $diaSemana = "Terça-Feira";
        break;
    case "Wednesday":
        $diaSemana = "Quarta-Feira";
        break;
    case "Thursday":
        $diaSemana = "Quinta-Feira";
        break;
    case "Friday":
        $diaSemana = "Sexta-Feira";
        break;
    case "Saturday":
        $diaSemana = "Sábado";
        break;
    case "Sunday":
        $diaSemana = "Domingo";
        break;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
    <link rel="stylesheet" href="/petshop/public/Assets/css/styles.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- GOOGLE FONTS POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container-fluid home-bg">
        <div class="row min-vh-100">
            <div class="col-md-3 main-bg p-0 d-none d-md-block">
                <div class="d-flex justify-content-center gap-1 p-4 border-5 border-white border-bottom border-end">
                    <i class="fa-solid fa-paw fs-2 text-light"></i>
                    <h4 class="fs-2 text-light">PetShop</h4>
                </div>
                <div class="sidenav-links d-flex flex-column align-items-center gap-4 mt-4">
                    <?php require __DIR__ . "/Sidenav.php" ?>
                </div>
            </div>

            <div class="col-md-9 p-0">
                <nav class="navbar navbar-expand-md navbar-dark main-bg p-3" style="height: 80px;">
                    <div class="container">
                        <h2 class="fs-6 text-light mb-0 d-none d-md-block">Olá, <?= $user['usuario']['login'] ?> 👋 | <?= $hojeData, " " . $diaSemana ?>
                        </h2>
                        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#sidebarMenu">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="ms-auto text-white d-flex gap-2">
                            <a href="#" class="nav-link"><?= $user['usuario']['login'] ?></a>
                            <span>|</span>
                            <a href="<?= BASE_URL ?>/logout" class="nav-link">Sair</a>
                        </div>
                    </div>
                </nav>