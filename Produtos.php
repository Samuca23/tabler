<?php
require_once "Conexao.php";

class Produto {
    
    public $conexao;

    public function __construct()
    {
        $oConexao = new Conexao();
        $oConexao->setConexao();
        $this->conexao = $oConexao;
    }

    public function getAllProduto(): array
    {
        $sSql = "SELECT * FROM produto";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();

        return $aResultado;
    }

}