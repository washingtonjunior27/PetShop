<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Services\AuthService;
use App\Repositories\FuncionariosRepository;
use App\Repositories\AgendamentosRepository;
use App\Repositories\AgendamentosServicosRepository;
use App\Repositories\ClientesRepository;
use App\Repositories\VacinacaoRepository;
use App\Repositories\HistoricoVacinacaoRepository;
use App\Repositories\HistoricoMedicoRepository;

class AuthController
{
    private $usuarios;
    private $authService;
    private $funcionarioRepository;
    private $clientesRepository;
    private $agendsRepository;
    private $agendamentosServicosRepository;
    private $vacinacaoRepository;
    private $histVacRepo;
    private $histMedRepo;

    public function __construct()
    {
        $this->usuarios = new Usuarios();
        $this->authService = new AuthService();
        $this->funcionarioRepository = new FuncionariosRepository();
        $this->agendamentosServicosRepository = new AgendamentosServicosRepository();
        $this->clientesRepository = new ClientesRepository();
        $this->agendsRepository = new AgendamentosRepository();
        $this->vacinacaoRepository = new VacinacaoRepository();
        $this->histVacRepo = new HistoricoVacinacaoRepository();
        $this->histMedRepo = new HistoricoMedicoRepository();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->LoginController();
            return;
        }

        require __DIR__ . "/../Views/Auth/Login.php";
    }

    public function novaSenha()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->NovaSenhaController();
            return;
        }

        require __DIR__ . "/../Views/Auth/NovaSenha.php";
    }

    public function logout()
    {
        $this->LogoutController();
        return;
    }

    public function home()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "/login");
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $role = $_SESSION['user']['role'];


        if ($_SESSION['user']['role'] === "Admin") {
            $agendsHoje = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, null, "= CURDATE()");

            $preco = $this->agendamentosServicosRepository->ReadOrcamentoRepository();
            $preco = str_replace('.', ',', $preco);
            $orcamento =   number_format((float)$preco, 2, ',', '');

            $totalClientes = $this->clientesRepository->CountClienteRepository(null);
            $vacPends = $this->vacinacaoRepository->CountVacPendentes($id_user, $role, null);
            $agendsHojeRead = $this->agendsRepository->ReadAgendsRepositoryHoje($id_user, $role, null, "= CURDATE()");
            $readVacsPends = $this->histVacRepo->ReadHistVacRepository(null, 4, 0, $id_user, $role, 2);
        } elseif ($_SESSION['user']['role'] === "Atendente") {
            $agendsHoje = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, null, "= CURDATE()");
            $agendsHojeRead = $this->agendsRepository->ReadAgendsRepositoryHoje($id_user, $role, null, "= CURDATE()");
            $agendsNaoConf = $this->agendsRepository->CountAgendsNaoConfRepository();
            $vacProx = $this->vacinacaoRepository->CountVacPendentes($id_user, $role, "Proximas");
            $vacAtras = $this->vacinacaoRepository->CountVacPendentes($id_user, $role, "Atrasadas");
            $readVacsPends = $this->histVacRepo->ReadHistVacRepository(null, 4, 0, $id_user, $role, 2);
        } elseif ($_SESSION['user']['role'] === "Veterinario") {
            $agendsHoje = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, null, "= CURDATE()");
            $agendsPendentes = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, "Em atendimento", "= CURDATE()");
            $agendsFinalizados = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, "Finalizado", "= CURDATE()");
            $agendsHojeRead = $this->agendsRepository->ReadAgendsRepositoryHoje($id_user, $role, "Atendimentos", "= CURDATE()");
            $histMedRecentes = $this->histMedRepo->ReadHistMedRepository(null, 4, 0, $id_user, $role, null);
            $vacinasHoje = $this->vacinacaoRepository->CountVacPendentes($id_user, $role, 'Hoje');
            // $countAtendsPends = $this->agendsRepository->CountAgendsRepositoryPends();
        } elseif ($_SESSION['user']['role'] === "Esteticista") {
            $agendsHoje = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, null, "= CURDATE()");
            $agendsPendentes = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, "Em atendimento", "= CURDATE()");
            $agendsFinalizados = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, "Finalizado", "= CURDATE()");
            $agendsHojeRead = $this->agendsRepository->ReadAgendsRepositoryHoje($id_user, $role, "Estetica", "= CURDATE()");
            $agendsProxRead = $this->agendsRepository->ReadAgendsRepositoryHoje($id_user, $role, "Estetica", "> CURDATE()");
            $agendsPendentesFuturo = $this->agendsRepository->CountAgendsRepositoryHoje($id_user, $role, "Em atendimento", "> CURDATE()");
        }

        $user = $this->InicioController();
        extract($user ?? []);

        require __DIR__ . "/../Views/Layouts/Header.php";
        require __DIR__ . "/../Views/App/Home.php";
        require __DIR__ . "/../Views/Layouts/MobileSidenav.php";
        require __DIR__ . "/../Views/Layouts/Footer.php";
    }

    public function LoginController()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->usuarios->setLogin(trim($_POST['login'] ?? ""));
            $this->usuarios->setSenha($_POST['senha'] ?? "");

            $login = $this->authService->LoginService($this->usuarios->getLogin(), $this->usuarios->getSenha());

            if (isset($login['erro'])) {
                $_SESSION['erro'] = $login['erro'];
                header('location: ' . BASE_URL . '/login');
                exit;
            }

            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id' => $login['id'],
                'login' => $login['login'],
                'role' => $login['role']
            ];

            if ($login['primeiro_acesso'] == 1) {
                header("location: " . BASE_URL . "/novaSenha");
                exit;
            }

            header("location: " . BASE_URL . "/home");
            exit;
        }
    }

    public function NovaSenhaController()
    {
        $this->usuarios->setSenha($_POST['senha'] ?? "");
        $confirmarSenha = $_POST['confirmarSenha'] ?? "";

        $login = $this->authService->NovaSenhaService($this->usuarios->getSenha(), $confirmarSenha);

        if (isset($login['erro'])) {
            $_SESSION['erro'] = $login['erro'];
            header('location: ' . BASE_URL . '/novaSenha');
            exit;
        }

        header("location: " . BASE_URL . "/home");
        exit;
    }

    public function LogoutController()
    {
        $_SESSION = [];
        session_destroy();
        header("location: " . BASE_URL . "/login");
    }

    public function InicioController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "/login");
            exit;
        }
        $userId = $_SESSION['user']['id'];
        $user = $this->funcionarioRepository->TrackUserRepository("id", $userId);
        return ['usuario' => $user];
    }
}
