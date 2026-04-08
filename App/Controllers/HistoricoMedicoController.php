<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\HistoricoMedicoRepository;

class HistoricoMedicoController
{
    private $authController;
    private $histMed;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->histMed = new HistoricoMedicoRepository();
    }

    public function index()
    {
        $result = $this->HistoricoMedicoController();
        $user = $this->authController->InicioController();
        $result['usuario'] = $user;

        extract($result);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/HistoricoMedico.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function VisualizarHistoricoMedico()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Veterinario") {
            header("location: " . BASE_URL . "/home");
            exit;
        }

        $idUser = $_SESSION['user']['id'];
        $atend = $this->histMed->buscarPorId($_GET['id_histAtend']);
        $podeVisualizar = false;

        if ($atend) {
            if ($_SESSION['user']['role'] === "Admin") {
                $podeVisualizar = true;
            } elseif ($idUser === $atend['responsavel_id']) {
                $podeVisualizar = true;
            } else {
                header("location: " . BASE_URL . "/historicoMedico");
                exit;
            }

            if ($podeVisualizar) {
                $user = $this->authController->InicioController();

                extract($user);

                require __DIR__ . "/../Views/Layouts/Header.php";
                require __DIR__ . "/../Views/App/VisualizarHistoricoMedico.php";
                require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
                require __DIR__ . "/../Views/Layouts/Footer.php";
            }
        } else {
            header("location: " . BASE_URL . "/historicoMedico");
            exit;
        }
    }

    public function HistoricoMedicoController()
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

        $results = $this->histMed->ReadHistMedRepository($search, $limit, $offset, $id_user, $role);

        $total = $this->histMed->CountHistMedRepository($search, $id_user, $role);

        $totalCeil = ceil($total / $limit);

        return [
            'histMeds' => $results,
            'totalHistMeds' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
