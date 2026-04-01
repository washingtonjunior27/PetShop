<?php

namespace App\Repositories;

use App\Models\Agendamentos_Servicos;
use PDO;
use PDOException;
use App\Config\Connection;

class AgendamentosServicosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    public function CreateAgendServRepository(Agendamentos_Servicos $agendamentosServicos)
    {
        $sql = "INSERT INTO agendamentos_servicos (preco, executado, id_agend_fk, id_serv_fk)
                VALUES (:preco, :executado, :id_agend_fk, :id_serv_fk)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "preco" => $agendamentosServicos->getPreco(),
            "executado" => $agendamentosServicos->getExecutado(),
            "id_agend_fk" => $agendamentosServicos->getId_agend_fk(),
            "id_serv_fk" => $agendamentosServicos->getId_serv_fk()
        ]);
    }
}
