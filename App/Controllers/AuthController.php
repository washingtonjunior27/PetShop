<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Services\AuthService;
use App\Repositories\FuncionariosRepository;

class AuthController
{
    private $usuarios;
    private $authService;
    private $funcionarioRepository;

    public function __construct()
    {
        $this->usuarios = new Usuarios();
        $this->authService = new AuthService();
        $this->funcionarioRepository = new FuncionariosRepository();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->LoginController();
            return;
        }

        require __DIR__ . "/../Views/Auth/Login.php";
    }

    public function novaSenha()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->NovaSenhaController();
            return;
        }

        require __DIR__ . "/../Views/Auth/NovaSenha.php";
    }

    public function logout()
    {
        $this->LogoutController();
        return;
    }

    public function home()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "/login");
            exit;
        }

        $user = $this->InicioController();

        extract($user ?? []);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Home.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
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
        $user = $this->funcionarioRepository->TrackUserRepository("id", $userId);
        return ['usuario' => $user];
    }
}
