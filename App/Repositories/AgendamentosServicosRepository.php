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

    public function buscarPorIdAgendServs($id_agend)
    {
        $sql = "SELECT *
                FROM agendamentos_servicos AS agse
                INNER JOIN agendamentos AS ag ON ag.id_agend = agse.id_agend_fk
                WHERE agse.id_agend_fk = :id_agend";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_agend' => $id_agend]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UpdateStatusExecutado($id_agend_serv, $categoria)
    {
        $sql = "UPDATE agendamentos_servicos AS agse  
                INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk 
                SET executado = 'Sim'
                WHERE id_agend_serv = :id_agend_serv AND s.categoria_servico = :categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_agend_serv' => $id_agend_serv, ':categoria' => $categoria]);
    }
}
