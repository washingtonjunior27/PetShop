<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Models\Pets;
use PDO;
use PDOException;

class PetsRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConn();
    }

    public function CreatePetRepository(Pets $pets)
    {
        $sql = "INSERT INTO pets (nome_pet, sexo_pet, cor_pet, peso_pet, cliente_id_fk, especie_id_fk, raca_id_fk) 
                VALUES (:nome_pet, :sexo_pet, :cor_pet, :peso_pet, :cliente_id_fk, :especie_id_fk, :raca_id_fk)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome_pet" => $pets->getNome_pet(),
            ":sexo_pet" => $pets->getSexo_pet(),
            ":cor_pet" => $pets->getCor_pet(),
            ":peso_pet" => $pets->getPeso_pet(),
            ":cliente_id_fk" => $pets->getCliente_id_fk(),
            ":especie_id_fk" => $pets->getEspecie_id_fk(),
            ":raca_id_fk" => $pets->getRaca_id_fk()
        ]);
    }

    // LER E PESQUISAR PETS
    public function ReadPetsRepository($search, $limit, $offset)
    {
        $sql = "SELECT * FROM pets AS p
        INNER JOIN usuarios AS u ON u.id = p.cliente_id_fk
        INNER JOIN especies AS e ON e.id_especie = p.especie_id_fk
        INNER JOIN racas AS r ON r.id_raca = p.raca_id_fk
        WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (p.nome_pet LIKE :search OR u.nome LIKE :search OR e.nome_especie LIKE :search)";
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
    // CONTAR TODOS OS PETS
    public function CountPetsRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM pets AS p
        INNER JOIN usuarios AS u ON u.id = p.cliente_id_fk
        INNER JOIN especies AS e ON e.id_especie = p.especie_id_fk
        INNER JOIN racas AS r ON r.id_raca = p.raca_id_fk
        WHERE 1 = 1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (p.nome_pet LIKE :search OR u.nome LIKE :search OR e.nome_especie LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params[":search"] = $searchItem;
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    // UPDATE
    public function UpdatePetRepository(Pets $pets)
    {
        $sql = "UPDATE pets SET nome_pet = :nome_pet, sexo_pet = :sexo_pet, cor_pet = :cor_pet, 
        peso_pet = :peso_pet, cliente_id_fk = :cliente_id_fk, especie_id_fk = :especie_id_fk, 
        raca_id_fk = :raca_id_fk WHERE id_pet = :id_pet";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome_pet" => $pets->getNome_pet(),
            ":sexo_pet" => $pets->getSexo_pet(),
            ":cor_pet" => $pets->getCor_pet(),
            ":peso_pet" => $pets->getPeso_pet(),
            ":cliente_id_fk" => $pets->getCliente_id_fk(),
            ":especie_id_fk" => $pets->getEspecie_id_fk(),
            ":raca_id_fk" => $pets->getRaca_id_fk(),
            ":id_pet" => $pets->getId_pet()
        ]);
    }

    // DELETE
    public function DeletePetRepository($id_pet)
    {
        $sql = "DELETE FROM pets WHERE id_pet = :id_pet";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_pet' => $id_pet]);
    }

    public function getRacasPorEspecie($especie_id)
    {
        $stmt = $this->pdo->prepare("SELECT id_raca, nome_raca FROM racas WHERE id_especie_fk = :id_especie_fk");
        $stmt->execute([":id_especie_fk" => $especie_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPetsPorCliente($cliente_id)
    {
        $stmt = $this->pdo->prepare("SELECT id_pet, nome_pet FROM pets WHERE cliente_id_fk = :cliente_id_fk");
        $stmt->execute([":cliente_id_fk" => $cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
