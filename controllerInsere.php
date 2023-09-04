<?php
require_once("Factory.php");

if (isset($_GET['produto'])) {
    insertProduct();
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
