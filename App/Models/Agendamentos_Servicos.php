<?php

namespace App\Models;

class Agendamentos_Servicos
{
    private int $id_agend_serv;
    private string $orcamento;
    private string $executado;
    private int $id_agend_fk;
    private int $id_serv_fk;

    /**
     * Get the value of id_agend_serv
     */
    public function getId_agend_serv()
    {
        return $this->id_agend_serv;
    }

    /**
     * Set the value of id_agend_serv
     *
     * @return  self
     */
    public function setId_agend_serv($id_agend_serv)
    {
        $this->id_agend_serv = $id_agend_serv;

        return $this;
    }
    /**
     * Get the value of executado
     */
    public function getExecutado()
    {
        return $this->executado;
    }

    /**
     * Set the value of executado
     *
     * @return  self
     */
    public function setExecutado($executado)
    {
        $this->executado = $executado;

        return $this;
    }

    /**
     * Get the value of id_agend_fk
     */
    public function getId_agend_fk()
    {
        return $this->id_agend_fk;
    }

    /**
     * Set the value of id_agend_fk
     *
     * @return  self
     */
    public function setId_agend_fk($id_agend_fk)
    {
        $this->id_agend_fk = $id_agend_fk;

        return $this;
    }

    /**
     * Get the value of id_serv_fk
     */
    public function getId_serv_fk()
    {
        return $this->id_serv_fk;
    }

    /**
     * Set the value of id_serv_fk
     *
     * @return  self
     */
    public function setId_serv_fk($id_serv_fk)
    {
        $this->id_serv_fk = $id_serv_fk;

        return $this;
    }

    /**
     * Get the value of orcamento
     */
    public function getOrcamento()
    {
        return $this->orcamento;
    }

    /**
     * Set the value of orcamento
     *
     * @return  self
     */
    public function setOrcamento($orcamento)
    {
        $this->orcamento = $orcamento;

        return $this;
    }
}
