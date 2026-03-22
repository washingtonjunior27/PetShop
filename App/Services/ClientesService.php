<?php

namespace App\Services;

use App\Repositories\ClientesRepository;
use App\Repositories\FuncionariosRepository;
use App\Models\Usuarios;

class ClientesService
{
    private $clienteRepository;
    private $usuarioRepository;

    public function __construct()
    {
        $this->clienteRepository = new ClientesRepository();
        $this->usuarioRepository = new FuncionariosRepository();
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

        $this->clienteRepository->CreateClienteRepository($usuario);

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

        $this->clienteRepository->UpdateClienteRepository($usuario);

        return ["sucesso" => "Usuario atualizado com sucesso!"];
    }
}
