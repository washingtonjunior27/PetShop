<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\ClientesRepository;
use App\Repositories\PetsRepository;
use App\Repositories\ServicosRepository;
use App\Repositories\AgendamentosRepository;

class AgendamentosController
{
    private $authController;
    private $clientesRepository;
    private $petsRepository;
    private $servicosRepository;
    private $agendamentosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->clientesRepository = new ClientesRepository();
        $this->petsRepository = new PetsRepository();
        $this->servicosRepository = new ServicosRepository();
        $this->agendamentosRepository = new AgendamentosRepository();
    }

    public function index()
    {
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
}
