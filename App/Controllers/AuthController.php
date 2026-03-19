<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Services\AuthService;
use App\Repositories\UsuariosRepository;

class AuthController
{
    private $usuarios;
    private $authService;
    private $usuariosRepositories;

    public function __construct()
    {
        $this->usuarios = new Usuarios();
        $this->authService = new AuthService();
        $this->usuariosRepositories = new UsuariosRepository();
    }

    public function LoginController()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuarios->setLogin(trim($_POST['login'] ?? ""));
            $this->usuarios->setSenha($_POST['senha'] ?? "");

            $login = $this->authService->LoginService($this->usuarios->getLogin(), $this->usuarios->getSenha());

            if (isset($login['erro'])) {
                $_SESSION['erro'] = $login['erro'];
                header('location: ' . BASE_URL . '/login');
                exit;
            }

            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id' => $login['id'],
                'login' => $login['login'],
                'role' => $login['role']
            ];

            if ($login['primeiro_acesso'] == 1) {
                header("location: " . BASE_URL . "/novaSenha");
                exit;
            }

            header("location: " . BASE_URL . "/home");
            exit;
        }
    }

    public function NovaSenhaController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuarios->setSenha($_POST['senha'] ?? "");
            $confirmarSenha = $_POST['confirmarSenha'] ?? "";

            $login = $this->authService->NovaSenhaService($this->usuarios->getSenha(), $confirmarSenha);

            if (isset($login['erro'])) {
                $_SESSION['erro'] = $login['erro'];
                header('location: ' . BASE_URL . '/novaSenha');
                exit;
            }

            header("location: " . BASE_URL . "/home");
            exit;
        }
    }

    public function LogoutController()
    {
        $_SESSION = [];
        session_destroy();
        header("location: " . BASE_URL . "/login");
    }

    public function InicioController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "/login");
            exit;
        }
        $userId = $_SESSION['user']['id'];
        $user = $this->usuariosRepositories->TrackUserRepository("id", $userId);
        return ['usuario' => $user];
    }
}
