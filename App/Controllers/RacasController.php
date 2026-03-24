<?php

namespace App\Controllers;

use App\Models\Racas;
use App\Controllers\AuthController;
use App\Services\RacasService;
use App\Repositories\EspeciesRepository;
use App\Repositories\RacasRepository;

class RacasController
{
    private $racas;
    private $authController;
    private $racasService;
    private $especiesRepository;
    private $racasRepository;

    public function __construct()
    {
        $this->racas = new Racas();
        $this->authController = new AuthController();
        $this->racasService = new RacasService();
        $this->especiesRepository = new EspeciesRepository();
        $this->racasRepository = new RacasRepository();
    }

    public function index()
    {
        $especies = $this->especiesRepository->ReadEspeciesRepository(null, null, null);
        $results = $this->RacasController();
        $user = $this->authController->InicioController();
        extract($results);
        extract($especies);
        extract(['usuario' => $user] ?? "");

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Racas.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }
    public function CriarRaca()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->racas->setNome_raca(trim($_POST['nome_raca'] ?? ""));
            $this->racas->setId_especie_fk((int) $_POST['id_especie_fk'] ?? 0);

            $result = $this->racasService->CreateRacasService($this->racas);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }

            header("location: " . BASE_URL . "/racas");
            exit;
        } else {
            header("location: " . BASE_URL . "/racas");
            exit;
        }
    }
    public function RacasController()
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

        $results = $this->racasRepository->ReadRacasRepository($search, $limit, $offset);

        $total = $this->racasRepository->CountRacasRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'racas' => $results,
            'totalRacas' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
