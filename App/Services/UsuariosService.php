<?php

namespace App\Services;

use App\Config\Connection;
use App\Repositories\UsuariosRepository;
use App\Models\Usuarios;
use App\Models\Veterinarios;
use PDO;
use PDOException;

class UsuariosService
{
    private $usuarioRepository;
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConn();
        $this->usuarioRepository = new UsuariosRepository();
    }

    // FUNCIONARIOS
    public function CreateUsuarioService(Usuarios $usuario)
    {
        if (
            !$usuario->getNome() || !$usuario->getLogin() || !$usuario->getEmail() ||
            !$usuario->getTelefone() || !$usuario->getRole() || !$usuario->getSenha()
        ) {
            return ['erro' => 'Preencha todos os campos!'];
        }

        if (strlen($usuario->getSenha()) < 6) {
            return ['erro' => "Senha deve ter no minimo 6 caracteres!"];
        }

        $resultLogin = $this->usuarioRepository->TrackUserRepository("login", $usuario->getLogin());

        if ($resultLogin) {
            return ['erro' => "Login indisponivel!"];
        }

        $resultEmail = $this->usuarioRepository->TrackUserRepository("email", $usuario->getEmail());

        if ($resultEmail) {
            return ['erro' => "Email indisponivel!"];
        }


        $options = [
            "memory_cost" => 65000,
            "time_cost" => 3,
            "threads" => 2
        ];

        $senha_hash = password_hash($usuario->getSenha(), PASSWORD_ARGON2ID, $options);
        $usuario->setSenha($senha_hash);

        $id_usuario = $this->usuarioRepository->CreateUsuarioRepository($usuario);

        return [
            "sucesso" => "Usuario cadastrado com sucesso!",
            "id_usuario" => $id_usuario
        ];
    }

    public function UpdateUsuarioService(Usuarios $usuario)
    {
        if (
            !$usuario->getNome() || !$usuario->getLogin() || !$usuario->getEmail() ||
            !$usuario->getTelefone() || !$usuario->getRole() || !$usuario->getStatus()
        ) {
            return ['erro' => 'Preencha todos os campos!'];
        }

        $resultLogin = $this->usuarioRepository->TrackUserRepository("login", $usuario->getLogin());

        if ($resultLogin && $resultLogin['id'] != $usuario->getId()) {
            return ['erro' => "Login indisponivel!"];
        }

        $resultEmail = $this->usuarioRepository->TrackUserRepository("email", $usuario->getEmail());

        if ($resultEmail && $resultEmail['id'] != $usuario->getId()) {
            return ['erro' => "Email indisponivel!"];
        }

        $this->usuarioRepository->UpdateUsuarioRepository($usuario);

        return ["sucesso" => "Usuario atualizado com sucesso!"];
    }

    // VETERINARIOS
    public function CreateVeterinarioService(Usuarios $usuario, Veterinarios $veterinario)
    {
        try {
            $this->pdo->beginTransaction();

            // VALIDAÇÕES USUARIO
            if (
                !$usuario->getNome() || !$usuario->getLogin() || !$usuario->getEmail() ||
                !$usuario->getTelefone() || !$usuario->getRole() || !$usuario->getSenha() ||
                !$veterinario->getCrmv() || !$veterinario->getEspecialidade()
            ) {
                return ['erro' => 'Preencha todos os campos!'];
            }

            if (strlen($usuario->getSenha()) < 6) {
                return ['erro' => "Senha deve ter no minimo 6 caracteres!"];
            }

            $resultLogin = $this->usuarioRepository->TrackUserRepository("login", $usuario->getLogin());

            if ($resultLogin) {
                return ['erro' => "Login indisponivel!"];
            }

            $resultEmail = $this->usuarioRepository->TrackUserRepository("email", $usuario->getEmail());

            if ($resultEmail) {
                return ['erro' => "Email indisponivel!"];
            }


            $options = [
                "memory_cost" => 65000,
                "time_cost" => 3,
                "threads" => 2
            ];

            $senha_hash = password_hash($usuario->getSenha(), PASSWORD_ARGON2ID, $options);
            $usuario->setSenha($senha_hash);

            $crmv_vet = $this->usuarioRepository->TrackCrmvRepository($veterinario->getCrmv());

            if ($crmv_vet) {
                return ['erro' => "CRMV já cadastrado!!"];
            }

            $id_usuario = $this->usuarioRepository->CreateUsuarioRepository($usuario);
            $veterinario->setId_usuario($id_usuario);
            $this->usuarioRepository->CreateVeterinarioRepository($veterinario);

            $this->pdo->commit();

            return ["sucesso" => "Usuario cadastrado com sucesso!"];
        } catch (\Throwable $th) {
            $this->pdo->rollBack();
            return ['erro' => 'Erro ao cadastrar veterinário'];
        }
    }

    // CLIENTES
    public function CreateClienteService(Usuarios $usuario)
    {
        if (
            !$usuario->getNome() || !$usuario->getEmail() ||
            !$usuario->getTelefone() || !$usuario->getRole()
        ) {
            return ['erro' => 'Preencha todos os campos!'];
        }

        $resultEmail = $this->usuarioRepository->TrackUserRepository("email", $usuario->getEmail());

        if ($resultEmail) {
            return ['erro' => "Email indisponivel!"];
        }

        $this->usuarioRepository->CreateClienteRepository($usuario);

        return ["sucesso" => "Usuario cadastrado com sucesso!"];
    }

    public function UpdateClienteService(Usuarios $usuario)
    {
        if (
            !$usuario->getNome() || !$usuario->getEmail() ||
            !$usuario->getTelefone() || !$usuario->getRole()
        ) {
            return ['erro' => 'Preencha todos os campos!'];
        }

        $resultEmail = $this->usuarioRepository->TrackUserRepository("email", $usuario->getEmail());

        if ($resultEmail && $resultEmail['id'] != $usuario->getId()) {
            return ['erro' => "Email indisponivel!"];
        }

        $this->usuarioRepository->UpdateClienteRepository($usuario);

        return ["sucesso" => "Usuario atualizado com sucesso!"];
    }
}
