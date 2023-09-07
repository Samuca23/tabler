<?php

\Factory::requireModelPadrao();

class ModelLixo extends \ModelPadrao
{

    /**
     * Método para retornar todos os dados do lixo
     *
     * @return array
     */
    public function getAllTrash(): array
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

    /**
     * Método para inserir um dado no lixo
     *
     * @param [array] $aDados
     * @return boolean
     */
    public function insertTrash($aDados): bool
    {
        $sProduto = $this->TreatProductData($aDados[0]);
        $sSql = "INSERT INTO tblixo (lixdata, lixdado) VALUES (now(), '{$sProduto}')";
        if ($this->conexao->query($sSql, true)) {
            return true;
        }

        return false;
    }

    /**
     * Método para tratar os dados do produto
     *
     * @param [array] $aDado
     * @return string
     */
    private function TreatProductData($aDado): string
    {
        return json_encode($aDado);
    }

    /**
     * Método para deletar dado do Lixo
     *
     * @param [int] $iLixoCodigo
     */
    public function deleteTrash($iLixoCodigo) {
        $sSql = "DELETE FROM tblixo WHERE tblixo.lixcodigo = {$iLixoCodigo}";
        $this->conexao->query($sSql);
    }
}
