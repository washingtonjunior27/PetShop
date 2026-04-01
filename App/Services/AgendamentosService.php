<?php

namespace App\Services;

use App\Models\Agendamentos;
use App\Models\Agendamentos_Servicos;

class AgendamentosService
{
    public function CreateAgendamentosService(Agendamentos $agend, Agendamentos_Servicos $agend_serv)
    {
        if (
            !$agend->getCliente_id_agend() || !$agend->getPet_id_agend() || !$agend->getData_agend() ||
            !$agend->getHora_agend_inicio() || !$agend->getHora_agend_fim() || !$agend->getResponsavel_id_agend()
        ) {
        }
    }
}
