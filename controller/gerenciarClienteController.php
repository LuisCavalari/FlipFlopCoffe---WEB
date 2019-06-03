<?php
class gerenciarClienteController extends Controller{
    public function __construct(){
        $this->atendente = new Atendente();
        $this->cliente = new Cliente();
    }
    public function index(){
        if(!empty($_SESSION['cLogin']))
            $this->loadDashboard("gerenciarCliente",array("dados"=>$this->pegarDadosAtendente(),
            "clientes"=>$this->pegarCliente()));
        else
            header("Location:".BASE_URL);

    }
    public function pegarCliente(){
       return $this->cliente->listarTodosClientes();
    }

    public function pegarDadosAtendente() {
        return $this->atendente->getDataById($_SESSION['cLogin']);
    }
    public function getCliente(){
        if(!empty($_POST['dados'])){
            $id = json_decode($_POST['dados']);
            $dadosCliente = $this->cliente->pegarClientePeloId($id);
            echo json_encode($dadosCliente);
        }
    }

    public function verificarCampos(){
        return !empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['email']);
    }

    public function editar(){
        if($this->verificarCampos()){
            $id = addslashes($_POST['id']);
            $nome = addslashes($_POST['nome']);
            $cpf = addslashes($_POST['cpf']);
            $email = addslashes($_POST['email']);
            $telefone = !empty($_POST['telefone']) ? addslashes($_POST['telefone']):'';
            if($this->cliente->atualizarCliente($id,$nome,$cpf,$email,$telefone)){
                echo 0;
            } else {
                echo 1;
            }
        }else{
            echo 2;
        }              
    }public function pegarTodosClientes(){
        $json = json_encode($this->cliente->listarTodosClientes());
        echo $json;
    }
    public function buscarNome(){
        $nome = $_POST['pesquisaCliente'];
        $json = $this->cliente->pesquisaClientes($nome);
        echo json_encode($json);
    }
    public function deletarCliente(){
        $id = addslashes($_POST['id']);
        if($this->cliente->deletarClientePeloId($id))
            echo 0;
        else   
            echo 1;
    }
    
}


?>