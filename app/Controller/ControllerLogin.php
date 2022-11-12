<?php

namespace App\Controller;

use Src\Classes\ClassRender;
use Src\Classes\ClassSecurity;
use App\Model\ClassLogin;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;


class ControllerLogin extends ClassRender implements InterfaceView
{

    protected $email;
    protected $senha;
    protected $hash;
    public $msg = '';

    use TraitUrlParser;

    public function __construct()
    {

        if (count($this->parseUrl()) == 1) {
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'error') {
                    $this->msg = 'Usuário ou senha inválidos';
                }
            }
            $Render = new ClassRender();
            $this->setTitle("Página de Login");
            $this->setDescription("SIGEST - Sistema de Gestão Escolar");
            $this->setKeywords("sigest, gestão, escolar, sistema");
            $this->setDir("login");
            $this->setData(['msg' => $this->msg]);
            $this->renderLayout();
        }
    }

    #Função responsável por recuperar os dados informados pelo usuário.
    private function recuperaVar()
    {
        if (isset($_POST['email'])) {
            $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        }
        if (isset($_POST['senha'])) {
            $this->senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        }
    }

    public function autenticar()
    {
        $user = new ClassLogin();
        $this->recuperaVar();
        $dados = $user->selecionaUsuario($this->email, $this->senha);

        if ($dados == null) {
            $result = '<small class="text-danger">Verifique seus dados</small>';
            header('Location:' . DIRPAGE . 'login?msg=error');
            $this->msg = "Usuário ou Senha inválidos";
        } else {

            $nivel = $dados[0]['nivel'];
            if ($nivel == 'ADMIN') {
                ob_start();
                session_start();
                $_SESSION['id'] = $dados[0]['id'];
                $_SESSION['email'] = $dados[0]['email'];
                $_SESSION['nome'] = $dados[0]['nome'];
                header('Location:' . DIRPAGE . 'admin');
            }else{
                ob_start();
                session_start();
                $_SESSION['id'] = $dados[0]['id'];
                $_SESSION['email'] = $dados[0]['email'];
                $_SESSION['nome'] = $dados[0]['nome'];
                header('Location:' . DIRPAGE . 'dashboard');
            }
        }
    }
}
