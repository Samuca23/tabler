    function deleteProduct(iCodigo) {
        if (confirm('Deseja apagar o produto?')) {
            $.ajax({
                type: 'POST',
                url: '../../tabler/Controller/controllerDelete.php?produto&delete&codigo=' + iCodigo,
                // url: '../../../Controller/controllerDelete.php?produto&delete&codigo=' + iCodigo,
                data: {
                    acao: 'excluir',
                    codigo: iCodigo
                },
                success: (response) => {
                    if (response) {
                        window.location.href= '../../tabler/projeto/produtos.php';
                        var bExclusaoSucess = true;
                    } else {
                        console.log(response);
                    }
                }
            });
        }
    }
