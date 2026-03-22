<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Controllers\AuthController;
use App\Services\UsuariosService;
use App\Repositories\UsuariosRepository;

class FuncionariosController
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
        $results = $this->FuncionarioController();
        $user = $this->authController->InicioController();

        extract($results);
        extract(['usuario' => $user] ?? []);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Funcionarios.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    // FUNCIONARIOS
    public function CriarFuncionario()
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

            $usuario = $this->usuarioService->CreateUsuarioService($this->usuario);

            if ($usuario['erro']) {
                $_SESSION['erro'] = $usuario['erro'];
            } else {
                $_SESSION['sucesso'] = $usuario['sucesso'];
            }

            header("location: " . BASE_URL . "/funcionarios");
            exit;
        }
    }

    public function FuncionarioController()
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

        $results = $this->usuarioRepository->ReadFuncionarioRepository($search, $limit, $offset);

        $total = $this->usuarioRepository->CountFuncionarioRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'funcionarios' => $results,
            'totalFuncionarios' => $totalCeil,
            'currentPage' => $page
        ];
    }

    public function EditarFuncionario()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] != "Admin") {
                header("location: " . BASE_URL . "/logout");
                exit;
            }

            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

            $this->usuario->setId($id);
            $this->usuario->setNome(trim($_POST['nome'] ?? ""));
            $this->usuario->setLogin(trim($_POST['login'] ?? ""));
            $this->usuario->setEmail(trim($_POST['email'] ?? ""));
            $this->usuario->setTelefone(trim($_POST['telefone'] ?? ""));
            $this->usuario->setRole(trim($_POST['role'] ?? ""));
            $this->usuario->setStatus(trim($_POST['status']) ?? "");

            $usuario = $this->usuarioService->UpdateUsuarioService($this->usuario);

            if ($usuario['erro']) {
                $_SESSION['erro'] = $usuario['erro'];
            } else {
                $_SESSION['sucesso'] = $usuario['sucesso'];
            }

            header("location: " . BASE_URL . "/funcionarios");
            exit;
        }
    }

    public function ExcluirFuncionario()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuario->setId($_POST['id_usuario']);

            if ($_SESSION['user']['role'] != "Admin") {
                header("location: " . BASE_URL . "/login");
                exit;
            }

            $this->usuarioRepository->DeleteUsuarioRepository($this->usuario->getId());

            $_SESSION['sucesso'] = "Usuario Excluido com Sucesso!";
            header("location: " . BASE_URL . "/funcionarios");
            exit;
        }
    }
}
