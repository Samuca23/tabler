<?php
require_once "../Factory.php";
switch ($_GET) {
    case isset($_GET['produto']) && isset($_GET['alter']) && isset($_GET['codigo']):
        loadDataProduct($_GET['codigo']);
        break;
    case isset($_GET['produto']) && isset($_GET['alter']):
        alterProdutc();
        break;
    default:
        echo "Error";
}

function alterProdutc()
{
    if (isset($_POST['codigo']) && isset($_POST['descricao']) && isset($_POST['estoque']) && isset($_POST['codigo_barra']) && isset($_POST['valor_unidade'])) {
        if ($_POST['codigo'] && $_POST['descricao'] && $_POST['estoque'] && $_POST['codigo_barra'] && $_POST['valor_unidade']) {
            \Factory::requireModelProduto();
            $oModelProduto = new ModelProduto();
            $oModelProduto->alterProduct($_POST['codigo'], $_POST['descricao'], $_POST['estoque'], $_POST['codigo_barra'], $_POST['valor_unidade']);
        } else {
            echo "<h3>Não foi possível alterar esse registro, retorne e verifique as informações.</h3>";
        }
    }
}

function loadDataProduct($iCodigo)
{
    \Factory::requireModelProduto();
    $oModelProduto = new ModelProduto();
    $aProduto = $oModelProduto->getProductFromCod($iCodigo);

    echo json_encode($aProduto[0]);
}
