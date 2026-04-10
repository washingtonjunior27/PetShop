<?php

namespace App\Controllers;

use App\Models\Vacinacao;
use App\Services\VacinacaoService;
use App\Repositories\VacinacaoRepository;

class VacinacaoController
{
    private $vacinacao;
    private $vacinacaoService;
    private $vacinacaoRepository;

    public function __construct()
    {
        $this->vacinacao = new Vacinacao();
        $this->vacinacaoService = new VacinacaoService();
        $this->vacinacaoRepository = new VacinacaoRepository();
    }

    public function CriarVacinacao()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] !== "Admin" && $_SESSION['user']['role'] !== "Veterinario") {
                header("location: " . BASE_URL . "/home");
                exit;
            }

            $this->vacinacao->setId_agend_vacinacao((int) ($_POST['id_agend_vac_atend_modal'] ?? 0));
            $this->vacinacao->setData_de_aplicação(trim($_POST['data_aplicacao'] ?? ""));
            $this->vacinacao->setData_prox_dose(trim($_POST['data_prox_dose'] ?? ""));
            $this->vacinacao->setCliente_id_vacinacao((int) $_POST['id_cliente_vacinacao']);
            $this->vacinacao->setPet_id_vacinacao((int) $_POST['id_pet_vacinacao']);
            $this->vacinacao->setVeterinario_id_vacinacao((int) $_POST['id_vet_vacinacao']);
            $this->vacinacao->setId_vacina_servico((int) $_POST['id_vacina_servico']);
            $this->vacinacao->setCreated_at(date("Y-m-d H:i:s"));
            $this->vacinacao->setResolvido(0);

            $result = $this->vacinacaoService->CreateVacinacaoService($this->vacinacao);

            if ($result['erro']) {
                $_SESSION['erro'] = $result['erro'];
            } else {
                $_SESSION['sucesso'] = $result['sucesso'];
            }
            header('location:' . BASE_URL . '/atendimentos');
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
