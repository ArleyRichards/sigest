<?php

namespace App\Controller;

use App\Model\ClassGerente;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerGerente extends ClassRender implements InterfaceView
{

    use TraitUrlParser;


    public function __construct()
    {
        session_start();
        if (count($this->parseUrl()) == 1) {
            if(isset($_SESSION['login'])){
                $this->index();
            }
        }
    }

    public function index(){        
        $tecnico = new ClassGerente();
        $result = $tecnico->listarGerentesAtivosCompleto();
        if (count($this->parseUrl()) == 1) {
            $this->setTitle("Painel Administrativo | Gerentes");
            $this->setDescription("Painel de Controle de Gerentes");
            $this->setKeywords("Controle de Gerentes");
            $this->setDir("gerente"); 
            $this->setData($result);
            $this->renderLayout();

            if(isset($_GET['msg'])){
                if($_GET['msg'] == 'create_success'){
                    echo '<script>toastr["success"]("Gerente Cadastrado com Sucesso!");</script>';
                }else if($_GET['msg'] == 'account_added'){
                    echo '<script>toastr["success"]("Dados bancários atualizados!");</script>';
                }
            }
        }else{  
            $this->setDir("gerente");            
            $this->renderLayout();          
        }
    }

    public function cadastro()
    {
        $tecnico = new ClassGerente();
        if (count($this->parseUrl()) == 2) {
            $this->setTitle("Painel Administrativo | Técnicos");
            $this->setDescription("Painel de Controle de Técnicos");
            $this->setKeywords("Controle de Técnicos");
            $this->setDir("form-gerente");

            //$Render->setDados($dados);
            $this->renderLayout();
        }
        $this->setDir("gerente");
        $this->renderLayout();
    }

    public function salvar(){
        $nome = $_POST['nome'];
        $nascimento = $_POST['nascimento'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $logradouro = $_POST['logradouro'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];

        $tecnico = new ClassGerente();
        /*$result = $tecnico->createTecnico($nome, $nascimento, $rg, $cpf, $telefone, $email, $cidade, $bairro, $logradouro, $uf, $cep);
        if($result != null){
            header('Location: ../tecnico?msg=create_success');
        }*/

    }

    public function detalhes($id)
    {
        echo '<pre>';
        var_dump($id);
    }
}
