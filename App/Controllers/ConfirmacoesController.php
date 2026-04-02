<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Models\Agendamentos;
use App\Repositories\AgendamentosRepository;

class ConfirmacoesController
{
    private $authController;
    private $agendamentos;
    private $agendamentosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->agendamentos = new Agendamentos();
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

        $role = $_SESSION['user']['role'];
        $results = $this->agendamentosRepository->ReadAgendsRepository($search, $limit, $offset, null, $role, "");
        $total = $this->agendamentosRepository->CountAgendsRepository($search, null, $role, "");

        $totalCeil = ceil($total / $limit);

        return [
            'agendamentos' => $results,
            'totalAgendamentos' => $totalCeil,
            'currentPage' => $page
        ];
    }

    public function ConfirmarAgend()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
                header("location: " . BASE_URL . "/home");
                exit;
            }

            $this->agendamentos->setId_agend((int) ($_POST['id_agend'] ?? 0));

            $this->agendamentosRepository->UpdateStatusAgend("Confirmado", $this->agendamentos->getId_agend());

            $_SESSION['sucesso'] = "Agendamento confirmado!";
            header("location: " . BASE_URL . "/confirmacoes");
            exit;
        } else {
            header("location: " . BASE_URL . "/confirmacoes");
            exit;
        }
    }
    public function CancelarAgend()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
                header("location: " . BASE_URL . "/home");
                exit;
            }

            $this->agendamentos->setId_agend((int) ($_POST['id_agend'] ?? 0));

            $this->agendamentosRepository->UpdateStatusAgend("Cancelado", $this->agendamentos->getId_agend());

            $_SESSION['sucesso'] = "Agendamento cancelado!";
            header("location: " . BASE_URL . "/confirmacoes");
            exit;
        } else {
            header("location: " . BASE_URL . "/confirmacoes");
            exit;
        }
    }
}
