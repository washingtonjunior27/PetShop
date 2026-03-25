<?php

namespace App\Services;

use App\Models\Vacinas;
use App\Repositories\VacinasRepository;

class VacinasService
{
    private $vacinasRepository;

    public function __construct()
    {
        $this->vacinasRepository = new VacinasRepository();
    }

    public function CreateVacinaService(Vacinas $vacina)
    {
        if (
            !$vacina->getNome_vacina() || !$vacina->getPreco_vacina()
            || !$vacina->getDuracao_retorno()
        ) {
            return ['erro' => "Preencha os campos vazios!"];
        }

        if ($vacina->getDuracao_retorno() <= 0) {
            return ['erro' => "Retorno invalido!"];
        }

        if (!is_numeric($vacina->getPreco_vacina())) {
            return ['erro' => 'Preço inválido'];
        }

        if ($vacina->getPreco_vacina() <= 0) {
            return ['erro' => "Preço inválido!"];
        }

        $result = $this->vacinasRepository->TrackVacinaRepository($vacina->getNome_vacina());

        if ($result) {
            return ['erro' => "Vacina já cadastrado!"];
        }

        $this->vacinasRepository->CreateVacinaRepository($vacina);

        return ['sucesso' => "Vacina cadastrado com sucesso!"];
    }
}
