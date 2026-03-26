<?php

namespace App\Models;

class Pets
{
    private int $id_pet;
    private string $nome_pet;
    private string $sexo_pet;
    private string $cor_pet;
    private string $peso_pet;
    private int $cliente_id_fk;
    private int $especie_id_fk;
    private int $raca_id_fk;

    /**
     * Get the value of id_pet
     */
    public function getId_pet()
    {
        return $this->id_pet;
    }

    /**
     * Set the value of id_pet
     *
     * @return  self
     */
    public function setId_pet($id_pet)
    {
        $this->id_pet = $id_pet;

        return $this;
    }

    /**
     * Get the value of nome_pet
     */
    public function getNome_pet()
    {
        return $this->nome_pet;
    }

    /**
     * Set the value of nome_pet
     *
     * @return  self
     */
    public function setNome_pet($nome_pet)
    {
        $this->nome_pet = $nome_pet;

        return $this;
    }

    /**
     * Get the value of sexo_pet
     */
    public function getSexo_pet()
    {
        return $this->sexo_pet;
    }

    /**
     * Set the value of sexo_pet
     *
     * @return  self
     */
    public function setSexo_pet($sexo_pet)
    {
        $this->sexo_pet = $sexo_pet;

        return $this;
    }

    /**
     * Get the value of cor_pet
     */
    public function getCor_pet()
    {
        return $this->cor_pet;
    }

    /**
     * Set the value of cor_pet
     *
     * @return  self
     */
    public function setCor_pet($cor_pet)
    {
        $this->cor_pet = $cor_pet;

        return $this;
    }

    /**
     * Get the value of peso_pet
     */
    public function getPeso_pet()
    {
        return $this->peso_pet;
    }

    /**
     * Set the value of peso_pet
     *
     * @return  self
     */
    public function setPeso_pet($peso_pet)
    {
        $this->peso_pet = $peso_pet;

        return $this;
    }

    /**
     * Get the value of cliente_id_fk
     */
    public function getCliente_id_fk()
    {
        return $this->cliente_id_fk;
    }

    /**
     * Set the value of cliente_id_fk
     *
     * @return  self
     */
    public function setCliente_id_fk($cliente_id_fk)
    {
        $this->cliente_id_fk = $cliente_id_fk;

        return $this;
    }

    /**
     * Get the value of especie_id_fk
     */
    public function getEspecie_id_fk()
    {
        return $this->especie_id_fk;
    }

    /**
     * Set the value of especie_id_fk
     *
     * @return  self
     */
    public function setEspecie_id_fk($especie_id_fk)
    {
        $this->especie_id_fk = $especie_id_fk;

        return $this;
    }

    /**
     * Get the value of raca_id_fk
     */
    public function getRaca_id_fk()
    {
        return $this->raca_id_fk;
    }

    /**
     * Set the value of raca_id_fk
     *
     * @return  self
     */
    public function setRaca_id_fk($raca_id_fk)
    {
        $this->raca_id_fk = $raca_id_fk;

        return $this;
    }
}
