<?php
class Pedidos extends Model
{


    public function pegarQuantidadeDePedidosNoMes()
    {
        $sql = "SELECT *,day(data_pedido ) as dia FROM pedido where month(data_pedido) = month(now()) order by data_pedido asc";
        $sql = $this->db->query($sql);
        return  $sql->fetchAll();
    }
    public function inserirPedido($produtos, $pedido)
    {
        $produtoVenda = new Produto();
        try {
            $this->db->beginTransaction();
            $sql = "INSERT INTO pedido(id_cliente,id_atendente,valor_total,data_pedido) 
            VALUES (:idCliente,:idAtendente,:valorTotal,now())";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":idCliente", $pedido['idCliente']);
            $sql->bindValue(":idAtendente", $pedido['idAtendente']);
            $sql->bindValue(":valorTotal", $pedido['valorTotal']);
            $sql->execute();
            $idPedido = $this->db->lastInsertId();
            $produtoVenda->inserirItemsVendas($produtos, $idPedido);
            $this->db->commit();
        } catch (PDOException $pd) {
            $this->db->rollback();
            echo $pd->getMessage();
            return false;
        }
     
        return true;
    }
    public function listarTodosPedido(){
        $sql = "SELECT *
        FROM Cliente AS C 
        INNER JOIN pedido AS P ON C.id_cliente = P.id_cliente
        INNER JOIN Atendente as A ON A.id_atendente = P.id_atendente";
        $sql = $this->db->query($sql);
        return $sql->fetchAll();
    }
}
