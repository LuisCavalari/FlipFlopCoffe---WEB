<?php
class homeController extends Controller {
    private $atendente;
    private $pedido;
    public function __construct() {
        $this->pedido = new Pedidos();
        $this->atendente = new Atendente();
    }

    
    public function index() {
        if (!empty($_SESSION['cLogin'])) {
            $dados = $this->pegarDados();
            $this->loadDashboard("home",array("dados"=>$dados));
        }else{
            header("Location:".BASE_URL."login");
        }
    }
    
    public function pegarDados(){
        return $this->atendente->getDataById($_SESSION['cLogin']);
    }
    
    public function sair(){
        unset($_SESSION['cLogin']);
        $this->index();
    }
    public function chart(){
        $dados = $this->pedido->pegarQuantidadeDePedidosNoMes();
        $dias = array();
        $valores = array();
        $diasDeUmMes = intval(date("t"));
        for($i = 1;$i<=$diasDeUmMes;$i++){
            $dias[] = $i;
            $valores[$i-1] = 0;
        }
        foreach($dados as $pedidos){
            $dia = $pedidos['dia'];
            $valores[$dia-1] = $valores[$dia-1] + 1;
        }
         echo json_encode(array("dias"=>$dias,"valores"=>$valores));
  
    }
}
