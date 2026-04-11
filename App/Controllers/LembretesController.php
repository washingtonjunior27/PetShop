<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\HistoricoVacinacaoRepository;


class LembretesController
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
        $result = $this->LembretesController();
        $user = $this->authController->InicioController();
        $result['usuario'] = $user;

        extract($result);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Lembretes.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function LembretesController()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
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

        $results = $this->histVacRepository->ReadHistVacRepository($search, $limit, $offset, $id_user, $role, 2);

        $total = $this->histVacRepository->CountHistVacRepository($search, $id_user, $role, 2);

        $totalCeil = ceil($total / $limit);

        return [
            'lembretes' => $results,
            'totalLembretes' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
