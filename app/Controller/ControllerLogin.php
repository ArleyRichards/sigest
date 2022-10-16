<?php
namespace App\Controller;

use Src\Classes\ClassRender;
use Src\Classes\ClassSecurity;
use App\Model\ClassLogin;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;


class ControllerLogin extends ClassRender implements InterfaceView{

    protected $login;
    protected $senha;
    protected $hash;
    public $msg = "bem vindo";

    use TraitUrlParser;

    public function __construct()
    {
        if(count($this->parseUrl())==1) {
            $Render=new ClassRender();
            $this->setTitle("Página de Login");
            $this->setDescription("APPBET - Sistema de Apostas");
            $this->setKeywords("appbet, apostas, sistema");
            $this->setDir("login");
            $this->setData($this->msg);
            $this->renderLayout();
        }
    }

    #Função responsável por recuperar os dados informados pelo usuário.
    private function recuperaVar()
    {
            if(isset($_POST['login'])){ $this->login = filter_input( INPUT_POST, 'login', FILTER_SANITIZE_STRING); }
            if(isset($_POST['senha'])){ $this->senha = filter_input( INPUT_POST, 'senha', FILTER_SANITIZE_STRING); }
    }

    public function autenticar()
    {
        $user = new ClassLogin();
        $this->recuperaVar();
        $dados = $user->selecionaUsuario($this->login, $this->senha);
        
        if ($dados == null) {          
            $result = '<small class="text-danger">Verifique seus dados</small>';
            header('Location:'.DIRPAGE.'login?msg=error');   
            $this->msg = "Erro";
        }else{
            if ($dados[0]['nivel'] == 'ADMIN'){
                ob_start();
                session_start();
                $_SESSION['id'] = $dados[0]['id'];
                $_SESSION['login'] = $dados[0]['login'];
                $_SESSION['nome'] = $dados[0]['nome'];
                $_SESSION['nivel'] = $dados[0]['nivel'];
                $_SESSION['fk_regioes'] = $dados[0]['fk_regioes'];
                header('Location:'.DIRPAGE.'dashboard');   
            }else if ($dados[0]['nivel'] == 'GERENTE'){
                ob_start();
                session_start();
                $_SESSION['id'] = $dados[0]['id'];
                $_SESSION['login'] = $dados[0]['login'];
                $_SESSION['nome'] = $dados[0]['nome'];
                $_SESSION['nivel'] = $dados[0]['nivel'];
                $_SESSION['fk_regioes'] = $dados[0]['fk_regioes'];
                header('Location:'.DIRPAGE.'painel');              
            }
        }
    }
 
}

?>