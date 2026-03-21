<?php

namespace App\Models;

class Especies
{
    private int $id_especie;
    private string $nome_especie;

    /**
     * Get the value of id_especie
     */
    public function getId_especie()
    {
        return $this->id_especie;
    }

    /**
     * Set the value of id_especie
     *
     * @return  self
     */
    public function setId_especie($id_especie)
    {
        $this->id_especie = $id_especie;

        return $this;
    }

    /**
     * Get the value of nome_especie
     */
    public function getNome_especie()
    {
        return $this->nome_especie;
    }

    /**
     * Set the value of nome_especie
     *
     * @return  self
     */
    public function setNome_especie($nome_especie)
    {
        $this->nome_especie = $nome_especie;

        return $this;
    }
}
