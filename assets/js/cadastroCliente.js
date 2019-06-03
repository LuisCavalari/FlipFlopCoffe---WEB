
$('#cadastro').submit(function (event) {
    event.preventDefault();
    let dados = $(this).serialize();
    console.log(dados)
    $.ajax({
        method: "POST",
        url: "cadastroCliente/inserir",
        data: dados
    }).done((resposta) => {
        if (resposta == 0)
            sucesso("Sucesso", "Usuário inserido com sucesso");
        else if (resposta == 1)
            erro("Ops..", "Não foi possivel enviar o cliente ao banco de dados");
        else if (resposta == 2)
            erro("Ops...", "O CPF informado já está em uso");
        else if (resposta == 3) {
            erro("Ops...", "Verifique se todos os campos estão preenchidos")
        }
    }).fail((error) => {
        erro("Ops..", "Não foi possivel inserir um novo cliente");
    })
})



