<?php

require_once "Factory.php";
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
                        tbproduto.provalorunidade    AS produto_valor_unidade
                   FROM tbproduto
                   ORDER BY tbproduto.prodescricao";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();

        return $aResultado;
    }

    public function getProductFromCod($iCodigo): array
    {
        $sSql = "SELECT tbproduto.procodigo          AS produto_codigo,
                        tbproduto.procodigobarra     AS produto_codigo_barra,
                        tbproduto.prodescricao       AS produto_descricao,
                        tbproduto.proestoque         AS produto_estoque,
                        tbproduto.provalorunidade    AS produto_valor_unidade
                   FROM tbproduto
                  WHERE tbproduto.procodigo = {$iCodigo}";
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
        $sSql = "SELECT COUNT(tbvenda.venvalortotal) AS venda_total
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
        $sSql = "SELECT COUNT(procodigo) AS total_produto
                   FROM tbproduto";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();
        $aValor = $aResultado[0];

        return $aValor['total_produto'];
    }

    public function getDateLasSaleProduct($iCodigo)
    {
        $sSql = "SELECT tbproduto.procodigo  AS produto_codigo,
                        DATE_FORMAT(MAX(tbvenda.vendata), '%d/%m/%Y') AS venda_data
                   FROM tbproduto
                   JOIN tbvenda
                     ON tbvenda.procodigo = tbproduto.procodigo
                  WHERE tbproduto.procodigo = {$iCodigo}
                   GROUP BY tbproduto.procodigo";
        $this->conexao->query($sSql);
        $aResultado = $this->conexao->getArrayResults();
        if ($aResultado) {
            $aValor = $aResultado[0];

            return $aValor['venda_data'];
        }

        return 'Sem vendas';
    }

    public function existsProduct($iCodigo)
    {
        $aProduto = $this->getProductFromCod($iCodigo);
        if ($aProduto[0]['produto_estoque'] > 0) {
            return true;
        }
        return false;
    }

    public function insertProduct($sDescricao, $iEstoque, $iCodigobarra, $iValorUnidade)
    {
        $sSql = "INSERT INTO tbproduto(prodescricao, proestoque, procodigobarra, provalorunidade) VALUES ('{$sDescricao}', {$iEstoque}, {$iCodigobarra}, {$iValorUnidade})";
        try {
            $this->conexao->query($sSql, true);
            header("Location: ../projeto/produtos.php");
        } catch (Exception) {
            echo "<h3>Não foi possível alterar esse registro, verifique as informações.</h3>";
        }
    }

    public function alterProduct($iCodigo, $sDescricao, $iEstoque, $iCodigobarra, $iValorUnidade)
    {
        $sSql = "UPDATE tbproduto 
                    SET prodescricao = '{$sDescricao}', proestoque = {$iEstoque}, procodigobarra = {$iCodigobarra}, provalorunidade = {$iValorUnidade} 
                  WHERE procodigo = {$iCodigo}";
        try {
            $this->conexao->query($sSql, true);
            header("Location: ../projeto/produtos.php");
        } catch (Exception) {
            echo "<h3>Não foi possível alterar esse registro, verifique as informações.</h3>";
        }
    }

    public function deleteProduct($iCodigo)
    {
        $sSql = "DELETE FROM tbproduto WHERE tbproduto.procodigo = {$iCodigo}";
        try {
            $this->conexao->query($sSql, true);
            echo true;
        } catch (Exception) {
            echo "Não foi possível deletar esse registro";
        }
    }
}
