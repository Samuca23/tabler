<?php

namespace Vendas;

use ControllerConexao;

require_once "ControllerConexao.php";

/**
 * Classe de Vendas
 * 
 * @package Tabler
 * @author Samuel Chiodini 
 * @since 01/09/2023
 */
class Vendas extends ControllerConexao
{

    public function getQuantitySale(): int
    {
        $sSql = "SELECT COALESCE(MAX(vencodigo), 0) AS total_venda
                   FROM tbvenda";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();
        $aValor = $aResultado[0];

        return $aValor['total_venda'];
    }
}
