<?php

namespace App\Models;

class Vacinacao
{
    private int $id_vacinacao;
    private int $id_agend_vacinacao;
    private int $pet_id_vacinacao;
    private int $cliente_id_vacinacao;
    private int $veterinario_id_vacinacao;
    private int $id_vacina_servico;
    private string $created_at;
    private string $data_de_aplicação;
    private string $data_prox_dose; //Pode ser null
    private int $resolvido;

    /**
     * Get the value of id_vacinacao
     */
    public function getId_vacinacao()
    {
        return $this->id_vacinacao;
    }

    /**
     * Set the value of id_vacinacao
     *
     * @return  self
     */
    public function setId_vacinacao($id_vacinacao)
    {
        $this->id_vacinacao = $id_vacinacao;

        return $this;
    }

    /**
     * Get the value of pet_id_vacinacao
     */
    public function getPet_id_vacinacao()
    {
        return $this->pet_id_vacinacao;
    }

    /**
     * Set the value of pet_id_vacinacao
     *
     * @return  self
     */
    public function setPet_id_vacinacao($pet_id_vacinacao)
    {
        $this->pet_id_vacinacao = $pet_id_vacinacao;

        return $this;
    }

    /**
     * Get the value of cliente_id_vacinacao
     */
    public function getCliente_id_vacinacao()
    {
        return $this->cliente_id_vacinacao;
    }

    /**
     * Set the value of cliente_id_vacinacao
     *
     * @return  self
     */
    public function setCliente_id_vacinacao($cliente_id_vacinacao)
    {
        $this->cliente_id_vacinacao = $cliente_id_vacinacao;

        return $this;
    }

    /**
     * Get the value of veterinario_id_vacinacao
     */
    public function getVeterinario_id_vacinacao()
    {
        return $this->veterinario_id_vacinacao;
    }

    /**
     * Set the value of veterinario_id_vacinacao
     *
     * @return  self
     */
    public function setVeterinario_id_vacinacao($veterinario_id_vacinacao)
    {
        $this->veterinario_id_vacinacao = $veterinario_id_vacinacao;

        return $this;
    }

    /**
     * Get the value of data_de_aplicação
     */
    public function getData_de_aplicação()
    {
        return $this->data_de_aplicação;
    }

    /**
     * Set the value of data_de_aplicação
     *
     * @return  self
     */
    public function setData_de_aplicação($data_de_aplicação)
    {
        $this->data_de_aplicação = $data_de_aplicação;

        return $this;
    }

    /**
     * Get the value of data_prox_dose
     */
    public function getData_prox_dose()
    {
        return $this->data_prox_dose;
    }

    /**
     * Set the value of data_prox_dose
     *
     * @return  self
     */
    public function setData_prox_dose($data_prox_dose)
    {
        $this->data_prox_dose = $data_prox_dose;

        return $this;
    }

    /**
     * Get the value of resolvido
     */
    public function getResolvido()
    {
        return $this->resolvido;
    }

    /**
     * Set the value of resolvido
     *
     * @return  self
     */
    public function setResolvido($resolvido)
    {
        $this->resolvido = $resolvido;

        return $this;
    }

    /**
     * Get the value of id_vacina_servico
     */
    public function getId_vacina_servico()
    {
        return $this->id_vacina_servico;
    }

    /**
     * Set the value of id_vacina_servico
     *
     * @return  self
     */
    public function setId_vacina_servico($id_vacina_servico)
    {
        $this->id_vacina_servico = $id_vacina_servico;

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
     * Get the value of id_agend_vacinacao
     */
    public function getId_agend_vacinacao()
    {
        return $this->id_agend_vacinacao;
    }

    /**
     * Set the value of id_agend_vacinacao
     *
     * @return  self
     */
    public function setId_agend_vacinacao($id_agend_vacinacao)
    {
        $this->id_agend_vacinacao = $id_agend_vacinacao;

        return $this;
    }
}
