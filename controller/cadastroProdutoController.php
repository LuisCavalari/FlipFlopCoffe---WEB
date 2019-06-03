<?php
class cadastroProdutoController extends Controller{
    private $produto;
    public function __construct() {
        $this->atendente = new Atendente();
        $this->cliente = new Cliente();
        $this->produto = new Produto();
    }
    
    public function index(){
        if(!empty($_SESSION['cLogin'])){
            $this->loadDashboard("cadastroProdutos", array("dados"=>$this->pegarDadosAtendente()));
        }else{
            header("Location:".BASE_URL);
        }
    }

    public function pegarDadosAtendente() {
        return $this->atendente->getDataById($_SESSION['cLogin']);
    }
    
    public function inserir(){
        if($this->verificarCampos()){
            $nomeProduto = addslashes($_POST['nomeProduto']);
            $quantidadeProduto = addslashes($_POST['quantidadeProduto']);
            $descricaoProduto = addslashes($_POST['descricaoProduto']);
            $precoProduto = addslashes($_POST['precoProduto']);
            $precoProduto = str_replace(",",".",$precoProduto);
            if($this->produto->inserirNovoProduto($nomeProduto,$quantidadeProduto,$descricaoProduto,$precoProduto)){
                echo 0;
            }else{
                echo 1;
            }
        }else{
            echo 2;
        }
    }
    public function verificarCampos(){
        return !empty($_POST['nomeProduto']) && !empty($_POST['precoProduto'])
        && !empty($_POST['descricaoProduto']) && !empty($_POST['quantidadeProduto']);
    }

}

?>