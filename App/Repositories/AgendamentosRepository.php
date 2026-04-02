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

    // LER E PESQUISAR AGENDAMENTOS
    public function ReadAgendamentosRepository($search, $limit, $offset)
    {
        $sql = "SELECT 
                    ag.*, 
                    p.nome_pet, 
                    cli.nome AS cliente_nome,
                    cli.telefone AS cliente_telefone, 
                    resp.login AS responsavel_login,
                    CASE 
                        WHEN ag.status_agend = 'Agendado' AND 
                            (ag.data_agend < CURDATE() OR (ag.data_agend = CURDATE() AND ag.hora_agend_inicio < CURTIME())) 
                        THEN 'Atrasado'
                        ELSE ag.status_agend 
                    END AS status_real,
                    GROUP_CONCAT('s.nome_servico') AS nomes_servicos
                FROM agendamentos AS ag
                INNER JOIN agendamentos_servicos AS agse ON ag.id_agend = agse.id_agend_fk
                INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
                LEFT JOIN pets AS p ON p.id_pet = ag.pet_id_agend
                LEFT JOIN usuarios AS cli ON cli.id = ag.cliente_id_agend
                LEFT JOIN usuarios AS resp ON resp.id = ag.responsavel_id_agend
                WHERE 1 = 1 AND (status_agend = 'Agendado')";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (ag.data_agend LIKE :search OR ag.hora_agend_inicio LIKE :search 
            OR p.nome_pet LIKE :search OR cli.nome LIKE :search OR cli.telefone LIKE :search
            OR resp.login LIKE :search 
            OR (CASE 
                    WHEN ag.status_agend = 'Agendado' AND 
                    (ag.data_agend < CURDATE() OR (ag.data_agend = CURDATE() AND ag.hora_agend_inicio < CURTIME())) 
                    THEN 'Atrasado' 
                    ELSE ag.status_agend 
                END) LIKE :search)";
            $params["search"] = "%" . $search . "%";
        }

        $sql .= ' GROUP BY ag.id_agend';
        $sql .= ' ORDER BY ag.data_agend ASC, ag.hora_agend_inicio ASC';

        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
            $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // CONTAR TODOS OS AGENDAMENTOS
    public function CountAgendamentosRepository($search)
    {
        $sql = "SELECT COUNT(DISTINCT ag.id_agend)
                FROM agendamentos AS ag
                LEFT JOIN pets AS p ON p.id_pet = ag.pet_id_agend
                LEFT JOIN usuarios AS cli ON cli.id = ag.cliente_id_agend
                LEFT JOIN usuarios AS resp ON resp.id = ag.responsavel_id_agend
                WHERE 1 = 1 AND (ag.status_agend = 'Agendado')";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (ag.data_agend LIKE :search OR ag.hora_agend_inicio LIKE :search 
            OR p.nome_pet LIKE :search OR cli.nome LIKE :search OR cli.telefone LIKE :search
            OR resp.login LIKE :search 
            OR (CASE 
                    WHEN ag.status_agend = 'Agendado' AND 
                    (ag.data_agend < CURDATE() OR (ag.data_agend = CURDATE() AND ag.hora_agend_inicio < CURTIME())) 
                    THEN 'Atrasado' 
                    ELSE ag.status_agend 
                END) LIKE :search)";
            $params["search"] = "%" . $search . "%";
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function ReadAllFuncAndVetRepository()
    {
        $sql = "SELECT * FROM usuarios WHERE 1 = 1 AND (role = 'Esteticista' OR role = 'Veterinario')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
