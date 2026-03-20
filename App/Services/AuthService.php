<?php

namespace App\Services;

use App\Repositories\UsuariosRepository;

class AuthService
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

        $result = $this->usuarioRepository->TrackUserRepository("login", $usuarioLogin);

        if (!$result) {
            return ['erro' => "Usuario não encontrado!"];
        }

        if (!password_verify($usuarioSenha, $result['senha'])) {
            return ['erro' => "Senha inválida!"];
        }

        if ($result['status'] != "Ativo") {
            return ['erro' => "Usuario está inativo!"];
        }

        if ($result['role'] == "Cliente") {
            return ['erro' => 'Usuário não encontrado!'];
        }

        return $result;
    }

    public function NovaSenhaService($senha, $confirmarSenha)
    {
        if (!$senha || !$confirmarSenha) {
            return ['erro' => 'Preencha os campos vazios!'];
        }

        if (strlen($senha) < 6 || strlen($confirmarSenha) < 6) {
            return ['erro' => 'Senha deve conter 6 caracteres!'];
        }

        if ($senha != $confirmarSenha) {
            return ['erro' => 'Senhas não coincidem!'];
        }

        $options = [
            "memory_cost" => 65000,
            "time_cost" => 3,
            "threads" => 2
        ];

        $senha_hash = password_hash($senha, PASSWORD_ARGON2ID, $options);
        $usuario_id = $_SESSION['user']['id'];

        $this->usuarioRepository->UpdatePrimeiroAcessoRepository($senha_hash, $usuario_id);

        return ['sucesso' => true];
    }
}
