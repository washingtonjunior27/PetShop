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

    public function DeleteFuncionarioController()
    {
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
