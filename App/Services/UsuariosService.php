<?php

namespace App\Services;

use App\Repositories\UsuariosRepository;
use App\Models\Usuarios;

class UsuariosService
{
    private $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuariosRepository();
    }

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

        $result = $this->usuarioRepository->TrackUserRepository("login", $usuario->getLogin());

        if ($result) {
            return ['erro' => "Login indisponivel!"];
        }

        $options = [
            "memory_cost" => 65000,
            "time_cost" => 3,
            "threads" => 2
        ];

        $senha_hash = password_hash($usuario->getSenha(), PASSWORD_ARGON2ID, $options);
        $usuario->setSenha($senha_hash);

        $this->usuarioRepository->CreateUsuarioRepository($usuario);

        return ["sucesso" => "Usuario cadastrado com sucesso!"];
    }
}
