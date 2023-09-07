<?php
require_once("../Factory.php");

switch ($_GET) {
    case isset($_GET['produto']) && isset($_GET['insert']):
        insertProduct();
        break;
    case isset($_GET['venda']):
        insertSale();
        break;
    default:
        echo "Error";
}

function insertProduct()
{
    if (isset($_POST['descricao']) && isset($_POST['estoque']) && isset($_POST['codigo_barra']) && isset($_POST['valor_unidade'])) {
        if ($_POST['descricao'] && $_POST['estoque'] && $_POST['codigo_barra'] && $_POST['valor_unidade']) {
            \Factory::requireModelProduto();
            $oModelProduto = new ModelProduto();
            $oModelProduto->insertProduct($_POST['descricao'], $_POST['estoque'], $_POST['codigo_barra'], $_POST['valor_unidade']);
        } else {
            echo "<h3>Não foi possível inserir esse registro, retorne e verifique as informações.</h3>";
        }
    }
}

function insertSale() {
    if (isset($_POST['produto_codigo']) && isset($_POST['quantidade']) && isset($_POST['valor_total']) && isset($_POST['valor_unidade'])) {
        \Factory::requireModelVenda();
        $oModelVenda = new ModelVenda();
        $bAtualizaValor = false;
        if (isset($_POST['atualiza_valor'])) {
            $bAtualizaValor = true;
        }
        $oModelVenda->insertSale($_POST['produto_codigo'], $_POST['quantidade'], $_POST['valor_total'], $_POST['valor_unidade'], $bAtualizaValor);
    } else {
        var_dump($_POST);
        echo "<h3>Não foi possível realizar a venda, retorne e verifique as informações.</h3>";
    }
}
