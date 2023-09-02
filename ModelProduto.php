<?php

\Factory::requireModelPadrao();

/**
 *  Classe para os Produtos
 * 
 * @package Tabler
 * @author Samuel Chiodini 
 * @since 31/08/2023
 */
class ModelProduto extends \ModelPadrao
{

    /**
     * Método utilizado para retornar todos os produtos
     *
     * @return array
     */
    public function getAllProduct(): array
    {
        $sSql = "SELECT tbproduto.procodigo          AS produto_codigo,
                        tbproduto.procodigobarra     AS produto_codigo_barra,
                        tbproduto.prodescricao       AS produto_descricao,
                        tbproduto.proestoque         AS produto_estoque,
                        tbproduto.provalorunidade    AS produto_valor_unidade,
                        tbproduto.prodataultimavenda AS produto_data_utlima_venda
                   FROM tbproduto";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();

        return $aResultado;
    }

    /**
     * Método utilizado para retornar o valor total de vendas do produto
     *
     * @param [int] $iProduct
     * @return integer
     */
    public function getTotalSaleFromProduct($iProduct): int
    {
        $sSql = "SELECT SUM(tbvenda.venvalortotal) AS venda_total
                   FROM tbproduto
                   JOIN tbvenda 
                     ON tbvenda.procodigo = tbproduto.procodigo
                  WHERE tbproduto.procodigo = {$iProduct}";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();
        $aValor = $aResultado[0];
        if ($aValor['venda_total'] > 0) {
            return $aValor['venda_total'];
        }

        return 0;
    }

    /**
     * Método responsável por retornar a quantidade de produtos
     *
     * @return integer
     */
    public function getQuantityProduct(): int
    {
        $sSql = "SELECT COALESCE(MAX(procodigo), 0) AS total_produto
                   FROM tbproduto";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();
        $aValor = $aResultado[0];

        return $aValor['total_produto'];
    }
}
