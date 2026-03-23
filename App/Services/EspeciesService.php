<?php

namespace App\Services;

use App\Models\Especies;
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

    public function UpdateEspecieService(Especies $especie)
    {
        if (!$especie->getNome_especie()) {
            return ['erro' => "Preencha os campos vazios!"];
        }

        $trackEspecie = $this->especiesRepository->TrackEspecieRepository($especie->getNome_especie());

        if ($trackEspecie && $trackEspecie['id_especie'] != $especie->getId_especie()) {
            return ['erro' => "Espécie já está cadastrada!"];
        }

        $this->especiesRepository->UpdateEspecieRepository($especie);

        return ['sucesso' => "Especie atualizada com sucesso!"];
    }
}
