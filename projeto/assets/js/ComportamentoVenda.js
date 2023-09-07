function onChangeProduto() {
    debugger;
    let oSelect = document.getElementsByClassName('select-produto');
    let sValue = oSelect[0].options[oSelect[0].selectedIndex].value;
    if (sValue) {
        getDadosProdutoFromAjax(sValue);
    }
}

function getDadosProdutoFromAjax(iCodigo) {
    $.ajax({
        type: 'GET',
        url: '../../tabler/Controller/controllerVenda.php?produto&codigo=' + iCodigo,
        success: (response) => {
            if (response) {
                setDadosProduto(JSON.parse(response));
            } 

            return false;
        }
    });
}

function setDadosProduto(aDados) {
    let oSelect = document.getElementsByClassName('select-produto');
    let oProdutoCodigo = document.getElementsByClassName('produto-codigo');
    let oValorUnidade = document.getElementsByClassName('valor-unidade');

    if (oProdutoCodigo && oValorUnidade) {
        oProdutoCodigo[0].value = aDados.produto_codigo;
        oValorUnidade[0].value = aDados.produto_valor_unidade;
    }
}