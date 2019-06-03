$('#login').submit(function(event) {
    event.preventDefault();
    
    let dados = $(this).serialize();
    $.ajax({
        url: "login/logar",
        method: "POST",
        data: dados

    }).done(function(reposta) {
        if (reposta == 0) {
            window.location.href = "home";
        } else if (reposta == 1) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Login ou senha incorretos'
            })
        }else if(reposta == 2){
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Preencha todos os campos'
            })
        }
    })
})