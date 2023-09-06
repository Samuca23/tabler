    function deleteProduct(iCodigo) {
        if (confirm('Deseja apagar o produto?')) {
            $.ajax({
                type: 'POST',
                url: '../../tabler/Controller/controllerDelete.php?produto&delete&codigo=' + iCodigo,
                success: (response) => {
                    if (response) {
                        var bDeleteSucess = true;
                    } 
                    window.location.href= '../../tabler/projeto/produtos.php';
                }
            });
        }
    }

    function alterProduct(iCodigo) {
        if (confirm('Deseja alterar esse produto?')) {
            $.ajax({
                type:'POST',
                url: '../../tabler/Controller/controllerAlter.php?produto&alter&codigo=' + iCodigo,
                success: (response) => {
                    if (response) {
                        aDados = JSON.parse(response);
                        return aDados;
                    } 
                }
            });
        }
    }
    
    function loadDataAlterProduct() {
        let url = new URL (window.location.href);
        let iCodigo = url.searchParams.get('codigo');
        let aDados = alterProduct(iCodigo);

        let oCodigo = document.getElementsByClassName('produto-codigo');
        let oDescricao = document.getElementsByClassName('produto-descricao');
        let oEstoque = document.getElementsByClassName('produto-estoque');
        let oCodigoBarra = document.getElementsByClassName('produto-codigo-barra');
        let oValorUnidade = document.getElementsByClassName('produto-valor-unidade');
    }
