<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Models\Atendimentos;
use PDO;
use PDOException;

class HistoricoMedicoRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConn();
    }

    public function ReadHistMedRepository($search, $limit, $offset, $id_user, $role)
    {
        $sql = "SELECT 
                at.*, 
                p.id_pet, p.nome_pet, 
                cli.id AS cliente_id,
                cli.nome AS cliente_nome,
                resp.id AS responsavel_id, 
                resp.login AS responsavel_login,
                GROUP_CONCAT(s.nome_servico SEPARATOR ', ') AS nomes_servicos
            FROM atendimentos AS at
            INNER JOIN agendamentos AS ag ON ag.id_agend = at.id_agend
            INNER JOIN agendamentos_servicos AS agse ON ag.id_agend = agse.id_agend_fk
            INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
            LEFT JOIN pets AS p ON p.id_pet = at.pet_id
            LEFT JOIN usuarios AS cli ON cli.id = at.cliente_id
            LEFT JOIN usuarios AS resp ON resp.id = at.veterinario_id
            LEFT JOIN veterinarios AS vet ON vet.id_usuario = at.veterinario_id
            WHERE 1 = 1 AND ag.status_agend = 'Finalizado'";

        $params = [];

        if ($role !== 'Admin') {
            $sql .= ' AND at.veterinario_id = :id_user';
            $params[':id_user'] = $id_user;
        }

        if (!empty($search)) {
            $sql .= " AND (at.created_at LIKE :search OR p.nome_pet LIKE :search OR cli.nome LIKE :search 
                            OR resp.login LIKE :search OR at.anamnese LIKE :search 
                            OR at.diagnostico LIKE :search OR at.tratamento LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        $sql .= ' GROUP BY at.id_atendimento';
        $sql .= ' ORDER BY at.created_at DESC';

        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function CountHistMedRepository($search, $id_user, $role)
    {
        $sql = "SELECT COUNT(DISTINCT at.id_atendimento)
            FROM atendimentos AS at
            INNER JOIN agendamentos AS ag ON ag.id_agend = at.id_agend
            LEFT JOIN pets AS p ON p.id_pet = at.pet_id
            LEFT JOIN usuarios AS cli ON cli.id = at.cliente_id
            LEFT JOIN usuarios AS resp ON resp.id = at.veterinario_id
            LEFT JOIN veterinarios AS vet ON vet.id_usuario = at.veterinario_id
            WHERE 1 = 1 AND ag.status_agend = 'Finalizado'";

        $params = [];

        if ($role !== 'Admin') {
            $sql .= ' AND at.veterinario_id = :id_user';
            $params[':id_user'] = $id_user;
        }

        if (!empty($search)) {
            $sql .= " AND (at.created_at LIKE :search OR p.nome_pet LIKE :search OR cli.nome LIKE :search 
                            OR resp.login LIKE :search OR at.anamnese LIKE :search 
                            OR at.diagnostico LIKE :search OR at.tratamento LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function buscarPorIdAtend($id_atendimento)
    {
        $sql = "SELECT at.*, 
                p.id_pet, p.nome_pet, 
                cli.id AS cliente_id,
                cli.nome AS cliente_nome,
                resp.id AS responsavel_id, 
                resp.login AS responsavel_login
                FROM atendimentos AS at
                INNER JOIN agendamentos AS ag ON ag.id_agend = at.id_agend
                LEFT JOIN pets AS p ON p.id_pet = at.pet_id
                LEFT JOIN usuarios AS cli ON cli.id = at.cliente_id
                LEFT JOIN usuarios AS resp ON resp.id = at.veterinario_id
                LEFT JOIN veterinarios AS vet ON vet.id_usuario = at.veterinario_id
                WHERE id_atendimento = :id_atendimento";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_atendimento' => $id_atendimento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
