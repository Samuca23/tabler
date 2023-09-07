    /**
     *  Método para disparar Ajax para deletar um Produto
     * 
     * @param {int} iCodigo 
     */
    function deleteProduct(iCodigo) {
        if (confirm('Deseja apagar o produto?')) {
            $.ajax({
                type: 'POST',
                url: '../../tabler/Controller/controllerDelete.php?produto&delete&codigo=' + iCodigo,
                success: (response) => {
                    if (response) {
                        var bDeleteSucess = true;
                    }
                    window.location.href = '../../tabler/projeto/produtos.php';
                }
            });
        }
    }

    /**
     * Método para disparar Ajax para carregamento dos dados para Alterar o Produto
     */
    function alterProduct() {
        let url = new URL(window.location.href);
        let iCodigo = url.searchParams.get('codigo');

        $.ajax({
            url: '../../tabler/Controller/controllerAlter.php?produto&alter&codigo=' + iCodigo,
            type: 'POST',
            success: (response) => {
                if (response) {
                    var aDados = JSON.parse(response);
                    loadDataAlterProduct(aDados);
                }
            }
        });
    }

    /**
     * Método para setar os dados do Produto nos campos.
     * 
     * @param {array} aDados 
     */
    function loadDataAlterProduct(aDados) {
        let oCodigo = document.getElementsByClassName('produto-codigo');
        let oDescricao = document.getElementsByClassName('produto-descricao');
        let oEstoque = document.getElementsByClassName('produto-estoque');
        let oCodigoBarra = document.getElementsByClassName('produto-codigo-barra');
        let oValorUnidade = document.getElementsByClassName('produto-valor-unidade');

        if (oCodigo && oDescricao && oEstoque && oCodigoBarra && oValorUnidade) {
            oCodigo[0].value = aDados.produto_codigo;
            oDescricao[0].value = aDados.produto_descricao;
            oEstoque[0].value = aDados.produto_estoque;
            oCodigoBarra[0].value = aDados.produto_codigo_barra;
            oValorUnidade[0].value = aDados.produto_valor_unidade;
        }
    }