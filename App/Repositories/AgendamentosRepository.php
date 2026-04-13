<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;
use App\Models\Agendamentos;
use App\Models\Atendimentos;
use App\Models\Estetica;

class AgendamentosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    public function CreateAgendamentoRepository(Agendamentos $agend)
    {
        $sql = "INSERT INTO agendamentos (data_agend, hora_agend_inicio, hora_agend_fim, data_criacao_agend,
                status_agend, descricao_agend, cliente_id_agend, pet_id_agend, responsavel_id_agend)
                VALUES (:data_agend, :hora_agend_inicio, :hora_agend_fim, :data_criacao_agend,
                :status_agend, :descricao_agend, :cliente_id_agend, :pet_id_agend, :responsavel_id_agend)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "data_agend" => $agend->getData_agend(),
            "hora_agend_inicio" => $agend->getHora_agend_inicio(),
            "hora_agend_fim" => $agend->getHora_agend_fim(),
            "data_criacao_agend" => $agend->getData_criacao_agend(),
            "status_agend" => $agend->getStatus_agend(),
            "descricao_agend" => $agend->getDescricao_agend(),
            "cliente_id_agend" => $agend->getCliente_id_agend(),
            "pet_id_agend" => $agend->getPet_id_agend(),
            "responsavel_id_agend" => $agend->getResponsavel_id_agend()
        ]);

        return $this->pdo->lastInsertId();
    }

    public function ReadAllFuncAndVetRepository()
    {
        $sql = "SELECT u.*, v.especialidade 
                FROM usuarios AS u
                LEFT JOIN veterinarios AS v ON u.id = v.id_usuario
                WHERE 1 = 1 AND (role = 'Esteticista' OR role = 'Veterinario')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UpdateStatusAgend($status_agend, $id_agend)
    {
        $sql = "UPDATE agendamentos SET status_agend = :status_agend WHERE id_agend = :id_agend";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':status_agend' => $status_agend,
            ':id_agend' => $id_agend
        ]);
    }

    public function ReadAgendsRepository($search, $limit, $offset, $id_user, $role, $categoriaDesejada)
    {
        $sql = "SELECT 
                ag.*, 
                p.id_pet, p.nome_pet, 
                cli.id AS cliente_id,
                cli.nome AS cliente_nome,
                cli.telefone AS cliente_telefone,
                resp.id AS responsavel_id, 
                resp.login AS responsavel_login,
                resp.role AS responsavel_role,
                vet.especialidade AS veterinario_especialidade,
                CASE 
                    WHEN (ag.status_agend IN ('Agendado', 'Confirmado', 'Em atendimento')) AND 
                            (TIMESTAMP(ag.data_agend, ag.hora_agend_inicio) < NOW())
                    THEN 'Atrasado'
                    ELSE 'Em dia'
                END AS status_real,
                GROUP_CONCAT(s.nome_servico SEPARATOR ', ') AS nomes_servicos,
                GROUP_CONCAT(s.categoria_servico SEPARATOR ', ') AS categorias_servicos,
                GROUP_CONCAT(CASE WHEN s.categoria_servico = 'Vacina' THEN s.id_servico END) AS vacina_id,
                GROUP_CONCAT(CASE WHEN s.categoria_servico = 'Vacina' THEN s.nome_servico END) AS vacina_nome
            FROM agendamentos AS ag
            INNER JOIN agendamentos_servicos AS agse ON ag.id_agend = agse.id_agend_fk
            INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
            LEFT JOIN pets AS p ON p.id_pet = ag.pet_id_agend
            LEFT JOIN usuarios AS cli ON cli.id = ag.cliente_id_agend
            LEFT JOIN usuarios AS resp ON resp.id = ag.responsavel_id_agend
            LEFT JOIN veterinarios AS vet ON vet.id_usuario = ag.responsavel_id_agend
            WHERE 1 = 1";

        $params = [];

        if ($categoriaDesejada) {
            if ($categoriaDesejada === "Atendimentos") {
                $categorias = "'Consulta', 'Vacina'";
            } else {
                $categorias = "'$categoriaDesejada'";
            }

            $sql .= " AND (ag.status_agend = 'Em atendimento') AND ag.id_agend IN (
                SELECT id_agend_fk FROM agendamentos_servicos AS agse2
                INNER JOIN servicos AS s2 ON s2.id_servico = agse2.id_serv_fk
                WHERE s2.categoria_servico IN ($categorias)
                )";
        } else {
            $sql .= " AND (ag.status_agend = 'Agendado' OR ag.status_agend = 'Confirmado')";
        }

        if ($role !== 'Admin' && $role !== 'Atendente') {
            $sql .= ' AND ag.responsavel_id_agend = :id_user';
            $params[':id_user'] = $id_user;
        }

        if (!empty($search)) {
            $sql .= " AND (ag.data_agend LIKE :search OR p.nome_pet LIKE :search OR cli.nome LIKE :search 
                            OR ag.hora_agend_inicio LIKE :search OR cli.telefone LIKE :search 
                            OR resp.role LIKE :search OR resp.login LIKE :search 
                            OR s.nome_servico LIKE :search OR vet.especialidade LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        $sql .= ' GROUP BY ag.id_agend';
        $sql .= ' ORDER BY ag.data_agend ASC, ag.hora_agend_inicio ASC';

        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function CountAgendsRepository($search, $id_user, $role, $categoriaDesejada)
    {
        $sql = "SELECT COUNT(DISTINCT ag.id_agend)
            FROM agendamentos AS ag
            INNER JOIN agendamentos_servicos AS agse ON ag.id_agend = agse.id_agend_fk
            INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
            LEFT JOIN pets AS p ON p.id_pet = ag.pet_id_agend
            LEFT JOIN usuarios AS cli ON cli.id = ag.cliente_id_agend
            LEFT JOIN usuarios AS resp ON resp.id = ag.responsavel_id_agend
            LEFT JOIN veterinarios AS vet ON vet.id_usuario = ag.responsavel_id_agend
            WHERE 1 = 1";

        $params = [];

        // IGUALDADE DE LÓGICA COM O READ
        if ($categoriaDesejada) {
            if ($categoriaDesejada === "Atendimentos") {
                $categorias = "'Consulta', 'Vacina'";
            } else {
                $categorias = "'$categoriaDesejada'";
            }

            $sql .= " AND (ag.status_agend = 'Em atendimento') AND ag.id_agend IN (
                SELECT id_agend_fk FROM agendamentos_servicos AS agse2
                INNER JOIN servicos AS s2 ON s2.id_servico = agse2.id_serv_fk
                WHERE s2.categoria_servico IN ($categorias)
                )";
        } else {
            $sql .= " AND (ag.status_agend = 'Agendado' OR ag.status_agend = 'Confirmado')";
        }

        if ($role !== 'Admin' && $role !== 'Atendente') {
            $sql .= ' AND ag.responsavel_id_agend = :id_user';
            $params[':id_user'] = $id_user;
        }

        if (!empty($search)) {
            $sql .= " AND (ag.data_agend LIKE :search OR p.nome_pet LIKE :search OR cli.nome LIKE :search 
                            OR ag.hora_agend_inicio LIKE :search OR cli.telefone LIKE :search 
                            OR resp.role LIKE :search OR resp.login LIKE :search 
                            OR s.nome_servico LIKE :search OR vet.especialidade LIKE :search)";
            $params[":search"] = "%" . $search . "%";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function CreateEsteticaHistory(Estetica $estet)
    {
        $sql = "INSERT INTO estetica (observacao, created_at, id_agend_fk) VALUES (:observacao, :created_at, :id_agend_fk)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':observacao' => $estet->getObservacao(),
            ':created_at' => $estet->getCreated_at(),
            ':id_agend_fk' => $estet->getId_agend_fk()
        ]);
    }

    public function CreateAtendimento(Atendimentos $atend)
    {
        $sql = "INSERT INTO atendimentos (anamnese, diagnostico, tratamento, created_at, 
                                        id_agend, pet_id, cliente_id, veterinario_id) 
                VALUES (:anamnese, :diagnostico, :tratamento, :created_at, 
                        :id_agend, :pet_id, :cliente_id, :veterinario_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':anamnese' => $atend->getAnamnese(),
            ':diagnostico' => $atend->getDiagnostico(),
            ':tratamento' => $atend->getTratamento(),
            ':created_at' => $atend->getCreated_at(),
            ':id_agend' => $atend->getId_agend(),
            ':pet_id' => $atend->getPet_id(),
            ':cliente_id' => $atend->getCliente_id(),
            ':veterinario_id' => $atend->getVeterinario_id()
        ]);
    }

    public function FindAgendDiag($id_agend)
    {
        $sql = "SELECT id_atendimento FROM atendimentos
                WHERE id_agend = :id_agend";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_agend' => $id_agend]);
        return $stmt->fetchColumn();
    }

    public function buscarPorId($id_agend)
    {
        $sql = "SELECT *, id_pet ,nome_pet, 
                        cli.id AS cliente_id, 
                        cli.nome AS cliente_nome, 
                        vet.id AS vet_id, 
                        vet.nome AS vet_nome,
                        GROUP_CONCAT(s.categoria_servico SEPARATOR ', ') AS categorias_servicos
                FROM agendamentos
                INNER JOIN agendamentos_servicos AS agse ON id_agend = agse.id_agend_fk
                INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
                LEFT JOIN pets ON id_pet = pet_id_agend
                LEFT JOIN usuarios AS cli ON cli.id = cliente_id_agend
                LEFT JOIN usuarios AS vet ON vet.id = responsavel_id_agend
                WHERE id_agend = :id_agend";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_agend' => $id_agend]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function ReadAgendsRepositoryHoje($id_user, $role, $categoriaDesejada)
    {
        $sql = "SELECT 
                ag.*, 
                p.nome_pet, 
                cli.id AS cliente_id,
                cli.nome AS cliente_nome,
                cli.telefone AS cliente_telefone,
                resp.id AS responsavel_id, 
                resp.login AS responsavel_login,
                resp.role AS responsavel_role,
                vet.especialidade AS veterinario_especialidade,
                CASE 
                    WHEN (ag.status_agend IN ('Agendado', 'Confirmado', 'Em atendimento')) AND 
                            (TIMESTAMP(ag.data_agend, ag.hora_agend_inicio) < NOW())
                    THEN 'Atrasado'
                    ELSE 'Em dia'
                END AS status_real,
                CASE
                    WHEN (ag.status_agend = 'Agendado') THEN 1
                    WHEN (ag.status_agend = 'Confirmado') THEN 2
                    WHEN (ag.status_agend = 'Em atendimento') THEN 3
                    WHEN (ag.status_agend = 'Finalizado') THEN 4
                    ELSE 5
                END AS status_order,
                GROUP_CONCAT(s.nome_servico SEPARATOR ', ') AS nomes_servicos,
                GROUP_CONCAT(s.categoria_servico SEPARATOR ', ') AS categorias_servicos,
                GROUP_CONCAT(CASE WHEN s.categoria_servico = 'Vacina' THEN s.id_servico END) AS vacina_id,
                GROUP_CONCAT(CASE WHEN s.categoria_servico = 'Vacina' THEN s.nome_servico END) AS vacina_nome
            FROM agendamentos AS ag
            INNER JOIN agendamentos_servicos AS agse ON ag.id_agend = agse.id_agend_fk
            INNER JOIN servicos AS s ON s.id_servico = agse.id_serv_fk
            LEFT JOIN pets AS p ON p.id_pet = ag.pet_id_agend
            LEFT JOIN usuarios AS cli ON cli.id = ag.cliente_id_agend
            LEFT JOIN usuarios AS resp ON resp.id = ag.responsavel_id_agend
            LEFT JOIN veterinarios AS vet ON vet.id_usuario = ag.responsavel_id_agend
            WHERE ag.data_agend = CURDATE()";

        $params = [];

        if ($role != 'Admin') {
            if ($categoriaDesejada) {
                if ($categoriaDesejada === "Atendimentos") {
                    $categorias = "'Consulta', 'Vacina'";
                } else {
                    $categorias = "'$categoriaDesejada'";
                }

                $sql .= " AND (ag.status_agend = 'Em atendimento') AND ag.id_agend IN (
                SELECT id_agend_fk FROM agendamentos_servicos AS agse2
                INNER JOIN servicos AS s2 ON s2.id_servico = agse2.id_serv_fk
                WHERE s2.categoria_servico IN ($categorias)
                )";
            } else {
                $sql .= " AND (ag.status_agend = 'Agendado' OR ag.status_agend = 'Confirmado')";
            }
        }

        if ($role !== 'Admin' && $role !== 'Atendente') {
            $sql .= ' AND ag.responsavel_id_agend = :id_user';
            $params[':id_user'] = $id_user;
        }

        $sql .= ' GROUP BY ag.id_agend';
        $sql .= ' ORDER BY status_order ASC, ag.data_agend ASC, ag.hora_agend_inicio ASC LIMIT 4';

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function CountAgendsRepositoryHoje($id_user, $role, $status)
    {
        $sql = "SELECT COUNT(DISTINCT ag.id_agend)
            FROM agendamentos AS ag
            WHERE ag.data_agend = CURDATE()";

        $params = [];

        if ($role != 'Admin' && $role != "Atendente") {
            $sql .= " AND (responsavel_id_agend = :id_user)";
            $params['id_user'] = $id_user;
        }

        if ($role == "Atendente") {
            $sql .= " AND (status_agend = 'Agendado' OR status_agend = 'Confirmado')";
        }

        if ($status == "Em atendimento") {
            $sql .= " AND (status_agend = 'Em atendimento')";
        }

        if ($status == "Finalizado") {
            $sql .= " AND (status_agend = 'Finalizado')";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchColumn();
    }

    public function CountAgendsNaoConfRepository()
    {
        $sql = "SELECT COUNT(DISTINCT ag.id_agend)
            FROM agendamentos AS ag
            WHERE ag.data_agend = CURDATE() AND ag.status_agend = 'Agendado'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
