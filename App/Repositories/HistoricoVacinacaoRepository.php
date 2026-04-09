<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;

class HistoricoVacinacaoRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    public function ReadHistVacRepository($search, $limit, $offset, $id_user, $role)
    {
        $sql = "SELECT 
                vac.*, 
                p.id_pet, p.nome_pet, 
                cli.id AS cliente_id,
                cli.nome AS cliente_nome,
                resp.id AS responsavel_id, 
                resp.login AS responsavel_login,
                s.nome_servico
            FROM vacinacao AS vac
            INNER JOIN servicos AS s ON s.id_servico = vac.id_vacina_servico
            LEFT JOIN pets AS p ON p.id_pet = vac.id_pet_vacinacao
            LEFT JOIN usuarios AS cli ON cli.id = vac.id_cliente_vacinacao
            LEFT JOIN usuarios AS resp ON resp.id = vac.id_vet_vacinacao
            WHERE 1 = 1";

        $params = [];

        if ($role !== 'Admin') {
            $sql .= ' AND vac.id_vet_vacinacao = :id_user';
            $params[':id_user'] = $id_user;
        }

        if (!empty($search)) {
            $sql .= " AND (vac.created_at LIKE :search OR resp.login LIKE :search 
                            OR p.nome_pet LIKE :search  OR cli.nome LIKE :search 
                            OR s.nome_servico LIKE :search OR vac.data_aplicacao LIKE :search
                            OR vac.data_prox_dose LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        $sql .= ' ORDER BY vac.created_at DESC';

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

    public function CountHistVacRepository($search, $id_user, $role)
    {
        $sql = "SELECT COUNT(DISTINCT vac.id_vacinacao)
            FROM vacinacao AS vac
            INNER JOIN servicos AS s ON s.id_servico = vac.id_vacina_servico
            LEFT JOIN pets AS p ON p.id_pet = vac.id_pet_vacinacao
            LEFT JOIN usuarios AS cli ON cli.id = vac.id_cliente_vacinacao
            LEFT JOIN usuarios AS resp ON resp.id = vac.id_vet_vacinacao
            WHERE 1 = 1";

        $params = [];

        if ($role !== 'Admin') {
            $sql .= ' AND vac.id_vet_vacinacao = :id_user';
            $params[':id_user'] = $id_user;
        }

        if (!empty($search)) {
            $sql .= " AND (vac.created_at LIKE :search OR resp.login LIKE :search 
                            OR p.nome_pet LIKE :search  OR cli.nome LIKE :search 
                            OR s.nome_servico LIKE :search OR vac.data_aplicacao LIKE :search
                            OR vac.data_prox_dose LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function buscarPorIdVac($id_vacinacao)
    {
        $sql = "SELECT 
                vac.*, 
                p.id_pet, p.nome_pet, 
                cli.id AS cliente_id,
                cli.nome AS cliente_nome,
                resp.id AS responsavel_id, 
                resp.login AS responsavel_login,
                s.nome_servico
                FROM vacinacao AS vac
                INNER JOIN servicos AS s ON s.id_servico = vac.id_vacina_servico
                LEFT JOIN pets AS p ON p.id_pet = vac.id_pet_vacinacao
                LEFT JOIN usuarios AS cli ON cli.id = vac.id_cliente_vacinacao
                LEFT JOIN usuarios AS resp ON resp.id = vac.id_vet_vacinacao
                WHERE id_vacinacao = :id_vacinacao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_vacinacao' => $id_vacinacao]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
