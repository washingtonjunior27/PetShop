<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Models\Servicos;
use PDO;
use PDOException;

class ServicosRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConn();
    }

    public function CreateServicoRepository(Servicos $servico)
    {
        $sql = "INSERT INTO servicos (nome_servico, preco_servico, duracao_minutos, descricao_servico)
                VALUES (:nome_servico, :preco_servico, :duracao_minutos, :descricao_servico)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome_servico" => $servico->getNome_servico(),
            ":preco_servico" => $servico->getPreco_servico(),
            ":duracao_minutos" => $servico->getDuracao_minutos(),
            ":descricao_servico" => $servico->getDescricao_servico()
        ]);
    }

    // READ
    public function ReadServicosRepository($search, $limit, $offset)
    {
        $sql = "SELECT * FROM servicos WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nome_servico LIKE :search OR preco_servico LIKE :search OR duracao_minutos LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params["search"] = $searchItem;
        }

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

    // COUNT
    public function CountServicosRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM servicos WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nome_servico LIKE :search OR preco_servico LIKE :search OR duracao_minutos LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params[":search"] = $searchItem;
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function UpdateServicoRepository(Servicos $servico)
    {
        $sql = "UPDATE servicos SET nome_servico = :nome_servico, preco_servico = :preco_servico,
                duracao_minutos = :duracao_minutos, descricao_servico = :descricao_servico
                WHERE id_servico = :id_servico";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome_servico" => $servico->getNome_Servico(),
            ":preco_servico" => $servico->getPreco_servico(),
            ":duracao_minutos" => $servico->getDuracao_minutos(),
            ":descricao_servico" => $servico->getDescricao_servico(),
            ":id_servico" => $servico->getId_servico()
        ]);
    }

    // DELETAR SERVICO
    public function DeleteServicoRepository($id_servico)
    {
        $sql = "DELETE FROM servicos WHERE id_servico = :id_servico";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_servico' => $id_servico]);
    }

    public function TrackServicoRepository($nome_servico)
    {
        $sql = "SELECT * FROM servicos WHERE nome_servico = :nome_servico";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nome_servico" => $nome_servico]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
