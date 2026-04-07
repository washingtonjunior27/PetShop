<?php

namespace App\Controllers;

use App\Models\Atendimentos;
use App\Controllers\AuthController;
use App\Services\AtendimentosService;
use App\Repositories\AgendamentosRepository;
use App\Repositories\ServicosRepository;

class AtendimentosController
{
    private $atendimentos;
    private $authController;
    private $atendimentosService;
    private $agendsRepository;
    private $servicosRepository;

    public function __construct()
    {
        $this->atendimentos = new Atendimentos();
        $this->authController = new AuthController();
        $this->atendimentosService = new AtendimentosService();
        $this->agendsRepository = new AgendamentosRepository();
        $this->servicosRepository = new ServicosRepository();
    }

    public function index()
    {
        $user = $this->authController->InicioController();
        $result = $this->AtendimentosController();
        $servicos = $this->servicosRepository->ReadServicosVacinaRepository();
        $result['usuario'] = $user;
        $result['vacina'] = $servicos;

        extract($result);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Atendimentos.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }
    public function Diagnostico()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Veterinario") {
            header("location: " . BASE_URL . "/home");
            exit;
        }

        $idUser = $_SESSION['user']['id'];
        $agend = $this->agendsRepository->buscarPorId($_GET['id_agend']);
        $podeVisualizar = false;

        if ($agend) {
            if ($_SESSION['user']['role'] === "Admin") {
                $podeVisualizar = true;
            } elseif ($idUser === $agend['responsavel_id_agend']) {
                $podeVisualizar = true;
            } else {
                header("location: " . BASE_URL . "/atendimentos");
                exit;
            }

            if ($podeVisualizar) {
                $user = $this->authController->InicioController();

                extract($user);
                require __DIR__ . "/../Views/Layouts/Header.php";
                require __DIR__ . "/../Views/App/Diagnostico.php";
                require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
                require __DIR__ . "/../Views/Layouts/Footer.php";
            }
        } else {
            header("location: " . BASE_URL . "/atendimentos");
            exit;
        }
    }

    public function DiagnosticoController()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->atendimentos->setId_agend((int) ($_POST['id_agend'] ?? 0));
            $this->atendimentos->setAnamnese(trim($_POST['anamnese'] ?? ""));
            $this->atendimentos->setDiagnostico(trim($_POST['diagnostico'] ?? ""));
            $this->atendimentos->setTratamento(trim($_POST['tratamento'] ?? ""));
            $this->atendimentos->setCliente_id((int) $_POST['id_cliente_diag']);
            $this->atendimentos->setPet_id((int) $_POST['id_pet_diag']);
            $this->atendimentos->setVeterinario_id((int) $_POST['id_vet_diag']);
            $this->atendimentos->setCreated_at(date("Y-m-d H:i:s"));

            $finalizarChamado = trim($_POST['finalizarAgendDiag'] ?? "Finalizado");

            $result = $this->atendimentosService->CreateAtendimentoService($this->atendimentos, $finalizarChamado);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
                header('location: ' . BASE_URL . '/atendimentos/Diagnostico?id_agend=' . $this->atendimentos->getId_agend());
                exit;
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
                header('location: ' . BASE_URL . '/atendimentos');
                exit;
            }
        } else {
            header('location: ' . BASE_URL . '/atendimentos');
            exit;
        }
    }

    public function AtendimentosController()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Veterinario") {
            header("location: " . BASE_URL . "/home");
            exit;
        }
        $page = $_GET['page'] ?? 1;
        $page = (int) $page;
        $limit = 8;
        $offset = ($page - 1) * $limit;

        $id_user = $_SESSION['user']['id'];
        $role = $_SESSION['user']['role'];

        $search = $_GET['search'] ?? "";

        $results = $this->agendsRepository->ReadAgendsRepository($search, $limit, $offset, $id_user, $role, 'Atendimentos');

        $total = $this->agendsRepository->CountAgendsRepository($search, $id_user, $role, "Atendimentos");

        $totalCeil = ceil($total / $limit);

        return [
            'atendimentos' => $results,
            'totalAtendimentos' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
