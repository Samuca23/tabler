<?php
require_once "produtos.php";

$oProduto = new Produto();

$aDados = $oProduto->getAllProduto();
foreach ($aDados as $oDado) {
    echo $oDado['procodigobarra'];
    echo $oDado['prodescricao'];
}