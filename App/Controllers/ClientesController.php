<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Controllers\AuthController;
use App\Services\UsuariosService;
use App\Repositories\UsuariosRepository;

class ClientesController
{
    private $usuario;
    private $usuarioService;
    private $usuarioRepository;
    private $authController;

    public function __construct()
    {
        $this->usuario = new Usuarios;
        $this->usuarioService = new UsuariosService;
        $this->usuarioRepository = new UsuariosRepository;
        $this->authController = new AuthController;
    }

    public function index()
    {
        $results = $this->ClientesController();
        $user = $this->authController->InicioController();

        extract($results);
        extract(['usuario' => $user] ?? []);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Clientes.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    // CLIENTES
    public function CriarCliente()
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuario->setNome(trim($_POST['nome'] ?? ""));
            $this->usuario->setEmail(trim($_POST['email'] ?? ""));
            $this->usuario->setTelefone(trim($_POST['telefone'] ?? ""));
            $this->usuario->setRole(trim($_POST['role'] ?? ""));

            $cliente = $this->usuarioService->CreateClienteService($this->usuario);

            if ($cliente['erro']) {
                $_SESSION['erro'] = $cliente['erro'];
            } else {
                $_SESSION['sucesso'] = $cliente['sucesso'];
            }

            header("location: " . BASE_URL . "/clientes");
            exit;
        }
    }

    public function ClientesController()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
            header("location: " . BASE_URL . "/home");
            exit;
        }
        $page = $_GET['page'] ?? 1;
        $page = (int) $page;
        $limit = 4;
        $offset = ($page - 1) * $limit;

        $search = $_GET['search'] ?? "";

        $results = $this->usuarioRepository->ReadClienteRepository($search, $limit, $offset);

        $total = $this->usuarioRepository->CountClienteRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'clientes' => $results,
            'totalClientes' => $totalCeil,
            'currentPage' => $page
        ];
    }

    public function EditarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
                header("location: " . BASE_URL . "/logout");
                exit;
            }

            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

            $this->usuario->setId($id);
            $this->usuario->setNome(trim($_POST['nome'] ?? ""));
            $this->usuario->setEmail(trim($_POST['email'] ?? ""));
            $this->usuario->setTelefone(trim($_POST['telefone'] ?? ""));
            $this->usuario->setRole(trim($_POST['role'] ?? ""));

            $usuario = $this->usuarioService->UpdateClienteService($this->usuario);

            if ($usuario['erro']) {
                $_SESSION['erro'] = $usuario['erro'];
            } else {
                $_SESSION['sucesso'] = $usuario['sucesso'];
            }

            header("location: " . BASE_URL . "/clientes");
            exit;
        }
    }

    public function ExcluirCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuario->setId($_POST['id_cliente']);

            if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
                header("location: " . BASE_URL . "/login");
                exit;
            }

            $this->usuarioRepository->DeleteUsuarioRepository($this->usuario->getId());

            $_SESSION['sucesso'] = "Usuario Excluido com Sucesso!";
            header("location: " . BASE_URL . "/clientes");
            exit;
        }
    }
}
