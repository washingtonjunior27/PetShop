<?php

namespace App\Services;

use App\Models\Atendimentos;
use App\Repositories\AgendamentosRepository;
use App\Repositories\AgendamentosServicosRepository;

class AtendimentosService
{
    private $agendsRepository;
    private $agendsServsRepository;


    public function __construct()
    {
        $this->agendsRepository = new AgendamentosRepository();
        $this->agendsServsRepository = new AgendamentosServicosRepository();
    }
    public function CreateAtendimentoService(Atendimentos $atend, $finalizarChamado)
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
        $resultAgendDiag = $this->agendsRepository->FindAgendDiag($atend->getId_agend());

        if (!$resultAgendDiag) {
            $this->agendsRepository->CreateAtendimento($atend);

            $agendsServs = $this->agendsServsRepository->buscarPorIdAgendServs($atend->getId_agend());
            foreach ($agendsServs as $agSe) {
                $this->agendsServsRepository->UpdateStatusExecutado($agSe['id_agend_serv'], 'Consulta');
            }

            if ($finalizarChamado == "Confirmado") {
                return ['sucesso' => "Diagnostico cadastrado! Preencha a vacinação para finalizar o agendamento!"];
            } else {
                $this->agendsRepository->UpdateStatusAgend("Finalizado", $atend->getId_agend());
                return ['sucesso' => "Diagnóstico cadastrado com sucesso!"];
            }
        } else {
            return ['erro' => 'Diagnostico já está cadastrado! Cadastre a vacinação para finalizar agendamento!'];
        }
    }
}
