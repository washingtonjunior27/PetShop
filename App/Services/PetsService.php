<?php

namespace App\Services;

use App\Models\Pets;
use App\Repositories\PetsRepository;

class PetsService
{
    private $petsRepository;

    public function __construct()
    {
        $this->petsRepository = new PetsRepository();
    }

    public function CreatePetService(Pets $pet)
    {
        if (
            !$pet->getNome_pet() || !$pet->getCliente_id_fk() || !$pet->getEspecie_id_fk() ||
            !$pet->getRaca_id_fk() || !$pet->getSexo_pet() || !$pet->getCor_pet() || !$pet->getPeso_pet()
        ) {
            return ['erro' => "Prencha os campos vazios!"];
        }

        $this->petsRepository->CreatePetRepository($pet);

        return ['sucesso' => "Pet cadastrado com sucesso!"];
    }

    public function UpdatePetService(Pets $pet)
    {
        if (
            !$pet->getNome_pet() || !$pet->getCliente_id_fk() || !$pet->getEspecie_id_fk() ||
            !$pet->getRaca_id_fk() || !$pet->getSexo_pet() || !$pet->getCor_pet() || !$pet->getPeso_pet()
        ) {
            return ['erro' => "Prencha os campos vazios!"];
        }

        $this->petsRepository->UpdatePetRepository($pet);

        return ['sucesso' => "Pet atualizado com sucesso!"];
    }
}
