<?php
require_once("../Factory.php");

switch ($_GET) {
    case isset($_GET['produto']) && isset($_GET['delete']) && isset($_GET['codigo']):
        if (insertTrash($_GET['codigo'])) {
            deleteProduct($_GET['codigo']);
        }
        break;
    default:
        echo "Error";
}

/**
 * Método para controlar ao inserir um dado no Lixo
 *
 * @param [int] $iCodigo
 */
function insertTrash($iCodigo)
{
    \Factory::requireModelLixo();
    $oModelLixo = getModelLixo();
    $oModelProduto = getModelProduto();
    $aDadoProduto = $oModelProduto->getProductFromCod($iCodigo);
    if ($aDadoProduto) {
        return $oModelLixo->insertTrash($aDadoProduto);
    }
    return false; 
}

/**
 * Método para controlar a exclusão de um Produto
 *
 * @param [int] $iCodigo
 */
function deleteProduct($iCodigo)
{
    if ($iCodigo) {
        $oModelProduto = getModelProduto();
        $oModelProduto->deleteProduct($iCodigo);
    }
}

/**
 * Método para retornar o Modelo de Produto
 */
function getModelProduto()
{
    static $oModelProduto;
    if (!$oModelProduto) {
        \Factory::requireModelProduto();
        $oModelProduto = new ModelProduto();
    }

    return $oModelProduto;
}

/**
 * Método para retornar o Modelo de Lixo
 */
function getModelLixo()
{
    static $oModelLixo;
    if (!$oModelLixo) {
        \Factory::requireModelLixo();
        $oModelLixo = new ModelLixo();
    }

    return $oModelLixo;
}
