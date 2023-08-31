<?php
/**
 *  Classe para os Produtos
 * 
 * @package Tabler
 * @author Samuel Chiodini 
 * @since 31/08/2023
 */
require_once "Conexao.php";

class Produto {
    
    public $conexao;

    public function __construct()
    {
        $oConexao = new Conexao();
        $oConexao->setConexao();
        $this->conexao = $oConexao;
    }

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

}