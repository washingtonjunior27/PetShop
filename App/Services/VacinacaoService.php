<?php

namespace App\Services;

use App\Models\Vacinacao;
use App\Repositories\VacinacaoRepository;
use App\Repositories\AgendamentosRepository;

class VacinacaoService
{
    private $vacinacaoRepository;
    private $agendamentosRepository;

    public function __construct()
    {
        $this->vacinacaoRepository = new VacinacaoRepository();
        $this->agendamentosRepository = new AgendamentosRepository();
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

        return ['sucesso' => "Vacinacao criada com sucesso!"];
    }
}
