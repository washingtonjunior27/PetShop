<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\ClientesRepository;
use App\Repositories\VeterinariosRepository;
use App\Repositories\PetsRepository;
use App\Repositories\ServicosRepository;

class AgendamentosController
{
    private $authController;
    private $clientesRepository;
    private $veterinariosRepository;
    private $petsRepository;
    private $servicosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->clientesRepository = new ClientesRepository();
        $this->veterinariosRepository = new VeterinariosRepository();
        $this->petsRepository = new PetsRepository();
        $this->servicosRepository = new ServicosRepository();
    }

    public function index()
    {
        $clientes = $this->clientesRepository->ReadClienteRepository(null, null, null);
        $veterinarios = $this->veterinariosRepository->ReadVeterinarioRepository(null, null, null);
        $servicosEstetica = $this->servicosRepository->TrackServicosCategory("Estetica");
        $servicosConsulta = $this->servicosRepository->TrackServicosCategory("Consulta");
        $user = $this->authController->InicioController();
        // $result = $this->AgendamentosController();

        $dados = [
            'clientes' => $clientes,
            'veterinarios' => $veterinarios,
            'servicosEstetica' => $servicosEstetica,
            'servicosConsulta' => $servicosConsulta,
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
