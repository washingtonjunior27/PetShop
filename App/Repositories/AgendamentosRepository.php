<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;
use App\Models\Agendamentos;

class AgendamentosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    public function CreateAgendamentoRepository(Agendamentos $agend)
    {
        $sql = "INSERT INTO agendamentos (data_agend, hora_agend_inicio, hora_agend_fim, data_criacao_agend,
                status_agend, descricao_agend, cliente_id_agend, pet_id_agend, responsavel_id_agend)
                VALUES (:data_agend, :hora_agend_inicio, :hora_agend_fim, :data_criacao_agend,
                :status_agend, :descricao_agend, :cliente_id_agend, :pet_id_agend, :responsavel_id_agend)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "data_agend" => $agend->getData_agend(),
            "hora_agend_inicio" => $agend->getHora_agend_inicio(),
            "hora_agend_fim" => $agend->getHora_agend_fim(),
            "data_criacao_agend" => $agend->getData_criacao_agend(),
            "status_agend" => $agend->getStatus_agend(),
            "descricao_agend" => $agend->getDescricao_agend(),
            "cliente_id_agend" => $agend->getCliente_id_agend(),
            "pet_id_agend" => $agend->getPet_id_agend(),
            "responsavel_id_agend" => $agend->getResponsavel_id_agend()
        ]);

        return $this->pdo->lastInsertId();
    }

    public function ReadAllFuncAndVetRepository()
    {
        $sql = "SELECT * FROM usuarios WHERE 1 = 1 AND (role = 'Esteticista' OR role = 'Veterinario')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
