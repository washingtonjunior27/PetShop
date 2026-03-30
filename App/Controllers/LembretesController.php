<?php

namespace App\Controllers;

use App\Controllers\AuthController;

class LembretesController
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
        require __DIR__ . "/../Views/App/Lembretes.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }
}
