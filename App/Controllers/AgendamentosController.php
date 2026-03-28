<?php

namespace App\Controllers;

use App\Controllers\AuthController;
use App\Repositories\ClientesRepository;
use App\Repositories\VeterinariosRepository;

class AgendamentosController
{
    private $authController;
    private $clientesRepository;
    private $veterinariosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->clientesRepository = new ClientesRepository();
        $this->veterinariosRepository = new VeterinariosRepository();
    }

    public function index()
    {
        $clientes = $this->clientesRepository->ReadClienteRepository(null, null, null);
        $veterinarios = $this->veterinariosRepository->ReadVeterinarioRepository(null, null, null);
        $user = $this->authController->InicioController();
        // $result = $this->AgendamentosController();

        // extract($result);
        extract($clientes);
        extract($veterinarios);
        extract(['usuario' => $user] ?? "");

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Agendamentos.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }
}
