<?php

namespace App\Controllers;

use App\Models\Especies;
use App\Services\EspeciesService;
use App\Repositories\EspeciesRepository;

class EspeciesController
{
    private $especie;
    private $especieService;
    private $especieRepository;

    public function __construct()
    {
        $this->especie = new Especies();
        $this->especieService = new EspeciesService();
        $this->especieRepository = new EspeciesRepository();
    }

    public function CreateEspecieController()
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

    public function ReadEspeciesController()
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
