<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Models\Racas;
use PDO;
use PDOException;

class RacasRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConn();
    }

    public function CreateRacaRepository(Racas $raca)
    {
        $sql = "INSERT INTO racas (nome_raca, id_especie_fk) VALUES (:nome_raca, :id_especie_fk)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome_raca' => $raca->getNome_raca(),
            ":id_especie_fk" => $raca->getId_especie_fk()
        ]);
    }

    // LER E PESQUISAR RAÇAS
    public function ReadRacasRepository($search, $limit, $offset)
    {
        $sql = "SELECT * FROM racas 
        INNER JOIN especies ON id_especie = id_especie_fk
        WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nome_especie LIKE :search  OR nome_raca LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params["search"] = $searchItem;
        }

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // CONTAR TODOS AS RAÇAS
    public function CountRacasRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM racas 
        INNER JOIN especies ON id_especie = id_especie_fk
        WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nome_especie LIKE :search  OR nome_raca LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params[":search"] = $searchItem;
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    // EDITAR RAÇAS
    public function UpdateRacaRepository(Racas $raca)
    {
        $sql = "UPDATE racas SET nome_raca = :nome_raca, id_especie_fk = :id_especie_fk WHERE id_raca = :id_raca";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome_raca" => $raca->getNome_raca(),
            ":id_especie_fk" => $raca->getId_especie_fk(),
            ":id_raca" => $raca->getId_raca()
        ]);
    }

    // DELETAR RAÇAS
    public function DeleteRacaRepository($id_raca)
    {
        $sql = "DELETE FROM racas WHERE id_raca = :id_raca";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_raca' => $id_raca]);
    }

    public function TrackRacaRepository($nome_raca, $id_especie_fk)
    {
        $sql = ("SELECT * FROM racas WHERE nome_raca = :nome_raca AND id_especie_fk = :id_especie_fk");
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':nome_raca' => $nome_raca, "id_especie_fk" => $id_especie_fk]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
