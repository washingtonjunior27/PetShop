<?php

namespace App\Config;

use PDO;
use PDOException;

class Connection
{
    private $db_host = "localhost";
    private $db_name = "petshop";
    private $db_user = "root";
    private $db_password = "";

    public function getConn()
    {
        try {
            $con = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name .
                ";charset=utf8", $this->db_user, $this->db_password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            echo "Erro de conexão" . $e->getMessage();
        }
    }
}
