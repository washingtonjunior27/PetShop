<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;
use App\Models\Usuarios;
use App\Models\Veterinarios;

class VeterinariosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    // VETERINARIO
    public function CreateVeterinarioRepository(Veterinarios $veterinario)
    {
        $sql = "INSERT INTO veterinarios (crmv, especialidade, id_usuario) 
                VALUES (:crmv, :especialidade, :id_usuario)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":crmv" => $veterinario->getCrmv(),
            ":especialidade" => $veterinario->getEspecialidade(),
            ":id_usuario" => $veterinario->getId_usuario()
        ]);
    }
    // LER E PESQUISAR VETERINARIOS
    public function ReadVeterinarioRepository($search, $limit, $offset)
    {
        $sql = "SELECT * FROM usuarios 
        INNER JOIN veterinarios ON id = id_usuario
        WHERE 1 = 1 AND (role = 'Veterinario')";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (login LIKE :search  OR status LIKE :search OR especialidade LIKE :search)";
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
    // CONTAR TODOS OS VETERINARIOS
    public function CountVeterinarioRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM usuarios 
        INNER JOIN veterinarios ON id = id_usuario
        WHERE 1 = 1 AND (role = 'Veterinario')";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (login LIKE :search OR status LIKE :search OR especialidade LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params[":search"] = $searchItem;
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function TrackCrmvRepository($crmv)
    {
        $sql = "SELECT crmv FROM veterinarios WHERE crmv = :crmv";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":crmv" => $crmv]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
