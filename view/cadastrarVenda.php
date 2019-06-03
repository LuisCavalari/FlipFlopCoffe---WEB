<div class="mt-4 container">
    <h3 class="text-violet ">Cadastrar Venda</h3>
    <hr>
    <div class="row mt-4">
        <div class="input-style col-md-7" id="add-produto">
            <select data-placeholder="Digite o nome do produto" style="width:auto" class="input-search" id="produtoQ">
                <option disabled selected>Insira o nome do produto</option>
                <?php foreach ($produtos as $produto) : ?>
                    <option value="<?php echo $produto['id_produto']; ?>">
                        <?php echo $produto['nome_produto'] . '- ID ' . $produto['id_produto']; ?>
                    </option>
                <?php endforeach; ?>

            </select>
            <i class=" ml-2 fas fa-plus"></i>
            <input type="text" style="width:auto" placeholder="Quantidade do produto" class="ml-2 input-field" name="quantidade" id="quantidadeProduto">
            <button class="btn ml-2 text-white bg-violet " id="addProduto">Adicionar</button>
        </div>

        <div class="input-style col-md-5">
            <select id="atendente" readonly class="input-search-atendente ml-4 w-100">
                <option selected value="<?php echo $dados['id_atendente']; ?>">
                    <?php echo $dados['nome'] . '- ID ' . $dados['id_atendente']; ?>
                </option>
            </select>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-7">
            <select name="" id="cliente" data-placeholder="Digite o nome do produto" class="input-search w-100">
                <option selected disabled>Inserir cliente</option>
                <?php foreach ($clientes as $cliente) : ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>">
                        <?php echo $cliente['nome_cliente'] . ' - ' . $cliente['cpf']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-5">
            <i class="fas fa-calendar"></i>
            <input type="text" readonly value="<?php echo date("d/m/Y"); ?>" name="" style="width:90%" class="input-field  date" id="date">
        </div>
    </div>
    <table class="table table-striped mt-1">
        <thead>
            <th>#</th>
            <th>Nome produto</th>
            <th>Preço unidade</th>
            <th>Quantidade</th>
            <th></th>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div class="col-md-12">
        <div class="input-style">
            <input type="text" name="valorTotal" readonly id="valorTotal" class="input-field">
            <button id="finalizarCompra" class="ml-2 w-100 btn text-white bg-success">Finalizar</button>
        </div>

    </div>
</div>

<script>
    let itemsVendas = {
        produtos: [],
        pedido: {
            valorTotal: 0,


        }

    };
    $(document).ready(function() {
        $('.input-search').select2({
            theme: "material",
            allowClear: true
        });

    });

    $(document).on('click', '.deletarProduto', function() {
        Swal.fire({
            title: 'Tem certeza que deseja fazer isto?',
            text: "Você não irá conseguir reverter as alterações",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#008555',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.value) {
                $(this).closest("tr").remove()
                let id = $(this).data("idproduto")
                deletarProdutoArray(id)
                atualizarValorTotal()
            }
        })



    })

    function deletarProdutoArray(id) {
        for (i in itemsVendas.produtos) {
            if (itemsVendas.produtos[i].idProduto == id) {
                itemsVendas.pedido.valorTotal -= (itemsVendas.produtos[i].quantidadeComprada * itemsVendas.produtos[i].precoUnidade)
                itemsVendas.produtos.splice(i, 1);
            }

        }
    }
    $(document).on('click', '#addProduto', function() {
        let id = $("#produtoQ").val();
        let qtd = $("#quantidadeProduto").val();
        $.ajax({
            method: "POST",
            url: "cadastrarVenda/inserirProduto",
            data: {
                idProduto: id,
                quantidade: qtd
            },
            dataType: "json"

        }).done(function(resposta) {
            if (resposta == 1) {
                erro("Ops...", "Quantidade requirida é maior que em estoque")
            } else {
                incluirProduto(resposta, qtd)
            }
        })
    });

    function incluirProduto(dados, quantidade) {

        if (!verificarProduto(dados.id_produto)) {
            atualizarProdutos(dados, quantidade)
            inserirProdutoTabela(dados, quantidade);
            atualizarValorTotal();
            limparCampos();

        } else {
            erro("Ops...", "Produto já está na lista")
        }

    }

    function limparCampos() {
        $("#quantidadeProduto").val('')
    }

    function atualizarProdutos(dados, quantidade) {
        itemsVendas.produtos.push({
            idProduto: dados.id_produto,
            quantidadeComprada: quantidade,
            precoUnidade: dados.preco
        })
        itemsVendas.pedido.valorTotal += (dados.preco * quantidade)
    }

    function inserirProdutoTabela(dados, quantidade) {
        $("tbody").append(`
        <tr>
            <td>${dados.id_produto}</td>
            <td>${dados.nome_produto}</td>
            <td> R$ ${dados.preco}</td>
            <td>${quantidade}</td>
            <td> <button data-idproduto=${dados.id_produto} class="btn deletarProduto bg-red"><i class="fa fa-times text-white"></i></button> </td>
        </tr>
        `);

    }

    function atualizarValorTotal() {
        $("#valorTotal").val(`Valor total: R$ ${itemsVendas.pedido.valorTotal}`)
    }

    function verificarProduto(id) {
        for (e of itemsVendas.produtos) {
            if (e.idProduto == id)
                return true;
        }
        return false;
    }
    $(document).on("click", "#finalizarCompra", finalizarCompra)

    function finalizarCompra() {
        let idCliente = $("#cliente").val();
        let idAtendente = $("#atendente").val()
        if (verificarCampos()) {
            itemsVendas.pedido.idCliente = idCliente;
            itemsVendas.pedido.idAtendente = idAtendente;
            $.ajax({
                method: "POST",
                url: "cadastrarVenda/inserirVendas",
                data: itemsVendas
            }).done((res) => {
                if (res == 0) {
                    sucesso("Sucesso", "Venda inserida com sucesso")
                    resetarItemsVendas();
                    $("#produtoQ option:selected").prop("selected",false);
                    $("#cliente option:selected").prop("selected",false);
                    $("tbody").html("");
                    atualizarValorTotal()
                }
            })
        }

    }

    function resetarItemsVendas() {
        itemsVendas = {
            produtos: [],
            pedido: {
                valorTotal: 0,


            }

        };
    }

    function verificarCampos() {
        let idCliente = $("#cliente").val();
        let idAtendente = $("#atendente").val()
        console.log(idAtendente)
        if (idCliente == null) {
            erro("Ops...", "O campo de cliente está vazio")
            return false;
        }
        if (idAtendente == null) {
            erro("Ops...", "O campo de atendente está vazio")
            return false;
        }
        if (itemsVendas.produtos.length < 1) {
            erro("Ops...", "A compra necessita de pelo menos 1 item")
            return false;
        }
        return true;
    }
</script>