<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\AgendamentosRepository;

class ConfirmacoesController
{
    private $authController;
    private $agendamentosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->agendamentosRepository = new AgendamentosRepository();
    }

    public function index()
    {
        $result = $this->ConfirmacoesController();
        $user = $this->authController->InicioController();
        $result['usuario'] = $user;

        extract($result);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Confirmacoes.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function ConfirmacoesController()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
            header("location: " . BASE_URL . "/home");
            exit;
        }
        $page = $_GET['page'] ?? 1;
        $page = (int) $page;
        $limit = 8;
        $offset = ($page - 1) * $limit;

        $search = $_GET['search'] ?? "";

        $results = $this->agendamentosRepository->ReadAgendamentosRepository($search, $limit, $offset);

        $total = $this->agendamentosRepository->CountAgendamentosRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'agendamentos' => $results,
            'totalAgendamentos' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
