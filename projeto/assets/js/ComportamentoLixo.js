    /**
     *  Método para disparar Ajax para o restaurar Produto do Lixo
     * 
     * @param {string} sDescricao 
     * @param {int} iValorUnidade 
     * @param {int} iEstoque 
     * @param {int} iCodigoBarra 
     * @param {int} iCodigoLixo 
     */
    function onClickRestauraProduto(sDescricao, iValorUnidade, iEstoque, iCodigoBarra, iCodigoLixo) {
        if (confirm('Deseja retaurar o produto?')) {
            $.ajax({
                type: 'POST',
                url: '../../tabler/Controller/controllerInsere.php?produto&restore',
                data: {
                    descricao: sDescricao,
                    estoque: iEstoque,
                    codigo_barra: iCodigoBarra,
                    valor_unidade: iValorUnidade,
                    lixo_codigo: iCodigoLixo
                },
                success: () => {
                    window.location.href = '../../tabler/projeto/produtos.php';
                }
            });
        }
    }