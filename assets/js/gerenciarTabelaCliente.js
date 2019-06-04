$(document).ready(() => {
    abrirModalEditar();
    excluirCliente();
})
function atualizarTabelaCliente() {
    let html;
    $.ajax({
        method: "POST",
        url: "gerenciarCliente/pegarTodosClientes",
        dataType: "json"
    }).done(function (resposta) {
        for (e of resposta) {
            html += `<tr>
                <th>${e.id_cliente}</th>
                <th>${e.nome_cliente}</th>
                <th>${e.cpf}</th>
                <th>${e.email_cliente}</th>
                <th>${e.telefone != null ? e.telefone : "Não cadastrado"}</th>
                <th><button data-idcliente="${e.id_cliente}" class="btn editarCliente bg-violet text-white"><i class="fas fa-user-edit mr-2"></i>Editar</button> <button data-idcliente="${e.id_cliente}" class="btn excluirCliente bg-red text-white"><i class="fas fa-trash-alt mr-2"></i>Deletar</button></th>
            </tr>`
        }
        $("tbody").html(html);
        abrirModalEditar();
        excluirCliente();
    })
}

$('#editarCliente').submit(function (event) {
    event.preventDefault();
    let dados = $(this).serialize();
    console.log(dados)
    $.ajax({
        method: "POST",
        url: "gerenciarCliente/editar",
        data: dados
    }).done(function (resposta) {
        if (resposta == 0) {
            sucesso("Sucesso", `Cliente atualizado`)
            atualizarTabelaCliente();
        }
    })
})
function abrirModalEditar() {
    $('.editarCliente').on("click", function (event) {
        let id = $(this).data("idcliente")
        $('#modalEditarCliente').find(".modal-body").html()
        let loading = `<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>`
        $.ajax({
            method: "POST",
            url: `gerenciarCliente/getCliente`,
            data: {
                dados: id
            },
            beforeSend: function () {
                $('#modalEditarCliente').find(".modal-body").find('form').addClass("d-none")
                $('#modalEditarCliente').find(".modal-body").append(`<div class="loaders">${loading}</div>`)
                $('#modalEditarCliente').modal()
            },
        }).done(function (resposta) {
            $('#modalEditarCliente').find(".modal-body").find(".loaders").html("")
            $('#modalEditarCliente').find(".modal-body").find('form').addClass("d-block")
            let dados = JSON.parse(resposta);
            $("#idCliente").val(id);
            $("#nomeCliente").val(dados.nome_cliente);
            $("#telefoneCliente").val(dados.telefone)
            $("#emailCliente").val(dados.email_cliente)
            $("#cpfCliente").val(dados.cpf);

        });
    });
}

$("#pesquisarCliente").keyup(function () {
    let dados = $(this).serialize();
    let html = ""
    $.ajax({
        method: "POST",
        url: "gerenciarCliente/buscarNome",
        data: dados,
        dataType: "json"
    }).done(function (resposta) {
        for (e of resposta) {
            html += `<tr>
            <td>${e.id_cliente}</td>
            <td>${e.nome_cliente}</td>
            <td>${e.cpf}</td>
            <td>${e.email_cliente}</td>
            <td>${e.telefone != null ? e.telefone : "Não cadastrado"}</td>
            <td><button data-idcliente="${e.id_cliente}" class="btn editarCliente bg-violet text-white"><i class="fas fa-user-edit mr-2"></i>Editar</button> <button data-idcliente="${e.id_cliente}" class="btn excluirCliente bg-red text-white"><i class="fas fa-trash-alt mr-2"></i>Deletar</button></td>
        </tr>`
            $("tbody").html(html)
            abrirModalEditar();
            excluirCliente();
        }
    })

})



function excluirCliente() {
    $(".excluirCliente").click(function () {
        let id = $(this).data("idcliente")
        deletarCliente(id);

    })
}

function deletarCliente(dado) {
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
                url: "gerenciarCliente/deletarCliente",
                data: { id: dado }
            }).done(function (resposta) {
                if (resposta == 0) {
                    sucesso("Sucesso", "Cliente excluido com sucesso")
                } else {
                    erro("Ops...", "Não foi possível deletar o cliente")
                }
                atualizarTabelaCliente();
            })
        }
    })
}


