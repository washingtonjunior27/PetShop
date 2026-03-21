<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;
use App\Models\Usuarios;
use App\Models\Veterinarios;

class UsuariosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

    // FUNCIONARIOS
    // CRIAR USUARIO
    public function CreateUsuarioRepository(Usuarios $usuario)
    {
        $sql = "INSERT INTO usuarios (nome, login, email, senha, telefone, role, status, primeiro_acesso)
        VALUES (:nome, :login, :email, :senha, :telefone, :role, :status, :primeiro_acesso)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $usuario->getNome(),
            ":login" => $usuario->getLogin(),
            ":email" => $usuario->getEmail(),
            ":senha" => $usuario->getSenha(),
            ":telefone" => $usuario->getTelefone(),
            ":role" => $usuario->getRole(),
            ":status" => $usuario->getStatus(),
            ":primeiro_acesso" => $usuario->getPrimeiro_acesso()
        ]);

        return $this->pdo->lastInsertId();
    }

    // LER E PESQUISAR FUNCIONARIOS
    public function ReadFuncionarioRepository($search, $limit, $offset)
    {
        $sql = "SELECT * FROM usuarios WHERE 1 = 1 AND (role = 'Atendente' OR role = 'Esteticista')";

        $result = $this->ReadHelperRepository($sql, $search, $limit, $offset);

        return $result;
    }
    // CONTAR TODOS OS FUNCIONARIOS
    public function CountFuncionarioRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE 1 = 1 AND (role = 'Atendente' OR role = 'Esteticista')";

        return $this->CountHelperRepository($sql, $search);
    }



    // EDITAR FUNCIONARIO
    public function UpdateUsuarioRepository(Usuarios $usuario)
    {
        $sql = "UPDATE usuarios SET nome = :nome, login = :login, email = :email, telefone = :telefone, role = :role, status = :status
        WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $usuario->getNome(),
            ":login" => $usuario->getLogin(),
            ":email" => $usuario->getEmail(),
            ":telefone" => $usuario->getTelefone(),
            ":role" => $usuario->getRole(),
            ":status" => $usuario->getStatus(),
            ":id" => $usuario->getId()
        ]);
    }

    // DELETAR USUARIO
    public function DeleteUsuarioRepository($id_usuario)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_usuario]);
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

    // -------------------------------------------------------------------------------------
    // CLIENTES
    // CRIAR USUARIO
    public function CreateClienteRepository(Usuarios $usuario)
    {
        $sql = "INSERT INTO usuarios (nome, email, telefone, role)
        VALUES (:nome, :email, :telefone, :role)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $usuario->getNome(),
            ":email" => $usuario->getEmail(),
            ":telefone" => $usuario->getTelefone(),
            ":role" => $usuario->getRole()
        ]);
    }

    // EDITAR CLIENTE
    public function UpdateClienteRepository(Usuarios $usuario)
    {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, role = :role
        WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $usuario->getNome(),
            ":email" => $usuario->getEmail(),
            ":telefone" => $usuario->getTelefone(),
            ":role" => $usuario->getRole(),
            ":id" => $usuario->getId()
        ]);
    }

    // LER E PESQUISAR Clientes
    public function ReadClienteRepository($search, $limit, $offset)
    {
        $sql = "SELECT * FROM usuarios WHERE 1 = 1 AND role = 'Cliente'";

        $result = $this->ReadHelperRepository($sql, $search, $limit, $offset);

        return $result;
    }
    // CONTAR TODOS OS Clientes
    public function CountClienteRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE 1 = 1 AND role = 'Cliente'";

        return $this->CountHelperRepository($sql, $search);
    }


    // --------------------------------------------------------------------------------------
    // HELPERS
    // ENCONTRAR USUARIO
    public function TrackUserRepository($usuarioColumn, $usuarioData)
    {
        $sql = "SELECT * FROM usuarios WHERE {$usuarioColumn} = :{$usuarioColumn}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":{$usuarioColumn}" => $usuarioData]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ATUALIZAR NOVA SENHA E PRIMEIRO ACESSO
    public function UpdatePrimeiroAcessoRepository($senha, $usuario_id)
    {
        $sql = "UPDATE usuarios SET senha = :senha, primeiro_acesso = 2 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":senha" => $senha,
            ":id" => $usuario_id
        ]);
    }

    // HELPER PARA CONTAR OS USUARIOS
    public function CountHelperRepository($sql, $search)
    {
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (login LIKE :search OR email LIKE :search OR role LIKE :search 
            OR telefone LIKE :search OR status LIKE :search)";
            $searchItem = "%" . $search . "%";
            $params[":search"] = $searchItem;
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    // HELPER PARA LER E PESQUISAR
    public function ReadHelperRepository($sql, $search, $limit, $offset)
    {
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (login LIKE :search OR email LIKE :search OR role LIKE :search 
                        OR telefone LIKE :search OR status LIKE :search)";
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
}
