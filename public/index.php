<?php

require_once __DIR__ . "/../vendor/autoload.php";

session_start();

define("BASE_URL", "/Petshop/public");

$route = $_GET['route'] ?? "login";
$parts = explode("/", $route);

$map = [
    "login" => App\Controllers\AuthController::class,
    "novaSenha" => App\Controllers\AuthController::class,
    "logout" => App\Controllers\AuthController::class,
    "home" => App\Controllers\AuthController::class,
    "funcionarios" => App\Controllers\FuncionariosController::class,
    "veterinarios" => App\Controllers\VeterinariosController::class,
    "clientes" => App\Controllers\ClientesController::class,
    "especies" => App\Controllers\EspeciesController::class,
];

$prefix = $parts[0];

if (isset($parts[1]) && !empty($parts[1])) {
    // Se a URL tem algo depois da barra (ex: /funcionarios/CriarFuncionario)
    $method = $parts[1];
} else {
    // Se a URL NÃO tem nada depois da barra (ex: /home ou /login)

    // Lista de rotas que chamam funções com o próprio nome em vez de 'index'
    $rotasEspeciais = ['home', 'novaSenha', 'logout'];

    if (in_array($prefix, $rotasEspeciais)) {
        $method = $prefix; // Se a URL for /home, vai procurar function home()
    } else {
        $method = 'index'; // Para /login ou /funcionarios, vai procurar function index()
    }
}

if (isset($map[$prefix])) {
    $classe = $map[$prefix];
    $controller = new $classe;

    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        http_response_code(404);
    }
} else {
    http_response_code(404);
}
