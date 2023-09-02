<?php
require_once "Factory.php";

class ModelPadrao
{

    public $conexao;

    public function __construct()
    {
        $this->createConnection();
    }

    /**
     * Método utilizado para criar a conexão
     */
    private function createConnection()
    {
        $this->conexao = Factory::getConnection();
    }
}
