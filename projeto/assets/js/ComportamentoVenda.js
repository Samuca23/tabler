    /**
     * Método disparado ao alterar o Produto do Select
     */
    function onChangeProduto() {
        let oSelect = document.getElementsByClassName('select-produto');
        let sValue = oSelect[0].options[oSelect[0].selectedIndex].value;

        if (sValue) {
            limpaCampos();
            getDadosProdutoFromAjax(sValue);
        }
    }

    /**
     * Método para limpar os campos
     */
    function limpaCampos() {
        let oProdutoCodigo = document.getElementsByClassName('produto-codigo');
        let oValorUnidade = document.getElementsByClassName('valor-unidade');
        let oQuantidade = document.getElementsByClassName('quantidade');
        let oValorTotal = document.getElementsByClassName('valor-total');

        if (oProdutoCodigo && oQuantidade && oValorTotal && oValorUnidade) {
            oProdutoCodigo[0].value = '';
            oQuantidade[0].value = '';
            oValorTotal[0].value = '';
            oValorUnidade[0].value = '';
        }
    }

    /**
     * Método para disparar Ajax para buscar os dados de um determinado Produto
     * 
     * @param {int} iCodigo 
     */
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

    /**
     * Método para setar os dados do Produto
     * 
     * @param {array} aDados 
     */
    function setDadosProduto(aDados) {
        let oProdutoCodigo = document.getElementsByClassName('produto-codigo');
        let oValorUnidade = document.getElementsByClassName('valor-unidade');

        if (oProdutoCodigo && oValorUnidade) {
            oProdutoCodigo[0].value = aDados.produto_codigo;
            oValorUnidade[0].value = aDados.produto_valor_unidade;
        }
    }

    /**
     * Método disparado ao mudar a quantidade do Produto.
     */
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

    /**
     * Método para realizar o cálculo Quantidade*Valor
     * 
     * @param {int} iQuantidade 
     * @param {int} iValorUnidade 
     * @returns 
     */
    function getValorTotalFromQuantidadeValor(iQuantidade, iValorUnidade) {
        return iValorUnidade * iQuantidade;
    }