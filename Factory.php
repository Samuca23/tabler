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
        require_once "Model/ModelPadrao.php";
    }

    /**
     * Método utilizado para fazer o require do Model de Produto
     */
    static public function requireModelProduto()
    {
        require_once "Model/ModelProduto.php";
    }

    /**
     * Método utilizado para fazer o require do Model de Venda
     */
    static public function requireModelVenda()
    {
        require_once "Model/ModelVenda.php";
    }

    /**
     * Método utilizado para fazer o require do Model de Lixo
     */
    static public function requireModelLixo()
    {
        require_once "Model/ModelLixo.php";
    }

    static public function requireControllerInsere()
    {
        require_once("Controller/controllerInsere.php");
    }
}
