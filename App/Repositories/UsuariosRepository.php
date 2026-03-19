<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;
use App\Models\Usuarios;

class UsuariosRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
    }

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

    // HELPER PARA CONTAR OS FUNCIONARIOS
    public function CountHelperRepository($sql, $search)
    {
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (login LIKE :search OR role LIKE :search OR status LIKE :search)";
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
            $sql .= " AND (login LIKE :search OR role LIKE :search OR status LIKE :search)";
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

    // DELETAR USUARIO
    public function DeleteUsuarioRepository($id_usuario)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_usuario]);
    }

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
}
