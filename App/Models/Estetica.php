<?php

namespace App\Models;

class Estetica
{
    private int $id_estetica;
    private string $observacao;
    private int $id_agend_fk;

    /**
     * Get the value of id_estetica
     */
    public function getId_estetica()
    {
        return $this->id_estetica;
    }

    /**
     * Set the value of id_estetica
     *
     * @return  self
     */
    public function setId_estetica($id_estetica)
    {
        $this->id_estetica = $id_estetica;

        return $this;
    }

    /**
     * Get the value of observacao
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set the value of observacao
     *
     * @return  self
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

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
}
