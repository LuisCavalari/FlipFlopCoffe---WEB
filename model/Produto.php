<?php
class Produto extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function inserirNovoProduto($nome, $quantidade, $descricao, $preco)
    {
        $sql = "INSERT INTO produtos(nome_produto,quantidade_produto
            , descricao_produto, preco) VALUES ('$nome','$quantidade','$descricao','$preco')";
        return $sql = $this->db->query($sql);
    }
    public function listarTodosProdutos()
    {
        $sql = "SELECT * FROM produtos";
        $sql = $this->db->query($sql);
        return $sql->fetchAll();
    }
    public function pegarProdutoPorId($id)
    {
        $sql = "SELECT * FROM produtos where id_produto = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->rowCount() > 0 ? $sql->fetch() : [0 => "null"];
    }
    public function editarProduto($id, $nome, $quantidade, $preco, $descricao)
    {
        $sql = "UPDATE produtos SET nome_produto = :nome, quantidade_produto = :quantidade
            , preco = :preco, descricao_produto = :descricao where id_produto = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":quantidade", $quantidade);
        $sql->bindValue(":preco", $preco);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":id", $id);
        return $sql->execute();
    }
    public function pesquisarProdutos($nome)
    {
        $sql = "SELECT * FROM produtos where nome_produto like :nome";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", $nome . "%");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function deletarProduto($id)
    {
        $sql = "DELETE FROM produtos where id_produto = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        return $sql->execute();
    }
    public function verificarEstoque($id, $quantidade)
    {
        $sql = "SELECT * FROM produtos where id_produto = :id and 
            quantidade_produto >= :quantidade";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":quantidade", $quantidade);
        $sql->execute();
        return $sql->rowCount() > 0 ? true : false;
    }
    public function inserirItemsVendas($produtos, $idPedido) {
        try {
            foreach ($produtos as $produto) {
                $sql = "INSERT INTO prod_ped(id_pedido,id_produto,quantidade)
                VALUES(:idPedido,:idProduto,:quantidade)";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":idPedido", $idPedido);
                $sql->bindValue(":idProduto", $produto['idProduto']);
                $sql->bindValue(":quantidade", $produto['quantidadeComprada']);
                $this->atualizarEstoque($produto);
                $sql->execute();
            }
     
        } catch (PDOException $pd) {
            echo $pd->getMessage();
        }
    }
    public function atualizarEstoque($produto){
        $sql = "UPDATE produtos set quantidade_produto = quantidade_produto - :quantidade 
        where id_produto = :idProduto";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":quantidade",$produto['quantidadeComprada']);
        $sql->bindValue(":idProduto",$produto['idProduto']);
        $sql->execute();
    }
}
