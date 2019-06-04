<?php
class cadastroClienteController extends Controller {
    

    public function __construct() {
        $this->atendente = new Atendente();
        $this->cliente = new Cliente();
    }

    public function index() {
        if(!empty($_SESSION['cLogin'])){
            $this->loadDashboard("cadastrarCliente", array("dados"=>$this->pegarDadosAtendente()));
        }else{
            header("Location:".BASE_URL);
        }
    }
    
    public function pegarDadosAtendente() {
        return $this->atendente->getDataById($_SESSION['cLogin']);
    }
    
    public function verificarCampos(){
        return !empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['email']);
    }

    public function inserir(){
        if($this->verificarCampos()){
            $nome = addslashes($_POST['nome']);
            $cpf  = addslashes($_POST['cpf']);
            $email = addslashes($_POST['email']);
            $telefone = !empty($_POST['telefone']) ? $_POST['telefone']:'';   
            if(!$this->cliente->verificarCpfExistente($cpf)){
                if($this->cliente->inserirNovoCliente($nome,$cpf,$email,$telefone))
                    echo 0;
                else 
                    echo 1;
            }else{
                echo 2;
            }
        }else{
            echo 3;
        }
    }
}
