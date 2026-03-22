<?php

namespace App\Services;

use App\Repositories\FuncionariosRepository;
use App\Models\Usuarios;

class FuncionariosService
{
    private $funcionarioRepository;

    public function __construct()
    {
        $this->funcionarioRepository = new FuncionariosRepository();
    }

    // FUNCIONARIOS
    public function CreateFuncionarioService(Usuarios $usuario)
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

        $resultLogin = $this->funcionarioRepository->TrackUserRepository("login", $usuario->getLogin());

        if ($resultLogin) {
            return ['erro' => "Login indisponivel!"];
        }

        $resultEmail = $this->funcionarioRepository->TrackUserRepository("email", $usuario->getEmail());

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

        $id_usuario = $this->funcionarioRepository->CreateUsuarioRepository($usuario);

        return [
            "sucesso" => "Usuario cadastrado com sucesso!",
            "id_usuario" => $id_usuario
        ];
    }

    public function UpdateFuncionarioService(Usuarios $usuario)
    {
        if (
            !$usuario->getNome() || !$usuario->getLogin() || !$usuario->getEmail() ||
            !$usuario->getTelefone() || !$usuario->getRole() || !$usuario->getStatus()
        ) {
            return ['erro' => 'Preencha todos os campos!'];
        }

        $resultLogin = $this->funcionarioRepository->TrackUserRepository("login", $usuario->getLogin());

        if ($resultLogin && $resultLogin['id'] != $usuario->getId()) {
            return ['erro' => "Login indisponivel!"];
        }

        $resultEmail = $this->funcionarioRepository->TrackUserRepository("email", $usuario->getEmail());

        if ($resultEmail && $resultEmail['id'] != $usuario->getId()) {
            return ['erro' => "Email indisponivel!"];
        }

        $this->funcionarioRepository->UpdateUsuarioRepository($usuario);

        return ["sucesso" => "Usuario atualizado com sucesso!"];
    }
}
