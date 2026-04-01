<?php

namespace App\Models;

class Agendamentos
{
    private int $id_agend;
    private string $data_agend;
    private string $hora_agend_inicio;
    private string $hora_agend_fim;
    private string $data_criacao_agend;
    private string $status_agend;
    private string $descricao_agend;
    private int $cliente_id_agend;
    private int $pet_id_agend;
    private int $responsavel_id_agend;

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
     * Get the value of data_agend
     */
    public function getData_agend()
    {
        return $this->data_agend;
    }

    /**
     * Set the value of data_agend
     *
     * @return  self
     */
    public function setData_agend($data_agend)
    {
        $this->data_agend = $data_agend;

        return $this;
    }

    /**
     * Get the value of hora_agend_inicio
     */
    public function getHora_agend_inicio()
    {
        return $this->hora_agend_inicio;
    }

    /**
     * Set the value of hora_agend_inicio
     *
     * @return  self
     */
    public function setHora_agend_inicio($hora_agend_inicio)
    {
        $this->hora_agend_inicio = $hora_agend_inicio;

        return $this;
    }

    /**
     * Get the value of hora_agend_fim
     */
    public function getHora_agend_fim()
    {
        return $this->hora_agend_fim;
    }

    /**
     * Set the value of hora_agend_fim
     *
     * @return  self
     */
    public function setHora_agend_fim($hora_agend_fim)
    {
        $this->hora_agend_fim = $hora_agend_fim;

        return $this;
    }

    /**
     * Get the value of data_criacao_agend
     */
    public function getData_criacao_agend()
    {
        return $this->data_criacao_agend;
    }

    /**
     * Set the value of data_criacao_agend
     *
     * @return  self
     */
    public function setData_criacao_agend($data_criacao_agend)
    {
        $this->data_criacao_agend = $data_criacao_agend;

        return $this;
    }

    /**
     * Get the value of status_agend
     */
    public function getStatus_agend()
    {
        return $this->status_agend;
    }

    /**
     * Set the value of status_agend
     *
     * @return  self
     */
    public function setStatus_agend($status_agend)
    {
        $this->status_agend = $status_agend;

        return $this;
    }

    /**
     * Get the value of descricao_agend
     */
    public function getDescricao_agend()
    {
        return $this->descricao_agend;
    }

    /**
     * Set the value of descricao_agend
     *
     * @return  self
     */
    public function setDescricao_agend($descricao_agend)
    {
        $this->descricao_agend = $descricao_agend;

        return $this;
    }

    /**
     * Get the value of cliente_id_agend
     */
    public function getCliente_id_agend()
    {
        return $this->cliente_id_agend;
    }

    /**
     * Set the value of cliente_id_agend
     *
     * @return  self
     */
    public function setCliente_id_agend($cliente_id_agend)
    {
        $this->cliente_id_agend = $cliente_id_agend;

        return $this;
    }

    /**
     * Get the value of pet_id_agend
     */
    public function getPet_id_agend()
    {
        return $this->pet_id_agend;
    }

    /**
     * Set the value of pet_id_agend
     *
     * @return  self
     */
    public function setPet_id_agend($pet_id_agend)
    {
        $this->pet_id_agend = $pet_id_agend;

        return $this;
    }

    /**
     * Get the value of responsavel_id_agend
     */
    public function getResponsavel_id_agend()
    {
        return $this->responsavel_id_agend;
    }

    /**
     * Set the value of responsavel_id_agend
     *
     * @return  self
     */
    public function setResponsavel_id_agend($responsavel_id_agend)
    {
        $this->responsavel_id_agend = $responsavel_id_agend;

        return $this;
    }
}
