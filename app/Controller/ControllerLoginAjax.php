<?php

namespace App\Controller;

use App\Model\ClassLogin;
use Src\Traits\TraitUrlParser;

class ControllerLoginAjax extends ClassLogin
{

  use TraitUrlParser;

  public $id;
  public $nome;
  public $login;
  public $senha;
  public $fk_regiao;
  public $gerente;
  public $limite;
  public $varBusca;

  public function __construct()
  {
  }

  public function recuperarVar()
  {
    if (isset($_POST['id'])) {
      $this->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
    if (isset($_POST['login'])) {
      $this->login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['senha'])) {
      $this->senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    }
  }  

    
  public function redirect(){
    echo "<?php header('Location:'.DIRPAGE.'dashboard');  ?>";
  }

  public function autenticar(){
    $this->recuperarVar();
    $result = $this->selecionaUsuario($this->login, $this->senha);

    if($result == null){
      echo '<script>alert("ola")</script>';
    }else{
      return "Usuário encontrado";          
    }
  }
  
}
