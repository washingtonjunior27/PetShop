<?php

namespace App\Services;

use App\Models\Atendimentos;
use App\Repositories\AgendamentosRepository;

class AtendimentosService
{
    private $agendsRepository;

    public function __construct()
    {
        $this->agendsRepository = new AgendamentosRepository();
    }
    public function CreateAtendimentoService(Atendimentos $atend)
    {
        if (
            !$atend->getAnamnese() || !$atend->getDiagnostico() || !$atend->getTratamento() ||
            !$atend->getPet_id() || !$atend->getCliente_id() || !$atend->getVeterinario_id()
        ) {
            return ['erro' => "Preencha os campos vazios!"];
        }

        //validação contra mudar no inspecionar elementos
        $agend = $this->agendsRepository->buscarPorId($atend->getId_agend());

        if ($agend['id_pet'] != $atend->getPet_id()) {
            return ['erro' => "Pet não condiz com o cadastrado no agendamento!"];
        }
        if ($agend['cliente_id'] != $atend->getCliente_id()) {
            return ['erro' => "Cliente não condiz com o cadastrado no agendamento!"];
        }
        if ($agend['vet_id'] != $atend->getVeterinario_id()) {
            return ['erro' => "Veterinario não condiz com o cadastrado no agendamento!"];
        }

        $this->agendsRepository->CreateAtendimento($atend);
        $this->agendsRepository->UpdateStatusAgend("Finalizado", $atend->getId_agend());

        return ['sucesso' => "Diagnóstico cadastrado com sucesso!"];
    }
}
