$(document).ready(function () {
    abrirModal();
    abrirExcluir();
})
function abrirModal() {
    $(".editarProduto").bind("click", function () {
        let id = $(this).data("idproduto");
        $.ajax({
            method: "POST",
            url: "gerenciarProdutos/pegaProdutoPorId",
            data: { dado: id },
            dataType: "json",

        }).done(function (resposta) {
            $("#modalEditarProdutos").modal()
            $("#idProduto").val(resposta.id_produto)
            $("#nomeProduto").val(resposta.nome_produto)
            $("#precoProduto").val(resposta.preco)
            $("#quantidadeProduto").val(resposta.quantidade_produto)
            $("#descricaoProduto").val(resposta.descricao_produto)
        }).fail(function (e) {
            console.log("erro")
        })
    })
}

$("#editarProduto").submit(function (e) {
    e.preventDefault()
    let dados = $(this).serialize();
    $.ajax({
        method: "POST",
        url: "gerenciarProdutos/editarProduto",
        data: dados
    }).done(function (resposta) {

        if (resposta == 0) {
            sucesso("Sucesso", "Produto atualizado com sucesso")
            atualizarTabela();
        } else if (resposta == 1) {
            erro("Ops...", "Ocorreu um erro ao atualizar o produto")
        } else if (resposta == 2) {
            erro("Ops..", "Verifique se todos os campos estão preenchidos")
        }


    })
})


$("#pesquisarProduto").keyup(function () {
    let dados = $(this).serialize();
    let html = ""
    $.ajax({
        method: "POST",
        url: "gerenciarProdutos/buscarNome",
        data: dados,
        dataType: "json"
    }).done(function (resposta) {
        for (e of resposta) {
            html += `<tr>
            <td>${e.id_produto}</td>
            <td>${e.nome_produto}</td>
            <td>${e.quantidade_produto}</td>
            <td>${e.preco}</td>
            <td>${e.descricao_produto}</td>
            <td><button data-idproduto="${e.id_produto}" class="btn editarProduto mt-2 mb-2 bg-violet text-white"><i class="fas fa-user-edit mr-2"></i>Editar</button> <button data-idproduto="${e.id_produto}" class="btn excluirProduto bg-red text-white"><i class="fas fa-trash-alt mr-2"></i>Deletar</button></td>
        </tr>`
            $("tbody").html(html)
            abrirModal();
            abrirExcluir();
        }
    })

})
function atualizarTabela() {
    let html;
    $.ajax({
        method: "POST",
        url: "gerenciarProdutos/atualizar",
        dataType: "json"
    }).done(function (resposta) {
        for (e of resposta) {
            html += `<tr>
            <td>${e.id_produto}</td>
            <td>${e.nome_produto}</td>
            <td>${e.quantidade_produto}</td>
            <td>${e.preco}</td>
            <td>${e.descricao_produto}</td>
            <td><button data-idproduto="${e.id_produto}" class="btn editarProduto mt-2 mb-2 bg-violet text-white"><i class="fas fa-user-edit mr-2"></i>Editar</button> <button data-idproduto="${e.id_produto}" class="btn excluirProduto bg-red text-white"><i class="fas fa-trash-alt mr-2"></i>Deletar</button></td>
        </tr>`
        }
        $("tbody").html(html)
        abrirModal()
        abrirExcluir()


    })
}
function abrirExcluir() {
    $(".excluirProduto").click(function (e) {
        let id = $(this).data("idproduto")
        excluirProduto(id);
    })
}
    function excluirProduto(dado) {
        Swal.fire({
            title: 'Tem certeza que deseja fazer isto?',
            text: "Você não irá conseguir reverter as alterações",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#008555',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: "gerenciarProdutos/deletar",
                    data: { id: dado }
                }).done(function (resposta) {
                    if (resposta == 0) {
                        sucesso("Sucesso", "Produto excluido com sucesso")
                    } else {
                        erro("Ops...", "Não foi possível deletar o cliente")
                    }
                    atualizarTabela()
                })
            }
        })
    }
