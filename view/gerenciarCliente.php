<div class="container mt-4">
    <h3>Gerenciar clientes</h3>
    <hr>
    <div class="input-style col-12">
        <input type="text" placeholder="Pesquisar clientes..." class="input-field w-100" name="pesquisaCliente" id="pesquisarCliente">
        <i class="fas fa-search"></i>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table  table-striped ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome cliente</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) : ?>
                        <tr>
                            <td><?php echo $cliente['id_cliente'] ?></td>
                            <td><?php echo $cliente['nome_cliente'] ?></td>
                            <td><?php echo $cliente['cpf'] ?></td>
                            <td><?php echo $cliente['email_cliente'] ?></td>
                            <td><?php echo $cliente['telefone'] ?></td>
                            <td><button data-idcliente="<?php echo $cliente['id_cliente'] ?>" class="btn editarCliente bg-violet text-white"><i class="fas fa-user-edit mr-2"></i>Editar</button> <button data-idcliente="<?php echo $cliente['id_cliente'] ?>" class="btn excluirCliente bg-red text-white"><i class="fas fa-trash-alt mr-2"></i>Deletar</button></td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade " id="modalEditarCliente">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Editar cliente
                </div>
            </div>
            <div class="modal-body">
                <form id="editarCliente">
                    <div class="input-style">
                        <b style="font-size:26px;">#</b>
                        <input type="text" name="id" readonly id="idCliente" class="input-field">
                    </div>
                    <div class="input-style">
                        <i class="fas fa-user"></i>
                        <input type="text" class="input-field" name="nome" id="nomeCliente">
                    </div>
                    <div class="input-style">
                        <i class="fas fa-id-card"></i>
                        <input type="text" class="input-field" name="cpf" id="cpfCliente">
                    </div>
                    <div class="input-style">
                        <i class="fa fa-phone"></i>
                        <input type="text" class="input-field" name="telefone" id="telefoneCliente">
                    </div>
                    <div class="input-style">
                        <i class="fa fa-envelope"></i>
                        <input type="text" class="input-field" name="email" id="emailCliente">
                    </div>
                    <button type="submit" class="btn text-white bg-violet">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/gerenciarTabelaCliente.js"></script>