<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\PagesController;
use App\Controllers\AuthController;
use App\Controllers\UsuariosController;

session_start();

define("BASE_URL", "/Petshop/public");

$route = $_GET['route'] ?? "login";

$pageController = new PagesController();
$authController = new AuthController();
$usuarioController = new UsuariosController();

switch ($route) {
    case "":
    case "login":
        $pageController->Login();
        $authController->LoginController();
        break;
    case "novaSenha":
        $pageController->NovaSenha();
        $authController->NovaSenhaController();
        break;
    case "home":
        $user = $authController->InicioController();
        $pageController->Inicio($user);
        break;
    case "funcionarios":
        $results = $usuarioController->ReadFuncionarioController();
        $user = $authController->InicioController();
        $pageController->Funcionarios($user, $results);
        break;
    case "funcionarios/CriarFuncionario":
        $usuarioController->CreateFuncionarioController();
        break;
    case "funcionarios/ExcluirFuncionario":
        $usuarioController->DeleteFuncionarioController();
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
    default:
        http_response_code(404);
        exit;
}
