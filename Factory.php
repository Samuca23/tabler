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

    static public function requireModelPadrao()
    {
        require_once "ModelPadrao.php";
    }

    static public function requireModelProduto() 
    {
        require_once "ModelProduto.php";
    }

    static public function requireModelVenda() 
    {
        require_once "ModelVenda.php";
    }

}
