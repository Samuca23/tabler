<?php
require_once "Produtos.php";

$oProduto = new Produto();

$aDados = $oProduto->getAllProduct();
foreach ($aDados as $oDado) {
    echo $oDado['procodigobarra'];
    echo $oDado['prodescricao'];
}