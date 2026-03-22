<?php

namespace App\Controllers;

use App\Models\Especies;
use App\Services\EspeciesService;
use App\Repositories\EspeciesRepository;
use App\Controllers\AuthController;

class EspeciesController
{
    private $especie;
    private $especieService;
    private $especieRepository;
    private $authController;

    public function __construct()
    {
        $this->especie = new Especies();
        $this->especieService = new EspeciesService();
        $this->especieRepository = new EspeciesRepository();
        $this->authController = new AuthController();
    }

    public function index()
    {
        $results = $this->EspeciesController();
        $user = $this->authController->InicioController();

        extract($results);
        extract(['usuario' => $user] ?? []);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Especies.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function CriarEspecie()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->especie->setNome_especie(trim($_POST['nome_especie'] ?? ""));

            $result = $this->especieService->CreateEspecieService($this->especie->getNome_especie());

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }

            header("location: " . BASE_URL . "/especies");
            exit;
        }
    }

    public function EspeciesController()
    {
        if ($_SESSION['user']['role'] != "Admin") {
            header("location: " . BASE_URL . "/home");
            exit;
        }
        $page = $_GET['page'] ?? 1;
        $page = (int) $page;
        $limit = 4;
        $offset = ($page - 1) * $limit;

        $search = $_GET['search'] ?? "";

        $results = $this->especieRepository->ReadEspeciesRepository($search, $limit, $offset);

        $total = $this->especieRepository->CountEspeciesRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'especies' => $results,
            'totalEspecies' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
