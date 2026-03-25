<?php

namespace App\Models;

class Vacinas
{
    private int $id_vacina;
    private string $nome_vacina;
    private string $preco_vacina;
    private int $duracao_retorno;
    private string $descricao_vacina;

    /**
     * Get the value of id_vacina
     */
    public function getId_vacina()
    {
        return $this->id_vacina;
    }

    /**
     * Set the value of id_vacina
     *
     * @return  self
     */
    public function setId_vacina($id_vacina)
    {
        $this->id_vacina = $id_vacina;

        return $this;
    }

    /**
     * Get the value of nome_vacina
     */
    public function getNome_vacina()
    {
        return $this->nome_vacina;
    }

    /**
     * Set the value of nome_vacina
     *
     * @return  self
     */
    public function setNome_vacina($nome_vacina)
    {
        $this->nome_vacina = $nome_vacina;

        return $this;
    }

    /**
     * Get the value of preco_vacina
     */
    public function getPreco_vacina()
    {
        return $this->preco_vacina;
    }

    /**
     * Set the value of preco_vacina
     *
     * @return  self
     */
    public function setPreco_vacina($preco_vacina)
    {
        $this->preco_vacina = $preco_vacina;

        return $this;
    }

    /**
     * Get the value of duracao_retorno
     */
    public function getDuracao_retorno()
    {
        return $this->duracao_retorno;
    }

    /**
     * Set the value of duracao_retorno
     *
     * @return  self
     */
    public function setDuracao_retorno($duracao_retorno)
    {
        $this->duracao_retorno = $duracao_retorno;

        return $this;
    }

    /**
     * Get the value of descricao_vacina
     */
    public function getDescricao_vacina()
    {
        return $this->descricao_vacina;
    }

    /**
     * Set the value of descricao_vacina
     *
     * @return  self
     */
    public function setDescricao_vacina($descricao_vacina)
    {
        $this->descricao_vacina = $descricao_vacina;

        return $this;
    }
}
