<?php

namespace App\Controllers;

use App\Models\Vacinacao;
use App\Services\VacinacaoService;
use App\Controllers\AuthController;

class VacinacaoController
{
    private $authController;
    private $vacinacao;
    private $vacinacaoService;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->vacinacao = new Vacinacao();
        $this->vacinacaoService = new VacinacaoService();
    }

    public function index()
    {
        $user = $this->authController->InicioController();

        extract($user);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Vacinacao.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function CriarVacinacao()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_SESSION['user']['role'] !== "Admin" && $_SESSION['user']['role'] !== "Veterinarios") {
                header("location: " . BASE_URL . "/home");
                exit;
            }

            $agendAtendModal = (int) ($_POST['id_agend_vac_atend_modal'] ?? 0);
            $this->vacinacao->setData_de_aplicação(trim($_POST['data_aplicacao'] ?? ""));
            $this->vacinacao->setData_prox_dose(trim($_POST['data_prox_dose'] ?? ""));
            $this->vacinacao->setCliente_id_vacinacao((int) $_POST['id_cliente_vacinacao']);
            $this->vacinacao->setPet_id_vacinacao((int) $_POST['id_pet_vacinacao']);
            $this->vacinacao->setVeterinario_id_vacinacao((int) $_POST['id_vet_vacinacao']);
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
}
