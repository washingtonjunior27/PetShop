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
        $sql = "INSERT INTO agendamentos_servicos (orcamento, executado, id_agend_fk, id_serv_fk)
                VALUES (:orcamento, :executado, :id_agend_fk, :id_serv_fk)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "orcamento" => $agendamentosServicos->getOrcamento(),
            "executado" => $agendamentosServicos->getExecutado(),
            "id_agend_fk" => $agendamentosServicos->getId_agend_fk(),
            "id_serv_fk" => $agendamentosServicos->getId_serv_fk()
        ]);
    }

    public function ReadOrcamentoRepository()
    {
        $sql = "SELECT SUM(agse.orcamento) AS total_receita FROM agendamentos_servicos AS agse
                INNER JOIN agendamentos AS ag ON ag.id_agend = agse.id_agend_fk
                WHERE agse.executado = 'Sim'
                        AND (MONTH(ag.data_agend) = MONTH(CURDATE())
                            AND YEAR(ag.data_agend) = YEAR(CURDATE()))";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_receita'] ?? 0;
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

    public function UpdateStatusExecutado($id_agend_fk, $categoria)
    {
        $sql = "UPDATE agendamentos_servicos AS agse  
                INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk 
                SET executado = 'Sim'
                WHERE id_agend_fk = :id_agend_fk AND s.categoria_servico = :categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_agend_fk' => $id_agend_fk, ':categoria' => $categoria]);
    }

    public function buscarServicoNoAgendamento($id_agend, $id_serv)
    {
        $sql = "SELECT COUNT(*)
                FROM agendamentos_servicos AS agse
                WHERE agse.id_agend_fk = :id_agend AND agse.id_serv_fk = :id_serv";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_agend' => $id_agend, ':id_serv' => $id_serv]);
        return $stmt->fetchColumn();
    }

    public function buscarPrecoServico($id_servico)
    {
        $sql = "SELECT preco_servico FROM servicos WHERE id_servico = :id_servico";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_servico' => $id_servico]);
        return $stmt->fetchColumn(); // Retorna apenas o valor (ex: 85.50)
    }

    public function adicionarServicoAoAgendamento($id_agend, $id_servico, $orcamento)
    {
        $sql = "INSERT INTO agendamentos_servicos (id_agend_fk, id_serv_fk, orcamento, executado) 
            VALUES (:id_agend_fk, :id_serv_fk, :orcamento, 'Sim')";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id_agend_fk' => $id_agend,
            ':id_serv_fk'  => $id_servico,
            ':orcamento' => $orcamento
        ]);
    }
}
