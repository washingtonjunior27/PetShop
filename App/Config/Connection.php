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

    // Variável estática que guardará a instância da conexão
    private static $instance;

    public function getConn()
    {
        // Se a instância ainda não existir, cria uma
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";charset=utf8",
                    $this->db_user,
                    $this->db_password
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Opcional: Ajuda no InfinityFree a reutilizar conexões
                self::$instance->exec("SET time_zone = '-04:00'");
                self::$instance->setAttribute(PDO::ATTR_PERSISTENT, true);
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }

        // Retorna a instância única
        return self::$instance;
    }
}
