<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\PagesController;
use App\Controllers\AuthController;

session_start();

define("BASE_URL", "/Petshop/public");

$route = $_GET['route'] ?? "login";

$pageController = new PagesController();
$authController = new AuthController();

switch ($route) {
    case "":
    case "login":
        $pageController->Login();
        $authController->LoginController();
        break;
    case "home":
        $user = $authController->InicioController();
        $pageController->Inicio($user);
        break;
    case "usuarios":
        $user = $authController->InicioController();
        $pageController->Usuarios($user);
        break;
    case "veterinarios":
        $user = $authController->InicioController();
        $pageController->Veterinarios($user);
        break;
    case "clientes":
        $user = $authController->InicioController();
        $pageController->Clientes($user);
        break;
    case "especies":
        $user = $authController->InicioController();
        $pageController->Especies($user);
        break;
    case "racas":
        $user = $authController->InicioController();
        $pageController->Racas($user);
        break;
    case "servicos":
        $user = $authController->InicioController();
        $pageController->Servicos($user);
        break;
    case "vacinas":
        $user = $authController->InicioController();
        $pageController->Vacinas($user);
        break;

    case "logout":
        $authController->LogoutController();
        break;
}
