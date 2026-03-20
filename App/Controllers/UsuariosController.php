<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Services\UsuariosService;
use App\Repositories\UsuariosRepository;

class UsuariosController
{
    private $usuario;
    private $usuarioService;
    private $usuarioRepository;

    public function __construct()
    {
        $this->usuario = new Usuarios;
        $this->usuarioService = new UsuariosService;
        $this->usuarioRepository = new UsuariosRepository;
    }

    // FUNCIONARIOS
    public function CreateFuncionarioController()
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
                header("location: " . BASE_URL . "/funcionarios");
                exit;
            }

            $_SESSION['sucesso'] = $usuario['sucesso'];
            header("location: " . BASE_URL . "/funcionarios");
            exit;
        }
    }

    public function ReadFuncionarioController()
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

    public function UpdateFuncionarioController()
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
                header("location: " . BASE_URL . "/funcionarios");
                exit;
            }

            $_SESSION['sucesso'] = $usuario['sucesso'];
            header("location: " . BASE_URL . "/funcionarios");
            exit;
        }
    }

    public function DeleteFuncionarioController()
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

    // CLIENTES
    public function CreateClienteController()
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuario->setNome(trim($_POST['nome'] ?? ""));
            $this->usuario->setEmail(trim($_POST['email'] ?? ""));
            $this->usuario->setTelefone(trim($_POST['telefone'] ?? ""));
            $this->usuario->setRole(trim($_POST['role'] ?? ""));

            $cliente = $this->usuarioService->CreateClienteService($this->usuario);

            if ($cliente['erro']) {
                $_SESSION['erro'] = $cliente['erro'];
                header("location: " . BASE_URL . "/clientes");
                exit;
            }

            $_SESSION['sucesso'] = $cliente['sucesso'];
            header("location: " . BASE_URL . "/clientes");
            exit;
        }
    }

    public function ReadClientesController()
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

    public function UpdateClienteController()
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
                header("location: " . BASE_URL . "/clientes");
                exit;
            }

            $_SESSION['sucesso'] = $usuario['sucesso'];
            header("location: " . BASE_URL . "/clientes");
            exit;
        }
    }

    public function DeleteClienteController()
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
