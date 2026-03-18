<?php

namespace App\Models;

class Veterinarios
{
    private int $id_veterinario;
    private string $crmv;
    private string $especialidade;
    private int $id_usuario;

    /**
     * Get the value of id_veterinario
     */
    public function getId_veterinario()
    {
        return $this->id_veterinario;
    }

    /**
     * Set the value of id_veterinario
     *
     * @return  self
     */
    public function setId_veterinario($id_veterinario)
    {
        $this->id_veterinario = $id_veterinario;

        return $this;
    }

    /**
     * Get the value of crmv
     */
    public function getCrmv()
    {
        return $this->crmv;
    }

    /**
     * Set the value of crmv
     *
     * @return  self
     */
    public function setCrmv($crmv)
    {
        $this->crmv = $crmv;

        return $this;
    }

    /**
     * Get the value of especialidade
     */
    public function getEspecialidade()
    {
        return $this->especialidade;
    }

    /**
     * Set the value of especialidade
     *
     * @return  self
     */
    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;

        return $this;
    }

    /**
     * Get the value of id_usuario
     */
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }
}
