<?php

namespace App\Controllers;

use App\Models\Agendamentos;
use App\Models\Agendamentos_Servicos;
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
    private $agendamentosServicos;
    private $agendamentosService;
    private $clientesRepository;
    private $petsRepository;
    private $servicosRepository;
    private $agendamentosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->agendamentos = new Agendamentos();
        $this->agendamentosServicos = new Agendamentos_Servicos();
        $this->agendamentosService = new AgendamentosService();
        $this->clientesRepository = new ClientesRepository();
        $this->petsRepository = new PetsRepository();
        $this->servicosRepository = new ServicosRepository();
        $this->agendamentosRepository = new AgendamentosRepository();
    }

    public function index()
    {
        if ($_SESSION['user']['role'] != "Admin") {
            header("location: " . BASE_URL . "/home");
            exit;
        }

        $clientes = $this->clientesRepository->ReadClienteRepository(null, null, null);
        $responsavel = $this->agendamentosRepository->ReadAllFuncAndVetRepository();
        $servicosEstetica = $this->servicosRepository->TrackServicosCategory("Estetica");
        $servicosConsulta = $this->servicosRepository->TrackServicosCategory("Consulta");
        $servicosVacina = $this->servicosRepository->TrackServicosCategory("Vacina");
        $user = $this->authController->InicioController();
        // $result = $this->AgendamentosController();

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
            if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
                $this->agendamentos->setCliente_id_agend($_POST['cliente_id_agend']);
                $this->agendamentos->setPet_id_agend($_POST['pet_id_agend']);
                $this->agendamentos->setData_agend($_POST['data_agend']);

                $servicos = [];
                $duracao_servico = 0;
                $servicos = $_POST['servico_agendamento'];
                foreach ($servicos as $servico) {
                    $servicoReturn = $this->servicosRepository->TrackServicoId($servico);
                    $this->agendamentosServicos->setId_serv_fk(trim($servico));
                    $this->agendamentosServicos->setPreco($servicoReturn['preco_servico']);
                    $this->agendamentosServicos->setExecutado("nao");

                    $duracao_servico += $servicoReturn['duracao_minutos'];
                }

                $this->agendamentos->setResponsavel_id_agend($_POST['responsavel_id_agend']);

                $hora_inicio = $_POST['hora_inicio_agend'];
                $this->agendamentos->setHora_agend_inicio($hora_inicio);

                $hora_fim = $hora_inicio + $duracao_servico;
                $this->agendamentos->setHora_agend_fim($hora_fim);

                $this->agendamentos->setStatus_agend("Agendado");
                $this->agendamentos->setDescricao_agend(trim($_POST['descricao_agend'] ?? ""));
                $this->agendamentos->setData_criacao_agend(date("Y-m-d H:i:s"));

                $result = $this->agendamentosService->CreateAgendamentosService($this->agendamentos, $this->agendamentosServicos);

                if ($result['erro']) {
                    $_SESSION['erro'] = $result['erro'];
                } else {
                    $result['sucesso'] = $result['sucesso'];
                }

                header('location: ' . BASE_URL . '/agendamentos');
                exit;
            }
        } else {
            header('location: ' . BASE_URL . '/agendamentos');
            exit;
        }
    }
}
