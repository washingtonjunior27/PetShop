<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;

class HistoricoServicosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    public function ReadHistServRepository($search, $limit, $offset, $id_user, $role)
    {
        $sql = "SELECT 
                est.*, 
                p.id_pet, p.nome_pet, 
                cli.id AS cliente_id,
                cli.nome AS cliente_nome,
                resp.id AS responsavel_id, 
                resp.login AS responsavel_login,
                GROUP_CONCAT(s.nome_servico SEPARATOR ', ') AS nomes_servicos
                FROM estetica AS est
                INNER JOIN agendamentos AS ag ON ag.id_agend = est.id_agend_fk
                INNER JOIN agendamentos_servicos AS agse ON ag.id_agend = agse.id_agend_fk
                INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
                LEFT JOIN pets AS p ON p.id_pet = ag.pet_id_agend
                LEFT JOIN usuarios AS cli ON cli.id = ag.cliente_id_agend
                LEFT JOIN usuarios AS resp ON resp.id = ag.responsavel_id_agend
                WHERE 1 = 1 AND ag.status_agend = 'Finalizado'";

        $params = [];

        if ($role !== 'Admin') {
            $sql .= ' AND ag.responsavel_id_agend = :id_user';
            $params[':id_user'] = $id_user;
        }

        if (!empty($search)) {
            $sql .= " AND (est.created_at LIKE :search OR resp.login LIKE :search 
                            OR p.nome_pet LIKE :search OR cli.nome LIKE :search 
                            OR est.observacao LIKE :search OR s.nome_servico LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        $sql .= ' GROUP BY est.id_estetica';
        $sql .= ' ORDER BY est.created_at DESC';

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

    public function CountHistServRepository($search, $id_user, $role)
    {
        $sql = "SELECT COUNT(DISTINCT est.id_estetica)
            FROM estetica AS est
            INNER JOIN agendamentos AS ag ON ag.id_agend = est.id_agend_fk
            INNER JOIN agendamentos_servicos AS agse ON ag.id_agend = agse.id_agend_fk
            INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
            LEFT JOIN pets AS p ON p.id_pet = ag.pet_id_agend
            LEFT JOIN usuarios AS cli ON cli.id = ag.cliente_id_agend
            LEFT JOIN usuarios AS resp ON resp.id = ag.responsavel_id_agend
            WHERE 1 = 1 AND ag.status_agend = 'Finalizado'";

        $params = [];

        if ($role !== 'Admin') {
            $sql .= ' AND ag.responsavel_id_agend = :id_user';
            $params[':id_user'] = $id_user;
        }

        if (!empty($search)) {
            $sql .= " AND (est.created_at LIKE :search OR resp.login LIKE :search 
                            OR p.nome_pet LIKE :search OR cli.nome LIKE :search 
                            OR est.observacao LIKE :search OR s.nome_servico LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function buscarPorIdServ($id_estetica)
    {
        $sql = "SELECT 
                est.*, 
                p.id_pet, p.nome_pet, 
                cli.id AS cliente_id,
                cli.nome AS cliente_nome,
                resp.id AS responsavel_id, 
                resp.login AS responsavel_login,
                GROUP_CONCAT(s.nome_servico SEPARATOR ', ') AS nomes_servicos
                FROM estetica AS est
                INNER JOIN agendamentos AS ag ON ag.id_agend = est.id_agend_fk
                INNER JOIN agendamentos_servicos AS agse ON ag.id_agend = agse.id_agend_fk
                INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
                LEFT JOIN pets AS p ON p.id_pet = ag.pet_id_agend
                LEFT JOIN usuarios AS cli ON cli.id = ag.cliente_id_agend
                LEFT JOIN usuarios AS resp ON resp.id = ag.responsavel_id_agend
                WHERE id_estetica = :id_estetica";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_estetica' => $id_estetica]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
