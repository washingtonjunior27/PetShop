<?php

namespace App\Controllers;

use App\Controllers\AuthController;

class HistoricoMedicoController
{
    private $authController;

    public function __construct()
    {
        $this->authController = new AuthController();
    }

    public function index()
    {
        $user = $this->authController->InicioController();

        extract($user);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/HistoricoMedico.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function VisualizarHistoricoMedico()
    {
        $user = $this->authController->InicioController();

        extract($user);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/VisualizarHistoricoMedico.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }
}
