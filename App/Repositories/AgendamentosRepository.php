<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;

class AgendamentosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    public function ReadAllFuncAndVetRepository()
    {
        $sql = "SELECT * FROM usuarios WHERE 1 = 1 AND (role = 'Esteticista' OR role = 'Veterinario')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
