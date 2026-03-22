<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Models\Veterinarios;
use App\Controllers\AuthController;
use App\Services\UsuariosService;
use App\Repositories\UsuariosRepository;

class VeterinariosController
{
    private $usuario;
    private $usuarioService;
    private $usuarioRepository;
    private $veterinario;
    private $authController;

    public function __construct()
    {
        $this->usuario = new Usuarios;
        $this->veterinario = new Veterinarios;
        $this->usuarioService = new UsuariosService;
        $this->usuarioRepository = new UsuariosRepository;
        $this->authController = new AuthController;
    }

    public function index()
    {
        $results = $this->VeterinarioController();
        $user = $this->authController->InicioController();

        extract($results);
        extract(['usuario' => $user] ?? []);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Veterinarios.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    // VETERINARIOS
    public function CriarVeterinario()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuario->setNome(trim($_POST['nome'] ?? ""));
            $this->usuario->setLogin(trim($_POST['login'] ?? ""));
            $this->usuario->setEmail(trim($_POST['email'] ?? ""));
            $this->usuario->setTelefone(trim($_POST['telefone'] ?? ""));
            $this->usuario->setRole(trim($_POST['role'] ?? ""));
            $this->usuario->setSenha($_POST['senha'] ?? "");
            $this->usuario->setStatus("Ativo");
            $this->usuario->setPrimeiro_acesso(1);

            $this->veterinario->setCrmv(trim($_POST['crmv'] ?? ""));
            $this->veterinario->setEspecialidade(trim($_POST['especialidade'] ?? ""));

            $result = $this->usuarioService->CreateVeterinarioService($this->usuario, $this->veterinario);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }
            header("location: " . BASE_URL . "/veterinarios");
            exit;
        }
    }

    public function VeterinarioController()
    {
        if ($_SESSION['user']['role'] != "Admin") {
            header("location: " . BASE_URL . "/home");
            exit;
        }
        $page = $_GET['page'] ?? 1;
        $page = (int) $page;
        $limit = 4;
        $offset = ($page - 1) * $limit;

        $search = $_GET['search'] ?? "";

        $results = $this->usuarioRepository->ReadVeterinarioRepository($search, $limit, $offset);

        $total = $this->usuarioRepository->CountVeterinarioRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'veterinarios' => $results,
            'totalVeterinarios' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
