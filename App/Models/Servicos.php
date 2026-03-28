<?php

namespace App\Models;

class Servicos
{
    private int $id_servico;
    private string $nome_servico;
    private string $preco_servico;
    private string $categoria_servico;
    private int $duracao_minutos;
    private string $descricao_servico;

    /**
     * Get the value of id_servico
     */
    public function getId_servico()
    {
        return $this->id_servico;
    }

    /**
     * Set the value of id_servico
     *
     * @return  self
     */
    public function setId_servico($id_servico)
    {
        $this->id_servico = $id_servico;

        return $this;
    }

    /**
     * Get the value of nome_servico
     */
    public function getNome_servico()
    {
        return $this->nome_servico;
    }

    /**
     * Set the value of nome_servico
     *
     * @return  self
     */
    public function setNome_servico($nome_servico)
    {
        $this->nome_servico = $nome_servico;

        return $this;
    }

    /**
     * Get the value of preco_servico
     */
    public function getPreco_servico()
    {
        return $this->preco_servico;
    }

    /**
     * Set the value of preco_servico
     *
     * @return  self
     */
    public function setPreco_servico($preco_servico)
    {
        $this->preco_servico = $preco_servico;

        return $this;
    }

    /**
     * Get the value of duracao_minutos
     */
    public function getDuracao_minutos()
    {
        return $this->duracao_minutos;
    }

    /**
     * Set the value of duracao_minutos
     *
     * @return  self
     */
    public function setDuracao_minutos($duracao_minutos)
    {
        $this->duracao_minutos = $duracao_minutos;

        return $this;
    }

    /**
     * Get the value of descricao_servico
     */
    public function getDescricao_servico()
    {
        return $this->descricao_servico;
    }

    /**
     * Set the value of descricao_servico
     *
     * @return  self
     */
    public function setDescricao_servico($descricao_servico)
    {
        $this->descricao_servico = $descricao_servico;

        return $this;
    }

    /**
     * Get the value of categoria_servico
     */
    public function getCategoria_servico()
    {
        return $this->categoria_servico;
    }

    /**
     * Set the value of categoria_servico
     *
     * @return  self
     */
    public function setCategoria_servico($categoria_servico)
    {
        $this->categoria_servico = $categoria_servico;

        return $this;
    }
}
