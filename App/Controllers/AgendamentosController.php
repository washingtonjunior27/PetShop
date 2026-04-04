<?php

namespace App\Controllers;

use App\Models\Agendamentos;
use App\Services\AgendamentosService;
use App\Controllers\AuthController;
use App\Repositories\ClientesRepository;
use App\Repositories\PetsRepository;
use App\Repositories\ServicosRepository;
use App\Repositories\AgendamentosRepository;


class AgendamentosController
{
    private $authController;
    private $agendamentos;
    private $agendamentosService;
    private $clientesRepository;
    private $petsRepository;
    private $servicosRepository;
    private $agendamentosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->agendamentos = new Agendamentos();
        $this->agendamentosService = new AgendamentosService();
        $this->clientesRepository = new ClientesRepository();
        $this->petsRepository = new PetsRepository();
        $this->servicosRepository = new ServicosRepository();
        $this->agendamentosRepository = new AgendamentosRepository();
    }

    public function index()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
            header("location: " . BASE_URL . "/home");
            exit;
        }

        $clientes = $this->clientesRepository->ReadClienteRepository(null, null, null);
        $responsavel = $this->agendamentosRepository->ReadAllFuncAndVetRepository();
        $servicosEstetica = $this->servicosRepository->TrackServicosCategory("Estetica");
        $servicosConsulta = $this->servicosRepository->TrackServicosCategory("Consulta");
        $servicosVacina = $this->servicosRepository->TrackServicosCategory("Vacina");
        $user = $this->authController->InicioController();

        $horarios = [
            "08:00",
            "08:30",
            "09:00",
            "09:30",
            "10:00",
            "10:30",
            "11:00",
            "11:30",
            "13:00",
            "13:30",
            "14:00",
            "14:30",
            "15:00",
            "15:30",
            "16:00",
            "16:30",
            "17:00",
            "17:30",
        ];

        $dados = [
            'clientes' => $clientes,
            'responsavels' => $responsavel,
            'servicosEstetica' => $servicosEstetica,
            'servicosConsulta' => $servicosConsulta,
            'servicosVacina' => $servicosVacina,
            'usuario' => $user
        ];
        // extract($result);
        extract($dados);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Agendamentos.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function BuscarPets()
    {
        $cliente_id = $_GET['cliente_id_agendamento'] ?? null;

        if ($cliente_id) {
            $pets = $this->petsRepository->getPetsPorCliente($cliente_id);

            header('Content-Type: application/json');
            echo json_encode($pets);
            exit;
        }

        echo json_encode([]);
        exit;
    }

    public function CriarAgendamento()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->agendamentos->setCliente_id_agend((int) ($_POST['cliente_id_agend'] ?? 0));
            $this->agendamentos->setPet_id_agend((int) ($_POST['pet_id_agend'] ?? 0));
            $this->agendamentos->setData_agend($_POST['data_agend']);
            $this->agendamentos->setResponsavel_id_agend((int) ($_POST['responsavel_id_agend'] ?? 0));
            $this->agendamentos->setHora_agend_inicio($_POST['hora_agend_inicio'] ?? "");
            $this->agendamentos->setStatus_agend("Agendado");
            $this->agendamentos->setDescricao_agend(trim($_POST['descricao_agend'] ?? ""));
            $this->agendamentos->setData_criacao_agend(date("Y-m-d H:i:s"));

            $servicosSelecionados = $_POST['servico_agendamento'] ?? "";

            $result = $this->agendamentosService->CreateAgendamentosService($this->agendamentos, $servicosSelecionados);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }

            header('location: ' . BASE_URL . '/agendamentos');
            exit;
        } else {
            header('location: ' . BASE_URL . '/agendamentos');
            exit;
        }
    }
    public function CancelarAgend()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $this->agendamentos->setId_agend((int) ($_POST['id_agend'] ?? 0));

            $userId = $_SESSION['user']['id'];
            $userRole = $_SESSION['user']['role'];

            $agend = $this->agendamentosRepository->buscarPorId($this->agendamentos->getId_agend());

            $podeCancelar = false;
            if ($agend) {
                if ($userRole === "Admin") {
                    $podeCancelar = true;
                } elseif ($userRole === "Atendente") {
                    if ($agend['status_agend'] === "Agendado") {
                        $podeCancelar = true;
                    } else {
                        $_SESSION['erro'] = "Atendentes só podem cancelar agendamentos com status Agendado!";
                    }
                } else {
                    if ((int)$agend['responsavel_id_agend'] === (int)$userId) {
                        $podeCancelar = true;
                    } else {
                        $_SESSION['erro'] = "Voce não pode cancelar esse agendamento!";
                    }
                }
                if ($podeCancelar) {
                    $this->agendamentosRepository->UpdateStatusAgend("Cancelado", $this->agendamentos->getId_agend());
                    $_SESSION['sucesso'] = "Agendamento cancelado com sucesso!";
                }
            } else {
                $_SESSION['erro'] = "Agendamento não encontrado!";
            }

            $caminho = trim($_POST['caminho'] ?? "");

            switch ($caminho) {
                case "confirmacoes":
                    header("location: " . BASE_URL . "/confirmacoes");
                    exit;
                case "meusServicos":
                    header("location: " . BASE_URL . "/meusServicos");
                    exit;
                case "atendimentos":
                    header("location: " . BASE_URL . "/atendimentos");
                    exit;
                default:
                    header("location: " . BASE_URL . "/home");
                    exit;
            }
        } else {
            header("location: " . BASE_URL . "/home");
            exit;
        }
    }
}
