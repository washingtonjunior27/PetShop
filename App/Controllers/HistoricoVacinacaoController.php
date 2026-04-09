<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\HistoricoVacinacaoRepository;

class HistoricoVacinacaoController
{
    private $authController;
    private $histVacRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->histVacRepository = new HistoricoVacinacaoRepository();
    }

    public function index()
    {
        $result = $this->HistoricoVacinacaoController();
        $user = $this->authController->InicioController();
        $result['usuario'] = $user;

        extract($result);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/HistoricoVacinacao.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function VisualizarHistoricoVacinacao()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Veterinario") {
            header("location: " . BASE_URL . "/home");
            exit;
        }

        $idUser = $_SESSION['user']['id'];
        $atend = $this->histVacRepository->buscarPorIdVac($_GET['id_histVac']);
        $podeVisualizar = false;

        if ($atend) {
            if ($_SESSION['user']['role'] === "Admin") {
                $podeVisualizar = true;
            } elseif ($idUser === $atend['responsavel_id']) {
                $podeVisualizar = true;
            } else {
                header("location: " . BASE_URL . "/historicoVacinacao");
                exit;
            }

            if ($podeVisualizar) {
                $user = $this->authController->InicioController();

                extract($user);

                require __DIR__ . "/../Views/Layouts/Header.php";
                require __DIR__ . "/../Views/App/VisualizarHistoricoVacinacao.php";
                require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
                require __DIR__ . "/../Views/Layouts/Footer.php";
            }
        } else {
            header("location: " . BASE_URL . "/historicoVacinacao");
            exit;
        }
    }

    public function HistoricoVacinacaoController()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Veterinario") {
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

        $results = $this->histVacRepository->ReadHistVacRepository($search, $limit, $offset, $id_user, $role);

        $total = $this->histVacRepository->CountHistVacRepository($search, $id_user, $role);

        $totalCeil = ceil($total / $limit);

        return [
            'histVacs' => $results,
            'totalHistVacs' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
