<?php

namespace App\Services;

use App\Models\Servicos;
use App\Repositories\ServicosRepository;

class ServicosService
{
    private $servicosRepository;

    public function __construct()
    {
        $this->servicosRepository = new ServicosRepository();
    }

    public function CreateServicoService(Servicos $servico)
    {
        if (
            !$servico->getNome_servico() || !$servico->getPreco_servico()
            || !$servico->getDuracao_minutos()
        ) {
            return ['erro' => "Preencha os campos vazios!"];
        }

        if ($servico->getDuracao_minutos() <= 0) {
            return ['erro' => "Duração invalida!"];
        }

        if (!is_numeric($servico->getPreco_servico())) {
            return ['erro' => 'Preço inválido'];
        }

        if ($servico->getPreco_servico() <= 0) {
            return ['erro' => "Preço inválido!"];
        }

        $result = $this->servicosRepository->TrackServicoRepository($servico->getNome_servico());

        if ($result) {
            return ['erro' => "Serviço já cadastrado!"];
        }

        $this->servicosRepository->CreateServicoRepository($servico);

        return ['sucesso' => "Serviço cadastrado com sucesso!"];
    }

    public function UpdateServicosService(Servicos $servico)
    {
        if (
            !$servico->getNome_servico() || !$servico->getPreco_servico()
            || !$servico->getDuracao_minutos()
        ) {
            return ['erro' => "Preencha os campos vazios!"];
        }

        if ($servico->getDuracao_minutos() <= 0) {
            return ['erro' => "Duração invalida!"];
        }

        if (!is_numeric($servico->getPreco_servico())) {
            return ['erro' => 'Preço inválido'];
        }

        if ($servico->getPreco_servico() <= 0) {
            return ['erro' => "Preço inválido!"];
        }

        $result = $this->servicosRepository->TrackServicoRepository($servico->getNome_servico());

        if ($result && $result['id_servico'] != $servico->getId_servico()) {
            return ['erro' => "Serviço já cadastrado!"];
        }

        $this->servicosRepository->UpdateServicoRepository($servico);

        return ['sucesso' => "Serviço atualizado com sucesso!"];
    }
}
