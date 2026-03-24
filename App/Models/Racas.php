<?php

namespace App\Models;

class Racas
{
    private int $id_raca;
    private string $nome_raca;
    private int $id_especie_fk;

    /**
     * Get the value of id_raca
     */
    public function getId_raca()
    {
        return $this->id_raca;
    }

    /**
     * Set the value of id_raca
     *
     * @return  self
     */
    public function setId_raca($id_raca)
    {
        $this->id_raca = $id_raca;

        return $this;
    }

    /**
     * Get the value of nome_raca
     */
    public function getNome_raca()
    {
        return $this->nome_raca;
    }

    /**
     * Set the value of nome_raca
     *
     * @return  self
     */
    public function setNome_raca($nome_raca)
    {
        $this->nome_raca = $nome_raca;

        return $this;
    }

    /**
     * Get the value of id_especie_fk
     */
    public function getId_especie_fk()
    {
        return $this->id_especie_fk;
    }

    /**
     * Set the value of id_especie_fk
     *
     * @return  self
     */
    public function setId_especie_fk($id_especie_fk)
    {
        $this->id_especie_fk = $id_especie_fk;

        return $this;
    }
}
