<?php
class CadastrarVendaController extends Controller
{
    private $produto;
    private $pedido;
    public function __construct()
    {
        $this->atendente = new Atendente();
        $this->cliente = new Cliente();
        $this->produto = new Produto();
        $this->pedido = new Pedidos();
    }

    public function index()
    {
        if (!empty($_SESSION['cLogin'])) {
            $this->loadDashboard("cadastrarVenda", array(
                "dados" => $this->pegarDadosAtendente(),
                "produtos" => $this->pegarTodosProdutos(), "clientes" => $this->pegarTodosClientes()
            ));
        } else {
            header("Location:" . BASE_URL);
        }
    }

    public function pegarDadosAtendente()
    {
        return $this->atendente->getDataById($_SESSION['cLogin']);
    }
    public function pegarTodosProdutos()
    {
        return $this->produto->listarTodosProdutos();
    }

    public function pegarTodosClientes()
    {
        return $this->cliente->listarTodosClientes();
    }
    public function inserirProduto()
    {
        if (!empty($_POST['idProduto']) && !empty($_POST['quantidade'])) {
            $id = json_decode($_POST['idProduto']);
            $quantidade = json_decode($_POST['quantidade']);
            if($this->produto->verificarEstoque($id,$quantidade)){
                echo json_encode($this->produto->pegarProdutoPorId($id));
            }else{
                echo 1;
            }
        }
       
    }
    public function inserirVendas(){
        if(!empty($_POST['produtos'] && !empty($_POST['pedido']))){
            $produtos =$_POST['produtos'];
            $pedido = $_POST['pedido'];
            if($this->pedido->inserirPedido($produtos,$pedido)){
                echo 0;
            }else{
                echo 1;
            }

        }       
    }
    public function gerarRelatorio(){    
        $this->loadReport("relatorioPedido",["pedidos"=>$this->pedido->listarTodosPedido()]);
    }
}
