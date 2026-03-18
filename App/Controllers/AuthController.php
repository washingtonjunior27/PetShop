<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Services\UsuariosService;
use App\Repositories\UsuariosRepository;

class AuthController
{
    private $usuarios;
    private $usuariosService;
    private $usuariosRepositories;

    public function __construct()
    {
        $this->usuarios = new Usuarios();
        $this->usuariosService = new UsuariosService();
        $this->usuariosRepositories = new UsuariosRepository();
    }

    public function LoginController()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuarios->setLogin(trim($_POST['login'] ?? ""));
            $this->usuarios->setSenha($_POST['senha'] ?? "");

            $login = $this->usuariosService->LoginService($this->usuarios->getLogin(), $this->usuarios->getSenha());

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
        $user = $this->usuariosRepositories->TrackUserController("id", $userId);
        return ['user' => $user];
    }
}
