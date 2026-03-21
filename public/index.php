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
    // AUTH LOGIN
    case "":
    case "login":
        $pageController->Login();
        $authController->LoginController();
        break;
    case "novaSenha":
        $pageController->NovaSenha();
        $authController->NovaSenhaController();
        break;

    // DASHBOARD HOME
    case "home":
        $user = $authController->InicioController();
        $pageController->Inicio($user);
        break;

    // FUNCIONARIOS
    case "funcionarios":
        $results = $usuarioController->ReadFuncionarioController();
        $user = $authController->InicioController();
        $pageController->Funcionarios($user, $results);
        break;
    case "funcionarios/CriarFuncionario":
        $usuarioController->CreateFuncionarioController();
        break;
    case "funcionarios/EditarFuncionario":
        $usuarioController->UpdateFuncionarioController();
        break;
    case "funcionarios/ExcluirFuncionario":
        $usuarioController->DeleteFuncionarioController();
        break;

    // VETERINARIOS
    case "veterinarios":
        $results = $usuarioController->ReadVeterinarioController();
        $user = $authController->InicioController();
        $pageController->Veterinarios($user, $results);
        break;
    case "veterinarios/CriarVeterinario":
        $usuarioController->CreateVeterinarioController();
        break;

    // CLIENTES
    case "clientes":
        $results = $usuarioController->ReadClientesController();
        $user = $authController->InicioController();
        $pageController->Clientes($user, $results);
        break;
    case "clientes/CriarCliente":
        $usuarioController->CreateClienteController();
        break;
    case "clientes/EditarCliente":
        $usuarioController->UpdateClienteController();
        break;
    case "clientes/ExcluirCliente":
        $usuarioController->DeleteClienteController();
        break;

    // ESPECIES
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
