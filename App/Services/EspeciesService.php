<?php

namespace App\Services;

use App\Repositories\EspeciesRepository;

class EspeciesService
{
    private $especiesRepository;

    public function __construct()
    {
        $this->especiesRepository = new EspeciesRepository();
    }

    public function CreateEspecieService($nomeEspecie)
    {
        if (!$nomeEspecie) {
            return ['erro' => "Preencha os campos vazios!"];
        }

        if ($this->especiesRepository->TrackEspecieRepository($nomeEspecie)) {
            return ['erro' => "Espécie já está cadastrada!"];
        }

        $this->especiesRepository->CreateEspecieRepository($nomeEspecie);

        return ['sucesso' => "Especie cadastrada com sucesso!"];
    }
}
