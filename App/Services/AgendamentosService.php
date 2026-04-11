<?php

namespace App\Services;

use App\Models\Agendamentos;
use App\Models\Agendamentos_Servicos;
use PDO;
use PDOException;
use App\Config\Connection;
use App\Repositories\AgendamentosRepository;
use App\Repositories\AgendamentosServicosRepository;
use App\Repositories\ServicosRepository;

class AgendamentosService
{
    private $pdo;
    private $agendRepository;
    private $agendamentosServicos;
    private $servicosRepository;
    private $agendServRepository;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
        $this->agendRepository = new AgendamentosRepository();
        $this->agendamentosServicos = new Agendamentos_Servicos();
        $this->servicosRepository = new ServicosRepository();
        $this->agendServRepository = new AgendamentosServicosRepository();
    }

    public function CreateAgendamentosService(Agendamentos $agend, array $servicosAgend)
    {
        try {
            if (
                !$agend->getCliente_id_agend() || !$agend->getPet_id_agend() || !$agend->getData_agend() ||
                !$agend->getHora_agend_inicio() || !$agend->getResponsavel_id_agend() || empty($servicosAgend)
            ) {
                return ['erro' => 'Preencha os campos vazios!'];
            }

            if ($agend->getData_agend() < date('Y-m-d')) {
                return ['erro' => 'Data de agendamento inválida!'];
            }

            $this->pdo->beginTransaction();

            $duracao_servico = 0;

            foreach ($servicosAgend as $servico) {
                $servicoReturn = $this->servicosRepository->TrackServicoId($servico);
                $duracao_servico += $servicoReturn['duracao_minutos'];
            }

            $timestamp_hora_fim = strtotime($agend->getHora_agend_inicio()) + ($duracao_servico * 60);
            $hora_fim = date("H:i", $timestamp_hora_fim);
            $agend->setHora_agend_fim($hora_fim);

            $id_agend = $this->agendRepository->CreateAgendamentoRepository($agend);

            foreach ($servicosAgend as $servico) {
                $servicoReturn = $this->servicosRepository->TrackServicoId($servico);

                $this->agendamentosServicos->setId_agend_fk((int) $id_agend);
                $this->agendamentosServicos->setId_serv_fk($servico);
                $this->agendamentosServicos->setOrcamento($servicoReturn['preco_servico']);
                $this->agendamentosServicos->setExecutado("Nao");
                $this->agendServRepository->CreateAgendServRepository($this->agendamentosServicos);
            }

            $this->pdo->commit();

            return ["sucesso" => "Agendamento realizado com sucesso!"];
        } catch (\Throwable $th) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            return ['erro' => 'Erro na tentativa de agendamento!'];
        }
    }
}
