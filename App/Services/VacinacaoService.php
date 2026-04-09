<?php

namespace App\Services;

use App\Models\Vacinacao;
use App\Repositories\VacinacaoRepository;
use App\Repositories\AgendamentosRepository;
use App\Repositories\AgendamentosServicosRepository;

class VacinacaoService
{
    private $vacinacaoRepository;
    private $agendamentosRepository;
    private $agendsServsRepository;

    public function __construct()
    {
        $this->vacinacaoRepository = new VacinacaoRepository();
        $this->agendamentosRepository = new AgendamentosRepository();
        $this->agendsServsRepository = new AgendamentosServicosRepository();
    }

    public function CreateVacinacaoService($agendAtendModal, Vacinacao $vacinacao)
    {
        if (
            !$vacinacao->getData_de_aplicação() || !$vacinacao->getCliente_id_vacinacao() ||
            !$vacinacao->getPet_id_vacinacao() || !$vacinacao->getVeterinario_id_vacinacao() ||
            !$vacinacao->getId_vacina_servico()
        ) {
            return ['erro' => 'Preencha os campos vazios!'];
        }

        $this->vacinacaoRepository->CreateVacinacaoRepository($vacinacao);

        if ($agendAtendModal) {
            $this->agendamentosRepository->UpdateStatusAgend("Finalizado", $agendAtendModal);
        }

        return ['sucesso' => "Vacinação criada com sucesso!"];
    }
}
