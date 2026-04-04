<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\AgendamentosRepository;

class AtendimentosController
{
    private $authController;
    private $agendsRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->agendsRepository = new AgendamentosRepository();
    }

    public function index()
    {
        $user = $this->authController->InicioController();
        $result = $this->AtendimentosController();
        $result['usuario'] = $user;

        extract($result);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Atendimentos.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }
    public function Diagnostico()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Veterinario") {
            header("location: " . BASE_URL . "/home");
            exit;
        }

        $idUser = $_SESSION['user']['id'];
        $agend = $this->agendsRepository->buscarPorId($_GET['id_agend']);
        $podeVisualizar = false;

        if ($agend) {
            if ($_SESSION['user']['role'] === "Admin") {
                $podeVisualizar = true;
            } elseif ($idUser === $agend['responsavel_id_agend']) {
                $podeVisualizar = true;
            } else {
                header("location: " . BASE_URL . "/atendimentos");
                exit;
            }

            if ($podeVisualizar) {
                $user = $this->authController->InicioController();

                extract($user);

                require __DIR__ . "/../Views/Layouts/Header.php";
                require __DIR__ . "/../Views/App/Diagnostico.php";
                require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
                require __DIR__ . "/../Views/Layouts/Footer.php";
            }
        } else {
            header("location: " . BASE_URL . "/atendimentos");
            exit;
        }
    }

    public function DiagnosticoController()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
        }
    }

    public function AtendimentosController()
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

        $results = $this->agendsRepository->ReadAgendsRepository($search, $limit, $offset, $id_user, $role, 'Consulta');

        $total = $this->agendsRepository->CountAgendsRepository($search, $id_user, $role, "Consulta");

        $totalCeil = ceil($total / $limit);

        return [
            'atendimentos' => $results,
            'totalAtendimentos' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
