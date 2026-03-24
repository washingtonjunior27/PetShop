<?php

namespace App\Services;

use App\Models\Racas;
use App\Repositories\RacasRepository;

class RacasService
{
    private $racasRepository;

    public function __construct()
    {
        $this->racasRepository = new RacasRepository();
    }

    public function CreateRacasService(Racas $raca)
    {
        if (!$raca->getNome_raca() || !$raca->getId_especie_fk()) {
            return ['erro' => "Prencha os campos vazios!"];
        }

        $result = $this->racasRepository->TrackRacaRepository($raca->getNome_raca(), $raca->getId_especie_fk());

        if ($result) {
            return ['erro' => "Raça já cadastrada!"];
        }

        $this->racasRepository->CreateRacaRepository($raca);

        return ['sucesso' => "Raça cadastrada com sucesso!"];
    }
}
