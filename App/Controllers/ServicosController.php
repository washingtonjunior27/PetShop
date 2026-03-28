<?php

namespace App\Controllers;

use App\Models\Servicos;
use App\Services\ServicosService;
use App\Controllers\AuthController;
use App\Repositories\ServicosRepository;


class ServicosController
{
    private $authController;
    private $servicos;
    private $servicosService;
    private $servicosRepository;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->servicos = new Servicos();
        $this->servicosService = new ServicosService();
        $this->servicosRepository = new ServicosRepository();
    }

    public function index()
    {
        $user = $this->authController->InicioController();
        $result = $this->ServicosController();

        extract($result);
        extract(['usuario' => $user] ?? "");

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Servicos.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function CriarServico()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->servicos->setNome_servico(trim($_POST['nome_servico'] ?? ""));

            $preco = str_replace(',', '.', $_POST['preco_servico']);
            $this->servicos->setPreco_servico(
                number_format((float)$preco, 2, '.', '')
            );

            $this->servicos->setCategoria_servico(trim($_POST['categoria_servico']));
            $this->servicos->setDuracao_minutos((int) $_POST['duracao_minutos']);
            $this->servicos->setDescricao_servico(trim($_POST['descricao_servico'] ?? ""));

            $result = $this->servicosService->CreateServicoService($this->servicos);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }

            header("location: " . BASE_URL . "/servicos");
            exit;
        } else {
            header("location: " . BASE_URL . "/servicos");
            exit;
        }
    }

    public function ServicosController()
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

        $results = $this->servicosRepository->ReadServicosRepository($search, $limit, $offset);

        $total = $this->servicosRepository->CountServicosRepository($search);

        $totalCeil = ceil($total / $limit);

        return [
            'servicos' => $results,
            'totalServicos' => $totalCeil,
            'currentPage' => $page
        ];
    }

    public function EditarServico()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] != "Admin") {
                header("location: " . BASE_URL . "/logout");
                exit;
            }

            $this->servicos->setId_servico($_POST['id_servico']);
            $this->servicos->setNome_servico(trim($_POST['nome_servico'] ?? ""));

            $preco = str_replace(',', '.', $_POST['preco_servico']);
            $this->servicos->setPreco_servico(
                number_format((float)$preco, 2, '.', '')
            );

            $this->servicos->setCategoria_servico(trim($_POST['categoria_servico']));
            $this->servicos->setDuracao_minutos((int) $_POST['duracao_minutos']);
            $this->servicos->setDescricao_servico(trim($_POST['descricao_servico'] ?? ""));

            $servico = $this->servicosService->UpdateServicosService($this->servicos);

            if ($servico['erro']) {
                $_SESSION['erro'] = $servico['erro'];
            } else {
                $_SESSION['sucesso'] = $servico['sucesso'];
            }

            header("location: " . BASE_URL . "/servicos");
            exit;
        } else {
            header("location: " . BASE_URL . "/servicos");
            exit;
        }
    }

    public function ExcluirServico()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->servicos->setId_servico($_POST['id_servico']);

            if ($_SESSION['user']['role'] != "Admin") {
                header("location: " . BASE_URL . "/login");
                exit;
            }

            $this->servicosRepository->DeleteServicoRepository($this->servicos->getId_servico());

            $_SESSION['sucesso'] = "Serviço Excluido com Sucesso!";
            header("location: " . BASE_URL . "/servicos");
            exit;
        } else {
            header("location: " . BASE_URL . "/servicos");
            exit;
        }
    }
}
