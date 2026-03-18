<?php

namespace App\Services;

use App\Repositories\UsuariosRepository;

class UsuariosService
{
    private $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuariosRepository();
    }

    public function LoginService($usuarioLogin, $usuarioSenha)
    {
        if (!$usuarioLogin || !$usuarioSenha) {
            return ['erro' => 'Preencha os campos vazios!'];
        }

        $result = $this->usuarioRepository->TrackUserController("login", $usuarioLogin);

        if (!$result) {
            return ['erro' => "Usuario não encontrado!"];
        }

        if (!password_verify($usuarioSenha, $result['senha'])) {
            return ['erro' => "Senha inválida!"];
        }

        if ($result['status'] != "Ativo") {
            return ['erro' => "Usuario está inativo!"];
        }

        return $result;
    }
}
