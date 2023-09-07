function onClickRestauraProduto(sDescricao, iValorUnidade, iEstoque, iCodigoBarra, iCodigoLixo) {
    debugger;
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