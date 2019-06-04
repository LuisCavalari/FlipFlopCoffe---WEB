<div class="container mt-4">
    <h3>Cadastro cliente</h3>
    <hr>
    <form id="cadastro" class="mt-4">
        <div class="form-row">
            <div class="col-md-6 input-style">
                <i class="fa fa-user"></i>
                <input type="text" name="nome" placeholder="Nome do cliente..." class="input-field" id="">
            </div>
            <div class="col-md-6 input-style">
                <i class="fas fa-mobile-alt"></i>
                <input type="text" placeholder="Telefone" name="telefone" class="input-field telefone">
            </div>
        </div>
        <div class="form-row input-style mt-2">
            <div class="col-12 input-style">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" placeholder="Email" id="" class="input-field">
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 input-style">
                <i class="fas fa-id-card"></i>
                <input type="text" placeholder="CPF" name="cpf" class="cpf input-field" id="">
            </div>
        </div>
        <div class="form-row mt-4">
            <div class="col-12">
                <button type="submit" class="btn btn-block bg-violet text-white">Cadastrar</button>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/cadastroCliente.js"></script>