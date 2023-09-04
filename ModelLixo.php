<?php

require_once "Factory.php";
\Factory::requireModelPadrao();

class ModelLixo extends \ModelPadrao
{

    public function insertTrash($aDados)
    {
        $sProduto = $this->TreatProductData($aDados[0]);
        $sSql = "INSERT INTO tblixo (lixdata, lixdado) VALUES (now(), {$sProduto})";
        if ($this->conexao->query($sSql, true)) {
            return true;
        }

        return false;
    }

    private function TreatProductData($aDado):string
    {
        return json_encode($aDado);
    }
}
