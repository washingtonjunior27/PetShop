<?php

namespace App\Controllers;

use App\Models\Vacinas;
use App\Services\VacinasService;
use App\Controllers\AuthController;
use App\Repositories\VacinasRepository;

class VacinasController
{
    private $authController;
    private $vacinas;
    private $vacinasService;
    private $vacinasRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->vacinas = new Vacinas();
        $this->vacinasService = new VacinasService();
        $this->vacinasRepository = new VacinasRepository();
    }

    public function index()
    {
        $user = $this->authController->InicioController();
        $result = $this->VacinasController();

        extract($result);
        extract(['usuario' => $user] ?? "");

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Vacinas.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function CriarVacina()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->vacinas->setNome_vacina(trim($_POST['nome_vacina'] ?? ""));

            $preco = str_replace(',', '.', $_POST['preco_vacina']);
            $this->vacinas->setPreco_vacina(
                number_format((float)$preco, 2, '.', '')
            );

            $this->vacinas->setDuracao_retorno((int) $_POST['duracao_retorno']);
            $this->vacinas->setDescricao_vacina(trim($_POST['descricao_vacina'] ?? ""));

            $result = $this->vacinasService->CreateVacinaService($this->vacinas);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }

            header("location: " . BASE_URL . "/vacinas");
            exit;
        } else {
            header("location: " . BASE_URL . "/vacinas");
            exit;
        }
    }

    public function VacinasController()
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

        $results = $this->vacinasRepository->ReadVacinasRepository($search, $limit, $offset);

        $total = $this->vacinasRepository->CountVacinasRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'vacinas' => $results,
            'totalVacinas' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
