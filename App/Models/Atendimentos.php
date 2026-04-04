<?php

namespace App\Models;

class Atendimentos
{
    private int $id_atendimento;
    private string $anamnese;
    private string $diagnostico;
    private string $tratamento;
    private string $created_at;
    private int $id_agend;
    private int $pet_id;
    private int $cliente_id;
    private int $veterinario_id;

    /**
     * Get the value of id_atendimento
     */
    public function getId_atendimento()
    {
        return $this->id_atendimento;
    }

    /**
     * Set the value of id_atendimento
     *
     * @return  self
     */
    public function setId_atendimento($id_atendimento)
    {
        $this->id_atendimento = $id_atendimento;

        return $this;
    }

    /**
     * Get the value of anamnese
     */
    public function getAnamnese()
    {
        return $this->anamnese;
    }

    /**
     * Set the value of anamnese
     *
     * @return  self
     */
    public function setAnamnese($anamnese)
    {
        $this->anamnese = $anamnese;

        return $this;
    }

    /**
     * Get the value of diagnostico
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

    /**
     * Set the value of diagnostico
     *
     * @return  self
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    /**
     * Get the value of tratamento
     */
    public function getTratamento()
    {
        return $this->tratamento;
    }

    /**
     * Set the value of tratamento
     *
     * @return  self
     */
    public function setTratamento($tratamento)
    {
        $this->tratamento = $tratamento;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of id_agend
     */
    public function getId_agend()
    {
        return $this->id_agend;
    }

    /**
     * Set the value of id_agend
     *
     * @return  self
     */
    public function setId_agend($id_agend)
    {
        $this->id_agend = $id_agend;

        return $this;
    }

    /**
     * Get the value of pet_id
     */
    public function getPet_id()
    {
        return $this->pet_id;
    }

    /**
     * Set the value of pet_id
     *
     * @return  self
     */
    public function setPet_id($pet_id)
    {
        $this->pet_id = $pet_id;

        return $this;
    }

    /**
     * Get the value of cliente_id
     */
    public function getCliente_id()
    {
        return $this->cliente_id;
    }

    /**
     * Set the value of cliente_id
     *
     * @return  self
     */
    public function setCliente_id($cliente_id)
    {
        $this->cliente_id = $cliente_id;

        return $this;
    }

    /**
     * Get the value of veterinario_id
     */
    public function getVeterinario_id()
    {
        return $this->veterinario_id;
    }

    /**
     * Set the value of veterinario_id
     *
     * @return  self
     */
    public function setVeterinario_id($veterinario_id)
    {
        $this->veterinario_id = $veterinario_id;

        return $this;
    }
}
