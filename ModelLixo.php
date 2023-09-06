<?php

require_once "Factory.php";
\Factory::requireModelPadrao();

class ModelLixo extends \ModelPadrao
{

    public function getAllTrash():array
    {
        $sSql = "SELECT tblixo.lixcodigo AS lixo_codigo,
                        tblixo.lixdata   AS lixo_data,
                        tblixo.lixdado   AS lixo_dado
                   FROM tblixo";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();

        foreach ($aResultado as $iKey => $oDado) {
            $aDadoDecode = json_decode($oDado['lixo_dado']);
            $aResultado[$iKey]['lixo_dado'] = $aDadoDecode;
        }

        return $aResultado;
    }

    public function insertTrash($aDados)
    {
        $sProduto = $this->TreatProductData($aDados[0]);
        $sSql = "INSERT INTO tblixo (lixdata, lixdado) VALUES (now(), '{$sProduto}')";
        if ($this->conexao->query($sSql, true)) {
            return true;
        }

        return false;
    }

    private function TreatProductData($aDado): string
    {
        return json_encode($aDado);
    }
}
