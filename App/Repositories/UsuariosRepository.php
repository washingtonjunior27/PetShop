<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;

class UsuariosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    public function TrackUserController($usuarioColumn, $usuarioData)
    {
        $sql = "SELECT * FROM usuarios WHERE {$usuarioColumn} = :{$usuarioColumn}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":{$usuarioColumn}" => $usuarioData]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
