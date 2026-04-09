<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\HistoricoServicosRepository;

class HistoricoServicosController
{
    private $authController;
    private $histServRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->histServRepository = new HistoricoServicosRepository();
    }

    public function index()
    {
        $result = $this->HistoricoServicosController();
        $user = $this->authController->InicioController();
        $result['usuario'] = $user;

        extract($result);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/HistoricoServicos.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function VisualizarHistoricoServicos()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Esteticista") {
            header("location: " . BASE_URL . "/home");
            exit;
        }

        $idUser = $_SESSION['user']['id'];
        $atend = $this->histServRepository->buscarPorIdServ($_GET['id_histServ']);
        $podeVisualizar = false;

        if ($atend) {
            if ($_SESSION['user']['role'] === "Admin") {
                $podeVisualizar = true;
            } elseif ($idUser === $atend['responsavel_id']) {
                $podeVisualizar = true;
            } else {
                header("location: " . BASE_URL . "/historicoServicos");
                exit;
            }

            if ($podeVisualizar) {
                $user = $this->authController->InicioController();

                extract($user);

                require __DIR__ . "/../Views/Layouts/Header.php";
                require __DIR__ . "/../Views/App/VisualizarHistoricoServicos.php";
                require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
                require __DIR__ . "/../Views/Layouts/Footer.php";
            }
        } else {
            header("location: " . BASE_URL . "/historicoServicos");
            exit;
        }
    }

    public function HistoricoServicosController()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Esteticista") {
            header("location: " . BASE_URL . "/home");
            exit;
        }
        $page = $_GET['page'] ?? 1;
        $page = (int) $page;
        $limit = 8;
        $offset = ($page - 1) * $limit;

        $id_user = $_SESSION['user']['id'];
        $role = $_SESSION['user']['role'];

        $search = $_GET['search'] ?? "";

        $results = $this->histServRepository->ReadHistServRepository($search, $limit, $offset, $id_user, $role);

        $total = $this->histServRepository->CountHistServRepository($search, $id_user, $role);

        $totalCeil = ceil($total / $limit);

        return [
            'histServs' => $results,
            'totalHistServs' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
