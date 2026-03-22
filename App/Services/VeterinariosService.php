<?php

namespace App\Services;

use App\Config\Connection;
use App\Repositories\VeterinariosRepository;
use App\Repositories\FuncionariosRepository;
use App\Models\Usuarios;
use App\Models\Veterinarios;
use PDO;
use PDOException;

class VeterinariosService
{
    private $usuarioRepository;
    private $veterinarioRepository;
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getConn();
        $this->veterinarioRepository = new VeterinariosRepository();
        $this->usuarioRepository = new FuncionariosRepository();
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

            $crmv_vet = $this->veterinarioRepository->TrackCrmvRepository($veterinario->getCrmv());

            if ($crmv_vet) {
                return ['erro' => "CRMV já cadastrado!!"];
            }

            $id_usuario = $this->usuarioRepository->CreateUsuarioRepository($usuario);
            $veterinario->setId_usuario($id_usuario);
            $this->veterinarioRepository->CreateVeterinarioRepository($veterinario);

            $this->pdo->commit();

            return ["sucesso" => "Usuario cadastrado com sucesso!"];
        } catch (\Throwable $th) {
            $this->pdo->rollBack();
            return ['erro' => 'Erro ao cadastrar veterinário'];
        }
    }
}
