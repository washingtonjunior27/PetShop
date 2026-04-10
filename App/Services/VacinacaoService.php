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

    public function CreateVacinacaoService(Vacinacao $vacinacao)
    {
        if (
            !$vacinacao->getData_de_aplicação() || !$vacinacao->getCliente_id_vacinacao() ||
            !$vacinacao->getPet_id_vacinacao() || !$vacinacao->getVeterinario_id_vacinacao() ||
            !$vacinacao->getId_vacina_servico()
        ) {
            return ['erro' => 'Preencha os campos vazios!'];
        }

        // 1. Salva a vacinação no histórico
        $this->vacinacaoRepository->CreateVacinacaoRepository($vacinacao);

        $idAgend = $vacinacao->getId_agend_vacinacao();
        $idVacina = $vacinacao->getId_vacina_servico();

        // 2. Verifica se a vacina já estava no orçamento desse agendamento
        $jaExiste = $this->agendsServsRepository->buscarServicoNoAgendamento($idAgend, $idVacina);

        if (!$jaExiste) {
            // BUSCA O VALOR: Se não existia, precisamos saber quanto custa hoje
            $precoAtual = $this->agendsServsRepository->buscarPrecoServico($idVacina);

            // SALVA NO ORÇAMENTO: Adiciona o serviço com o preço correto
            $this->agendsServsRepository->adicionarServicoAoAgendamento($idAgend, $idVacina, $precoAtual);
        }

        // 3. Finaliza o agendamento
        $this->agendamentosRepository->UpdateStatusAgend("Finalizado", $idAgend);
        $this->agendsServsRepository->UpdateStatusExecutado($idAgend, 'Vacina');

        return ['sucesso' => "Vacinação registrada e valor adicionado ao orçamento!"];
    }
}
