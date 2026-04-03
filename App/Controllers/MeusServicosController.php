<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Models\Agendamentos;
use App\Models\Estetica;
use App\Repositories\AgendamentosRepository;

class MeusServicosController
{
    private $authController;
    private $agendamentos;
    private $estetica;
    private $agendsRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->agendamentos = new Agendamentos();
        $this->agendsRepository = new AgendamentosRepository();
        $this->estetica = new Estetica();
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

    public function FinalizarServicoEstetico()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Esteticista") {
                header("location: " . BASE_URL . "/home");
                exit;
            }

            $this->agendamentos->setId_agend((int) ($_POST['id_servico_estetico'] ?? 0));

            $this->estetica->setObservacao(trim($_POST['observacao'] ?? ""));
            $this->estetica->setId_agend_fk((int) ($_POST['id_servico_estetico'] ?? 0));

            $this->agendsRepository->UpdateStatusAgend("Finalizado", $this->agendamentos->getId_agend());
            $this->agendsRepository->CreateEsteticaHistory($this->estetica);

            $_SESSION['sucesso'] = "Agendamento finalizado com sucesso!";
            header("location: " . BASE_URL . "/meusServicos");
            exit;
        } else {
            header("location: " . BASE_URL . "/meusServicos");
            exit;
        }
    }

    public function CancelarServicoEstetico()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Esteticista") {
                header("location: " . BASE_URL . "/home");
                exit;
            }

            $this->agendamentos->setId_agend((int) ($_POST['id_servico_estetico'] ?? 0));

            $this->agendsRepository->UpdateStatusAgend("Cancelado", $this->agendamentos->getId_agend());

            $_SESSION['sucesso'] = "Agendamento cancelado!";
            header("location: " . BASE_URL . "/meusServicos");
            exit;
        } else {
            header("location: " . BASE_URL . "/meusServicos");
            exit;
        }
    }
}
