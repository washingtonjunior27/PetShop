<?php

namespace App\Repositories;

use App\Config\Connection;
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

    public function CreateEspecieRepository($nomeEspecie)
    {
        $sql = "INSERT INTO especies (nome_especie) VALUES (:nome_especie)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nome_especie' => $nomeEspecie]);
    }

    public function TrackEspecieRepository($nome_especie)
    {
        $sql = "SELECT * FROM especies WHERE nome_especie = :nome_especie";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nome_especie' => $nome_especie]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
