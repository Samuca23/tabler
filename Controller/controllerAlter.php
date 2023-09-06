<?php
require_once "../Factory.php";

switch ($_GET) {
    case isset($_GET['produto']) && isset($_GET['alter']) && isset($_GET['codigo']):
        loadDataProduct($_GET['codigo']);
        break;
    default:
        echo "Error";
}

function loadDataProduct($iCodigo)
{
    \Factory::requireModelProduto();
    $oModelProduto = new ModelProduto();
    $aProduto = $oModelProduto->getProductFromCod($iCodigo);

    echo json_encode($aProduto[0]);
} 
