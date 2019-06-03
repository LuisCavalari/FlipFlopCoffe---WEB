<div class="container mt-4">
    <h3 class="text-violet">Cadastrar produtos</h3>
    <hr>
    <form action="" id="cadastroProduto" class="form-group mt-5">
        <div class="form-row">
            <div class="input-style col-12">
                <i class="fas fa-boxes"></i>
                <input type="text" placeholder="Nome do produto" name="nomeProduto" class="input-field">
            </div>
        </div>
        <div class="form-row mt-2">
            <div class="input-style col-md-6">
                <i class="fas fa-money-bill-wave"></i>
                <input type="text" name="precoProduto" class="input-field money">
            </div>
            <div class="input-style col-md-6">
                <i class="fas fa-plus"></i>
                <input type="text" name="quantidadeProduto" placeholder="Quantidade do produto" pattern="^[1-9]{1}[0-9]*" class="input-field">
            </div>
        </div>
        <div class="form-row mt-4">
            <div class="input-style col-12">
                <textarea placeholder="Descrição do produto" name="descricaoProduto" id="" ></textarea>
            </div>
        </div>
        <div class="form-row mt-4">
            <div class="col-12">
                <button type="submit" class="btn btn-block bg-violet text-white">Cadastrar</button>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/cadastroProdutos.js"></script>