<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Models\Vacinas;
use PDO;
use PDOException;

class VacinasRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConn();
    }

    public function CreateVacinaRepository(Vacinas $vacina)
    {
        $sql = "INSERT INTO vacinas (nome_vacina, preco_vacina, duracao_retorno, descricao_vacina)
                VALUES (:nome_vacina, :preco_vacina, :duracao_retorno, :descricao_vacina)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome_vacina" => $vacina->getNome_vacina(),
            ":preco_vacina" => $vacina->getPreco_vacina(),
            ":duracao_retorno" => $vacina->getDuracao_retorno(),
            ":descricao_vacina" => $vacina->getDescricao_vacina()
        ]);
    }

    // READ
    public function ReadVacinasRepository($search, $limit, $offset)
    {
        $sql = "SELECT * FROM vacinas WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nome_vacina LIKE :search OR preco_vacina LIKE :search)";
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
    public function CountVacinasRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM vacinas WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nome_vacina LIKE :search OR preco_vacina LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params[":search"] = $searchItem;
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function TrackVacinaRepository($nome_vacina)
    {
        $sql = "SELECT * FROM vacinas WHERE nome_vacina = :nome_vacina";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nome_vacina" => $nome_vacina]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
