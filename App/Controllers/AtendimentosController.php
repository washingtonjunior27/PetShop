<?php

namespace App\Controllers;

use App\Controllers\AuthController;

class AtendimentosController
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
        require __DIR__ . "/../Views/App/Atendimentos.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }
    public function Diagnostico()
    {
        $user = $this->authController->InicioController();

        extract($user);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Diagnostico.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }
}
