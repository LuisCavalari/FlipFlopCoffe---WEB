<?php
class loginController extends Controller {
  private $atendente;
  public function __construct() {
    $this->atendente  = new Atendente();
  }
  public function index() {
    if(empty($_SESSION['cLogin']))
      $this->loadView("login", array());
    else 
      header("Location:".BASE_URL."home");
  
  }
  private function verificarLogin($user, $password) {
    return $this->atendente->checkLogin($user, $password);
  }
  private function pegarDadosAtendente($nome) {
    return $this->atendente->getDataByName($nome);
  }
  private function verificarCampos() {
    return !empty($_POST['email']) && !empty($_POST['senha']);
  }
  private function iniciarSessao($dados) {
    $_SESSION['cLogin'] = $dados['id_atendente'];
  }

  public function logar() {
    if ($this->verificarCampos()) {
      $usuario = addslashes($_POST['email']);
      $password = addslashes($_POST['senha']);
      if ($this->verificarLogin($usuario, $password)) {
        $dados = $this->pegarDadosAtendente($usuario);
        $this->iniciarSessao($dados);
        echo 0;
        exit;
      }else{
        echo 1;
      }
    } else {
      echo 2;
    }
   
  }
}
