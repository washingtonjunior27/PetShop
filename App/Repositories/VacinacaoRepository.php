<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;
use App\Models\Vacinacao;

class VacinacaoRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection;
        $this->pdo = $conn->getConn();
    }

    public function CreateVacinacaoRepository(Vacinacao $vacinacao)
    {
        $sql = "INSERT INTO vacinacao (data_aplicacao, data_prox_dose, created_at, id_agend_vacinacao, id_cliente_vacinacao, 
                                        id_pet_vacinacao, id_vet_vacinacao, id_vacina_servico, resolvido)
                VALUES (:data_aplicacao, :data_prox_dose, :created_at, :id_agend_vacinacao, :id_cliente_vacinacao, 
                         :id_pet_vacinacao, :id_vet_vacinacao, :id_vacina_servico, :resolvido)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':data_aplicacao' => $vacinacao->getData_de_aplicação(),
            ':data_prox_dose' => $vacinacao->getData_prox_dose(),
            ':created_at' => $vacinacao->getCreated_at(),
            ':id_agend_vacinacao' => $vacinacao->getId_agend_vacinacao(),
            ':id_cliente_vacinacao' => $vacinacao->getCliente_id_vacinacao(),
            ':id_pet_vacinacao' => $vacinacao->getPet_id_vacinacao(),
            ':id_vet_vacinacao' => $vacinacao->getVeterinario_id_vacinacao(),
            ':id_vacina_servico' => $vacinacao->getId_vacina_servico(),
            ':resolvido' => $vacinacao->getResolvido()
        ]);

        return $this->pdo->lastInsertId();
    }

    public function ReadVacinacaoRepository($search, $limit, $offset, $id_user, $role)
    {
        $sql = "SELECT *,
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

        if (!empty($search)) {
            $sql .= " AND (vac.data_aplicacao LIKE :search OR vac.data_prox_dose LIKE :search 
                            OR p.nome_pet LIKE :search OR cli.nome LIKE :search 
                            OR resp.login LIKE :search OR s.nome_servico LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        if ($role !== 'Admin') {
            $sql .= ' AND vac.id_vet_vacinacao = :id_user';
            $params[':id_user'] = $id_user;
        }

        $sql .= ' GROUP BY vac.id_vacinacao';
        $sql .= ' ORDER BY vac.data_aplicacao ASC, vac.data_prox_dose ASC';

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

    public function CountVacinacaoRepository($search, $id_user, $role)
    {
        $sql = "SELECT COUNT(DISTINCT vac.id_vacinacao)
            FROM vacinacao AS vac
            INNER JOIN servicos AS s ON s.id_servico = vac.id_vacina_servico
            LEFT JOIN pets AS p ON p.id_pet = vac.id_pet_vacinacao
            LEFT JOIN usuarios AS cli ON cli.id = vac.id_cliente_vacinacao
            LEFT JOIN usuarios AS resp ON resp.id = vac.id_vet_vacinacao
            WHERE 1 = 1";

        $params = [];


        if (!empty($search)) {
            $sql .= " AND (vac.data_aplicacao LIKE :search OR vac.data_prox_dose LIKE :search 
                            OR p.nome_pet LIKE :search OR cli.nome LIKE :search 
                            OR resp.login LIKE :search OR s.nome_servico LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        if ($role !== 'Admin') {
            $sql .= ' AND vac.id_vet_vacinacao = :id_user';
            $params[':id_user'] = $id_user;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function UpdateResolvidoVac($id_vacinacao)
    {
        $sql = "UPDATE vacinacao SET resolvido = 1 WHERE id_vacinacao = :id_vacinacao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_vacinacao' => $id_vacinacao]);
    }
}
