<?php

namespace App\Controllers;

use App\Models\Vacinacao;
use App\Services\VacinacaoService;
use App\Controllers\AuthController;
use App\Repositories\ServicosRepository;
use App\Repositories\VacinacaoRepository;
use App\Repositories\ClientesRepository;
use App\Repositories\PetsRepository;
use App\Repositories\VeterinariosRepository;

class VacinacaoController
{
    private $authController;
    private $vacinacao;
    private $vacinacaoService;
    private $servicosRepository;
    private $vacinacaoRepository;
    private $clientesRepository;
    private $petsRepository;
    private $veterinariosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->vacinacao = new Vacinacao();
        $this->vacinacaoService = new VacinacaoService();
        $this->servicosRepository = new ServicosRepository();
        $this->vacinacaoRepository = new VacinacaoRepository();
        $this->clientesRepository = new ClientesRepository();
        $this->petsRepository = new PetsRepository();
        $this->veterinariosRepository = new VeterinariosRepository();
    }

    public function index()
    {
        $user = $this->authController->InicioController();
        $vacina = $this->servicosRepository->ReadServicosVacinaRepository();
        $cliente = $this->clientesRepository->ReadClienteRepository(null, null, null);
        $pets = $this->petsRepository->ReadPetsRepository(null, null, null);
        $veterinarios = $this->veterinariosRepository->ReadVeterinarioRepository(null, null, null);
        $result = $this->vacinacaoController();
        $dados = [
            'usuario' => $user['usuario'],
            'vacinas' => $vacina,
            'clientes' => $cliente,
            'pets' => $pets,
            'veterinarios' => $veterinarios,
            'vacinacao' => $result['vacinacao'],
            'totalVacinacao' => $result['totalVacinacao'],
            'currentPage' => $result['currentPage']
        ];

        extract($dados);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Vacinacao.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function CriarVacinacao()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] !== "Admin" && $_SESSION['user']['role'] !== "Veterinario") {
                header("location: " . BASE_URL . "/home");
                exit;
            }

            $agendAtendModal = (int) ($_POST['id_agend_vac_atend_modal'] ?? 0);
            $this->vacinacao->setData_de_aplicação(trim($_POST['data_aplicacao'] ?? ""));
            $this->vacinacao->setData_prox_dose(trim($_POST['data_prox_dose'] ?? ""));
            $this->vacinacao->setCliente_id_vacinacao((int) $_POST['id_cliente_vacinacao']);
            $this->vacinacao->setPet_id_vacinacao((int) $_POST['id_pet_vacinacao']);
            $this->vacinacao->setVeterinario_id_vacinacao((int) $_POST['id_vet_vacinacao']);
            $this->vacinacao->setId_vacina_servico((int) $_POST['id_vacina_servico']);
            $this->vacinacao->setResolvido(0);

            $result = $this->vacinacaoService->CreateVacinacaoService($agendAtendModal, $this->vacinacao);

            if ($result['erro']) {
                $vacinaModalAtend = $_POST['vacinaModalAtend'] ?? "";
                if ($vacinaModalAtend) {
                    $_SESSION['erro'] = $result['erro'];
                    header('location:' . BASE_URL . '/atendimentos');
                    exit;
                } else {
                    $_SESSION['erro'] = $result['erro'];
                }
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }
            header('location:' . BASE_URL . '/vacinacao');
            exit;
        } else {
            header("location: " . BASE_URL . "/home");
            exit;
        }
    }

    public function VacinacaoController()
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

        $results = $this->vacinacaoRepository->ReadVacinacaoRepository($search, $limit, $offset, $id_user, $role);

        $total = $this->vacinacaoRepository->CountVacinacaoRepository($search, $id_user, $role);

        $totalCeil = ceil($total / $limit);

        return [
            'vacinacao' => $results,
            'totalVacinacao' => $totalCeil,
            'currentPage' => $page
        ];
    }
}
