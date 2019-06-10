<div class="container mt-4">
    <h3>Gerenciar produtos</h3>
    <hr>
    <div class="input-style col-12 w-100">
        <input type="text" placeholder="Pesquisar produtos..." class="input-field w-100" name="pesquisaProduto" id="pesquisarProduto">
        <i class="fas fa-search"></i>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table  table-striped ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome produto</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto) : ?>
                        <tr>
                            <td><?php echo $produto['id_produto'] ?></td>
                            <td><?php echo $produto['nome_produto'] ?></td>
                            <td><?php echo $produto['quantidade_produto'] ?></td>
                            <td><?php echo $produto['preco'] ?></td>
                            <td><?php echo $produto['descricao_produto'] ?></td>
                            <td><button data-idproduto="<?php echo $produto['id_produto'] ?>" class="btn editarProduto mt-2 mb-2 bg-violet text-white"><i class="fas fa-user-edit mr-2"></i>Editar</button> <button data-idproduto="<?php echo $produto['id_produto'] ?>" class="btn excluirProduto bg-red text-white"><i class="fas fa-trash-alt mr-2"></i>Deletar</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </div>
    </div>
</div>
<div class="modal fade " id="modalEditarProdutos">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Editar cliente
                </div>
            </div>
            <div class="modal-body">
                <form id="editarProduto">
                    <div class="input-style">
                        <b style="font-size:26px;">#</b>
                        <input type="text" name="idProduto" readonly id="idProduto" class="input-field">
                    </div>
                    <div class="input-style">
                        <i class="fas fa-pallet"></i>
                        <input type="text" class="input-field" name="nomeProduto" id="nomeProduto">
                    </div>
                    <div class="input-style">
                        <i class="fas fa-money-bill"></i>
                        <input type="text" class="input-field" name="precoProduto" id="precoProduto">
                    </div>
                    <div class="input-style">
                    <i class="fas fa-clipboard-list"></i>
                        <input type="text" class="input-field" name="quantidadeProduto" id="quantidadeProduto">
                    </div>
                    <div class="input-style">
                        <i class="fa fa-comments"></i>
                        <input type="text" class="input-field" name="descricaoProduto" id="descricaoProduto">
                    </div>
                    <button type="submit" class="btn text-white bg-violet">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/gerenciarProdutos.js"></script>