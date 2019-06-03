$("#cadastroProduto").submit(function(event){
    event.preventDefault();
    let dados = $(this).serialize();
    $.ajax({
        method:"POST",
        url:"cadastroProduto/inserir",
        data:dados
    }).done(function(resposta){
        if(resposta == 0)
            sucesso("Sucesso","Produto inserido com sucesso")
        else if(resposta ==1)
            erro("Ops...","Não foi possivel inserir o produto")
        else if(resposta == 2)
            erro("Ops...","Preencha todos os campos")
    })
})