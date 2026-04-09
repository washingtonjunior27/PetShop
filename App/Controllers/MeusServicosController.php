<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Models\Estetica;
use App\Repositories\AgendamentosRepository;
use App\Repositories\AgendamentosServicosRepository;

class MeusServicosController
{
    private $authController;
    private $estetica;
    private $agendsRepository;
    private $agendsServsRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->agendsRepository = new AgendamentosRepository();
        $this->estetica = new Estetica();
        $this->agendsServsRepository = new AgendamentosServicosRepository();
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

            $observacao = trim($_POST['observacao'] ?? "");
            $this->estetica->setObservacao($observacao ?: "Sem observações!");
            $this->estetica->setCreated_at(date("Y-m-d H:i:s"));
            $this->estetica->setId_agend_fk((int) ($_POST['id_servico_estetico'] ?? 0));

            $userId = $_SESSION['user']['id'];
            $userRole = $_SESSION['user']['role'];

            $agend = $this->agendsRepository->buscarPorId($this->estetica->getId_agend_fk());

            $podeFinalizar = false;
            if ($agend) {
                if ($userRole === "Admin") {
                    $podeFinalizar = true;
                } else {
                    if ((int)$agend['responsavel_id_agend'] === (int)$userId) {
                        $podeFinalizar = true;
                    } else {
                        $_SESSION['erro'] = "Voce não pode finalizar esse agendamento!";
                    }
                }
                if ($podeFinalizar) {
                    $servsAgends = $this->agendsServsRepository->buscarPorIdAgendServs($this->estetica->getId_agend_fk());

                    foreach ($servsAgends as $servAgen) {
                        $this->agendsServsRepository->UpdateStatusExecutado($servAgen['id_agend_serv'], 'Estetica');
                    }

                    $this->agendsRepository->UpdateStatusAgend("Finalizado", $this->estetica->getId_agend_fk());
                    $this->agendsRepository->CreateEsteticaHistory($this->estetica);
                    $_SESSION['sucesso'] = "Agendamento finalizado com sucesso!";
                }
            } else {
                $_SESSION['erro'] = "Agendamento não encontrado!";
            }

            header("location: " . BASE_URL . "/meusServicos");
            exit;
        } else {
            header("location: " . BASE_URL . "/meusServicos");
            exit;
        }
    }
}
