<?php
class Atendente extends Model{
    public  function checkLogin($usuario,$pass){
        $sql = "SELECT * FROM Atendente where nome = :nome and senha = :senha";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome",$usuario);
        $sql->bindValue(":senha",$pass);
        $sql->execute();
        return $sql->rowCount() > 0 ? true:false;
    }public  function getDataByName($nome){
        $sql = "SELECT * FROM Atendente WHERE nome = :nome";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome",$nome);
        $sql->execute();
        if($sql->rowCount() > 0 ){
            return $sql->fetch();
        }
        return [];
    }public  function getDataById($id){
        $sql = "SELECT * FROM Atendente where id_atendente = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id",$id);
        $sql->execute();
        return $sql->rowCount() > 0 ? $sql->fetch():[];
    }
}
?>