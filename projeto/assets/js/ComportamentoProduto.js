    function deleteProduct(iCodigo) {
        if (confirm('Deseja apagar o produto?')) {
            $.ajax({
                type: 'POST',
                url: '../../tabler/ModelProduto.php',
                data: {
                    acao: 'excluir',
                    codigo: iCodigo
                },
                success: (response) => {
                    if (response == 'sucesso') {
                        window.location.href= '../../tabler/projeto/produtos.php';
                    } else {
                        console.log(response);
                    }
                }
            });
        }
    }
