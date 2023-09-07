<?php
require_once "../Factory.php";

switch ($_GET) {
    case isset($_GET['produto']) && isset($_GET['codigo']):
        echo buscaDadosProduto($_GET['codigo']);
        break;
    default:
        echo 'Error';
        break;
}

function buscaDadosProduto($iCodigo) {
    Factory::requireModelProduto();
    $oModelProduto = new ModelProduto();
    $aProduto = $oModelProduto->getProductFromCod($iCodigo);

    return json_encode($aProduto[0]);
}