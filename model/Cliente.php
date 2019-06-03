<?php
 class Cliente extends Model{
    
    public function inserirNovoCliente($nome,$cpf,$email='',$telefone=''){
        $sql = "INSERT INTO Cliente(nome_cliente,cpf,email_cliente,telefone) values(:nome,:cpf,:email,:telefone)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome",$nome);
        $sql->bindValue(":cpf",$cpf);
        $sql->bindValue(":email",$email);
        $sql->bindValue(":telefone",$telefone);
        return $sql->execute();
    }public function verificarCpfExistente($cpf){
        $sql = "SELECT * FROM Cliente where cpf = :cpf ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":cpf",$cpf);
        $sql->execute();
        return $sql->rowCount() > 0 ? true:false;
    }
    public function listarTodosClientes(){
        $sql = "SELECT * FROM Cliente";
        $sql = $this->db->query($sql);
        return $sql->rowCount() > 0 ? $sql->fetchAll():[];
    }
    public function pegarClientePeloId($id){
        $sql = "SELECT * FROM Cliente WHERE id_cliente = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id",$id);
        $sql->execute();
        return $sql->rowCount() > 0 ? $sql->fetch():[];
    }
    public function atualizarCliente($id,$nome,$cpf,$email,$telefone){
        $sql = "UPDATE Cliente SET nome_cliente = :nome,cpf = :cpf,email_cliente = :email,
        telefone= :telefone WHERE id_cliente = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome",$nome);
        $sql->bindValue(":cpf",$cpf);
        $sql->bindValue(":email",$email);
        $sql->bindValue(":telefone",$telefone);
        $sql->bindValue(":id",$id);
        return $sql->execute();
    }
    public function pesquisaClientes($nome=''){
        $sql = "SELECT * FROM Cliente where nome_cliente like :nome";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome",$nome."%");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function deletarClientePeloId($id){
        $sql = "DELETE FROM Cliente where id_cliente = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id",$id);
        return $sql->execute();
    }

}
?>