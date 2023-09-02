<?php

class Factory
{

    static public function getConnection()
    {
        require_once "Conexao.php";
        $oConexao = new Conexao();
        $oConexao->setConexao();

        return $oConexao;
    }

    /**
     * Método utilizado para o require do Model Padrão
     */
    static public function requireModelPadrao()
    {
        require_once "ModelPadrao.php";
    }

    /**
     * Método utilizado para fazer o require do Model de Produto
     */
    static public function requireModelProduto() 
    {
        require_once "ModelProduto.php";
    }

    /**
     * Método utilizado para fazer o require do Model de Venda
     */
    static public function requireModelVenda() 
    {
        require_once "ModelVenda.php";
    }

    /**
     * Método utilizado para fazer o require do Model de Lixo
     */
    static public function requireModelLixo()
    {
        require_once "ModelLixo.php";
    }

}