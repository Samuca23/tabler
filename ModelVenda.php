<?php

\Factory::requireModelPadrao();

/**
 * Classe de Vendas
 * 
 * @package Tabler
 * @author Samuel Chiodini 
 * @since 01/09/2023
 */
class ModelVenda extends \ModelPadrao
{

    public function getAllSale(): array
    {
        $sSql = "SELECT tbvenda.vencodigo         AS venda_codigo,
		                tbvenda.venquantidade     AS venda_quantidade,
                        tbvenda.venvalortotal     AS venda_valor_total,
                        tbvenda.vendata           AS venda_data,
                        tbvenda.procodigo         AS produto_codigo,
                        tbproduto.prodescricao    AS produto_descricao,
                        tbproduto.provalorunidade AS produto_valor_unidade
                   FROM tbvenda
                   JOIN tbproduto 
                     ON tbproduto.procodigo = tbvenda.procodigo";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();

        return $aResultado;
    }

    /**
     * Método responsável por retornar o total de vendas
     *
     * @return integer
     */
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
