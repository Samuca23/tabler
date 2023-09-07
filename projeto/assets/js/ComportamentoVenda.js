function onChangeProduto() {
    let oSelect = document.getElementsByClassName('select-produto');
    let sValue = oSelect[0].options[oSelect[0].selectedIndex].value;
    if (sValue) {
        limpaCampos();
        getDadosProdutoFromAjax(sValue);
    }
}

function limpaCampos() {
    let oProdutoCodigo = document.getElementsByClassName('produto-codigo');
    let oValorUnidade = document.getElementsByClassName('valor-unidade');
    let oQuantidade = document.getElementsByClassName('quantidade');
    let oValorTotal = document.getElementsByClassName('valor-total');
    
    if (oProdutoCodigo && oQuantidade && oValorTotal) {
        oProdutoCodigo[0].value = '';
        oQuantidade[0].value = '';
        oValorTotal[0].value = '';
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
        }
    });
}

function setDadosProduto(aDados) {
    let oProdutoCodigo = document.getElementsByClassName('produto-codigo');
    let oValorUnidade = document.getElementsByClassName('valor-unidade');

    if (oProdutoCodigo && oValorUnidade) {
        oProdutoCodigo[0].value = aDados.produto_codigo;
        oValorUnidade[0].value = aDados.produto_valor_unidade;
    }
}

function onChangeQuantidade() {
    let oQuantidade = document.getElementsByClassName('quantidade');
    let oValorUnidade = document.getElementsByClassName('valor-unidade');

    if (oQuantidade && oValorUnidade) {
        let iQuantidade = parseInt(oQuantidade[0].value);
        let iValorUnidade = parseFloat(oValorUnidade[0].value);

        if (iQuantidade && iValorUnidade) {
            let iValorTotal = getValorTotalFromQuantidadeValor(iQuantidade, iValorUnidade);
            let oValorTotal = document.getElementsByClassName('valor-total');
            if (oValorTotal) {
                oValorTotal[0].value = iValorTotal;
            }
        }
    }
}

function getValorTotalFromQuantidadeValor(iQuantidade, iValorUnidade) {
    return iValorUnidade * iQuantidade;
}