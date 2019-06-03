<?php
    class gerenciarProdutosController extends Controller{
        private $produto;
        public function __construct() {
            $this->atendente = new Atendente();
            $this->produto = new Produto();
        }
        
        public function index(){
            if(!empty($_SESSION['cLogin'])){
                $this->loadDashboard("gerenciarProdutos", array("dados"=>$this->pegarDadosAtendente(),
                "produtos"=>$this->listarTodosProdutos()));
            }else{
                header("Location:".BASE_URL);
            }
        }
        
        public function pegaProdutoPorId(){
            if(!empty($_POST['dado'])){
                $id = json_decode($_POST['dado']);
                echo json_encode($this->produto->pegarProdutoPorId($id));
            }
        }
    
        public function pegarDadosAtendente() {
            return $this->atendente->getDataById($_SESSION['cLogin']);
        }

        public function listarTodosProdutos(){
            return $this->produto->listarTodosProdutos();
        }
        public function atualizar(){
            echo json_encode($this->listarTodosProdutos());
        }
        public function editarProduto(){
            if($this->verificarCampos()){
                $id= addslashes($_POST['idProduto']);
                $nome = addslashes($_POST['nomeProduto']);
                $quantidade = addslashes($_POST['quantidadeProduto']);
                $preco = addslashes($_POST['precoProduto']);
                $preco = str_replace(",",".",$preco);
                $descricao = addslashes($_POST['descricaoProduto']);
                if($this->produto->editarProduto($id,$nome,$quantidade,$preco,$descricao)){
                    echo 0;
                }else{
                    echo 1;
                }
            }else{
                echo 2;
            }
        }

        public function verificarCampos(){
            return !empty($_POST['nomeProduto']) && !empty($_POST['idProduto'])
            && !empty($_POST['quantidadeProduto']) && !empty($_POST['precoProduto'])
            && !empty($_POST['descricaoProduto']);
        }
        public function buscarNome(){
                echo json_encode($this->produto->pesquisarProdutos($_POST['pesquisaProduto']));
        }
        public function deletar(){
            if(!empty($_POST['id'])){
                $id = json_decode($_POST['id']);
                if($this->produto->deletarProduto($id))
                    echo 0;
                else 
                    echo 1;
            }
        }

    }
