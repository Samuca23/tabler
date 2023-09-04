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

function insertTrash($iCodigo)
{
    \Factory::requireModelLixo();
    $oModelLixo = getModelLixo();
    $oModelProduto = getModelProduto();
    $aDadoProduto = $oModelProduto->getProductFromCod($iCodigo);
    if ($aDadoProduto) {
        $oModelLixo->insertTrash($aDadoProduto);
    }
}

function deleteProduct($iCodigo)
{
    if ($iCodigo) {
        $oModelProduto = getModelProduto();
        $oModelProduto->deleteProduct($iCodigo);
    }
}

function getModelProduto()
{
    static $oModelProduto;
    if (!$oModelProduto) {
        \Factory::requireModelProduto();
        $oModelProduto = new ModelProduto();
    }

    return $oModelProduto;
}

function getModelLixo()
{
    static $oModelLixo;
    if (!$oModelLixo) {
        \Factory::requireModelLixo();
        $oModelLixo = new ModelLixo();
    }

    return $oModelLixo;
}
