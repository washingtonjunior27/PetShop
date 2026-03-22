<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Config\Connection;
use App\Models\Usuarios;
use App\Repositories\FuncionariosRepository;

class ClientesRepository
{
    private $pdo;
    private $funcRepository;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->getConn();
        $this->funcRepository = new FuncionariosRepository();
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

        $result = $this->funcRepository->ReadHelperRepository($sql, $search, $limit, $offset);

        return $result;
    }
    // CONTAR TODOS OS Clientes
    public function CountClienteRepository($search)
    {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE 1 = 1 AND role = 'Cliente'";

        return $this->funcRepository->CountHelperRepository($sql, $search);
    }

    // DELETAR USUARIO
    public function DeleteClienteRepository($id_usuario)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_usuario]);
    }
}
