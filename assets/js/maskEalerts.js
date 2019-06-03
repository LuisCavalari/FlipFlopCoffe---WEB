function sucesso(titulo, menssagem) {
    Swal.fire({
        type: "success",
        title: titulo,
        text: menssagem
    })
} function erro(titulo, menssagem) {
    Swal.fire({
        type: "error",
        title: titulo,
        text: menssagem
    })
}


$(".input-field").focus(function () {
    $(this).closest(".input-style").find("svg").addClass("active");
})
$(".input-field").focusout(function () {
    $(this).closest(".input-style").find("svg").removeClass("active");
})
$('.cpf').mask("000.000.000-00");
$('.telefone').mask("(00) #0000-0000 ")

$('.money').mask("#.##0,00",{reverse:true, placeholder:"Preço do produo: R$"})