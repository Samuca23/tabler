<?php
require_once "Conexao.php";

class ControllerConexao {

    public $conexao;

    public function __construct()
    {
        $oConexao = new Conexao();
        $oConexao->setConexao();
        $this->conexao = $oConexao;
    }

}