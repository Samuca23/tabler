<?php
require_once "Conexao.php";

class ControllerConexao {

    public $conexao;

    public function __construct()
    {
        $this->createConnection();
    }
    
    /**
     * Método utilizado para criar a coneção
     */
    private function createConnection() 
    {
        $oConexao = new Conexao();
        $oConexao->setConexao();
        $this->conexao = $oConexao;
    }

}