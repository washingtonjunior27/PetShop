<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\AgendamentosRepository;

class MeusServicosController
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
        $result = $this->MeusServicosController();
        $result['usuario'] = $user;

        extract($result);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/MeusServicos.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function MeusServicosController()
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

        $results = $this->agendsRepository->ReadAgendsRepository($search, $limit, $offset, $id_user, $role, 'Estetica');

        $total = $this->agendsRepository->CountAgendsRepository($search, $id_user, $role, "Estetica");

        $totalCeil = ceil($total / $limit);

        return [
            'agendamentos' => $results,
            'totalAgendamentos' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
