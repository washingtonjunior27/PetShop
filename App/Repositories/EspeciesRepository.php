<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Models\Especies;
use PDO;
use PDOException;

class EspeciesRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConn();
    }

    // CREATE
    public function CreateEspecieRepository($nomeEspecie)
    {
        $sql = "INSERT INTO especies (nome_especie) VALUES (:nome_especie)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nome_especie' => $nomeEspecie]);
    }

    // READ
    public function ReadEspeciesRepository($search, $limit, $offset)
    {
        $sql = "SELECT * FROM especies WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nome_especie LIKE :search)";
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
    public function CountEspeciesRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM especies WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nome_especie LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params[":search"] = $searchItem;
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    //UPDATE
    public function UpdateEspecieRepository(Especies $especie)
    {
        $sql = "UPDATE especies SET nome_especie = :nome_especie WHERE id_especie = :id_especie";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome_especie" => $especie->getNome_especie(),
            ":id_especie" => $especie->getId_especie()
        ]);
    }

    // DELETE
    public function DeleteEspecieRepository($id_especie)
    {
        $sql = "DELETE FROM especies WHERE id_especie = :id_especie";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_especie' => $id_especie]);
    }

    // TRACK
    public function TrackEspecieRepository($nome_especie)
    {
        $sql = "SELECT * FROM especies WHERE nome_especie = :nome_especie";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nome_especie' => $nome_especie]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
