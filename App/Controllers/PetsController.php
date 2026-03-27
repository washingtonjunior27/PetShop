<?php

namespace App\Controllers;

use App\Models\Pets;
use App\Services\PetsService;
use App\Controllers\AuthController;
use App\Repositories\EspeciesRepository;
use App\Repositories\RacasRepository;
use App\Repositories\PetsRepository;
use App\Repositories\ClientesRepository;

class PetsController
{
    private $pets;
    private $authController;
    private $petsService;
    private $petsRepository;
    private $especiesRepository;
    private $clienteRepository;
    private $racasRepository;

    public function __construct()
    {
        $this->pets = new Pets();
        $this->petsService = new PetsService();
        $this->authController = new AuthController();
        $this->especiesRepository = new EspeciesRepository();
        $this->clienteRepository = new ClientesRepository();
        $this->racasRepository = new RacasRepository();
        $this->petsRepository = new PetsRepository();
    }

    public function index()
    {
        $especies = $this->especiesRepository->ReadEspeciesRepository(null, null, null);
        $racas = $this->racasRepository->ReadRacasRepository(null, null, null);
        $clientes = $this->clienteRepository->ReadClienteRepository(null, null, null);
        $results = $this->PetsController();
        $user = $this->authController->InicioController();
        extract($results);
        extract($especies);
        extract($racas);
        extract($clientes);
        extract(['usuario' => $user] ?? "");

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Pets.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function BuscarRacas()
    {
        $especie_id = $_GET['especie_id'] ?? null;

        if ($especie_id) {
            $racas = $this->petsRepository->getRacasPorEspecie($especie_id);

            header('Content-Type: application/json');
            echo json_encode($racas);
            exit;
        }

        echo json_encode([]);
        exit;
    }

    public function CriarPet()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->pets->setNome_pet(trim($_POST['nome_pet'] ?? ""));
            $this->pets->setCliente_id_fk((int) $_POST['cliente_id_fk'] ?? 0);
            $this->pets->setEspecie_id_fk((int) $_POST['especie_id_fk'] ?? 0);
            $this->pets->setRaca_id_fk((int) $_POST['raca_id_fk'] ?? 0);
            $this->pets->setSexo_pet(trim($_POST['sexo_pet'] ?? ""));
            $this->pets->setCor_pet(trim($_POST['cor_pet'] ?? ""));
            $this->pets->setPeso_pet((float) $_POST['peso_pet'] ?? "");

            $result = $this->petsService->CreatePetService($this->pets);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }

            header("location: " . BASE_URL . "/pets");
            exit;
        } else {
            header("location: " . BASE_URL . "/pets");
            exit;
        }
    }

    public function PetsController()
    {
        if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
            header("location: " . BASE_URL . "/home");
            exit;
        }

        $page = $_GET['page'] ?? 1;
        $page = (int) $page;
        $limit = 4;
        $offset = ($page - 1) * $limit;

        $search = $_GET['search'] ?? "";

        $results = $this->petsRepository->ReadPetsRepository($search, $limit, $offset);

        $total = $this->petsRepository->CountPetsRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'pets' => $results,
            'totalPets' => $totalCeil,
            'currentPage' => $page
        ];
    }

    // EDITAR
    public function EditarPet()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] != "Admin" && $_SESSION['user']['role'] != "Atendente") {
                header("location: " . BASE_URL . "/logout");
                exit;
            }

            $this->pets->setId_pet((int) $_POST['id_pet']);
            $this->pets->setNome_pet(trim($_POST['nome_pet'] ?? ""));
            $this->pets->setCliente_id_fk((int) $_POST['cliente_id_fk'] ?? 0);
            $this->pets->setEspecie_id_fk((int) $_POST['especie_id_fk'] ?? 0);
            $this->pets->setRaca_id_fk((int) $_POST['raca_id_fk'] ?? 0);
            $this->pets->setSexo_pet(trim($_POST['modal_sexo_pet'] ?? ""));
            $this->pets->setCor_pet(trim($_POST['cor_pet'] ?? ""));
            $this->pets->setPeso_pet((float) $_POST['peso_pet'] ?? "");

            $result = $this->petsService->UpdatePetService($this->pets);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }

            header("location: " . BASE_URL . "/pets");
            exit;
        } else {
            header("location: " . BASE_URL . "/pets");
            exit;
        }
    }

    // EXCLUIR
    public function ExcluirPet()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->pets->setId_pet(trim($_POST['id_pet']));

            if ($_SESSION['user']['role'] != "Admin"  && $_SESSION['user']['role'] != "Atendente") {
                header("location: " . BASE_URL . "/logout");
                exit;
            }

            $this->petsRepository->DeletePetRepository($this->pets->getId_pet());

            $_SESSION['sucesso'] = "Pet excluido com sucesso!";
            header("location: " . BASE_URL . "/pets");
            exit;
        } else {
            header("location: " . BASE_URL . "/pets");
            exit;
        }
    }
}
