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

    /**
     * Método responsável por retornar todas as venas
     *
     * @return array
     */
    public function getAllSale(): array
    {
        $sSql = "SELECT tbvenda.vencodigo         AS venda_codigo,
		                tbvenda.venquantidade     AS venda_quantidade,
                        tbvenda.venvalortotal     AS venda_valor_total,
                        tbvenda.vendata           AS venda_data,
                        tbvenda.venvalorunidade   AS venda_valor_unidade,
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

    public function insertSale($iProdutoCodigo, $iQuantidade, $iValorTotal, $iValorUnidade, $bAtualizaValor)
    {
        \Factory::requireModelProduto();
        $oModelProduto = new ModelProduto();
        if ($oModelProduto->existsProduct($iProdutoCodigo)) {

            $sSql = "INSERT INTO tbvenda (venquantidade, venvalortotal, vendata, venvalorunidade, procodigo) VALUES ({$iQuantidade}, {$iValorTotal}, NOW(), {$iValorUnidade}, {$iProdutoCodigo})";

            try {
                $this->conexao->query($sSql);
                $this->updateEstoqueProduto($iProdutoCodigo, $iQuantidade);

                if ($bAtualizaValor) {
                    $this->updateValorProduto($iProdutoCodigo, $iValorUnidade);
                }

                header("Location: ../projeto/form-venda.php");
            } catch (Exception) {
                echo "<h3>Não foi possível realizar a venda, verifique as informações.</h3>";
            }
        } else {
            echo "<h3>Não foi possível realizar a venda, o estoque.</h3>";
        }
    }

    public function updateEstoqueProduto($iProdutoCodigo, $iQuantidade) {
        $sSql = "UPDATE tbproduto SET proestoque = proestoque - {$iQuantidade} WHERE procodigo = {$iProdutoCodigo}";
        try {
            $this->conexao->query($sSql);
        } catch (Exception) {
            echo "<h3>Não foi possível realizar a venda, verifique as informações.</h3>";
        }
    }
    
    public function updateValorProduto($iProdutoCodigo, $iValorUnidade) {
        $sSql = "UPDATE tbproduto SET provalorunidade = {$iValorUnidade} WHERE procodigo ={$iProdutoCodigo}";
        try {
            $this->conexao->query($sSql);
        } catch (Exception) {
            echo "<h3>Não foi possível realizar a venda, verifique as informações.</h3>";
        }
    }
}
