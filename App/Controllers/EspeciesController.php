<?php

namespace App\Controllers;

use App\Models\Especies;
use App\Services\EspeciesService;

class EspeciesController
{
    private $especie;
    private $especieService;

    public function __construct()
    {
        $this->especie = new Especies();
        $this->especieService = new EspeciesService();
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
}
