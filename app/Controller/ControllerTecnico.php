<?php

namespace App\Controller;

use Src\Classes\ClassRender;
use App\Model\ClassTecnico;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerTecnico extends ClassRender implements InterfaceView
{

    use TraitUrlParser;


    public function __construct()
    {
        session_start();
        if (count($this->parseUrl()) == 1) {
            if (isset($_SESSION['login'])) {
                $this->index();
            }
        }
    }

    public function index()
    {
        $tecnico = new ClassTecnico();
        $result = $tecnico->listarTecnicosAtivosCompleto();
        if (count($this->parseUrl()) == 1) {
            $this->setTitle("Painel Administrativo | Técnicos");
            $this->setDescription("Painel de Controle de Técnicos");
            $this->setKeywords("Controle de Técnicos");
            $this->setDir("tecnico");
            $this->setData($result);
            $this->renderLayout();

            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'create_success') {
                    echo '<script>toastr["success"]("Técnico Cadastrado com Sucesso!");</script>';
                } else if ($_GET['msg'] == 'account_added') {
                    echo '<script>toastr["success"]("Dados bancários atualizados!");</script>';
                } else if ($_GET['msg'] == 'update_success') {
                    echo '<script>toastr["success"]("Dados cadastrais atualizados!");</script>';
                }
                
            }
        } else {
            $this->setDir("tecnico");
            $this->renderLayout();
        }
    }

    public function cadastro()
    {
        $tecnico = new ClassTecnico();
        if (count($this->parseUrl()) == 2) {
            $this->setTitle("Painel Administrativo | Técnicos");
            $this->setDescription("Painel de Controle de Técnicos");
            $this->setKeywords("Controle de Técnicos");
            $this->setDir("form-tecnico");

            
            $this->renderLayout();
        }
        $this->setDir("tecnico");
        $this->renderLayout();
    }

    public function editar()
    {
        
        $tecnico = new ClassTecnico();
        if (count($this->parseUrl()) == 2) {
            if (isset($_GET['id'])) {
                $dados = $this->detalhes($_GET['id']);
                $this->setData($dados);

                $this->setTitle("Painel Administrativo | Técnicos");
                $this->setDescription("Painel de Controle de Técnicos");
                $this->setKeywords("Controle de Técnicos");
                $this->setDir("form-tecnico-edit");
                $this->renderLayout();
            } else {
                $this->setDir("tecnico");
                $this->renderLayout();
            }
        }
        $this->setDir("tecnico");
        $this->renderLayout();
    }

    public function salvar()
    {
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

        $tecnico = new ClassTecnico();
        $result = $tecnico->createTecnico($nome, $nascimento, $rg, $cpf, $telefone, $email, $cidade, $bairro, $logradouro, $uf, $cep);
        if ($result != null) {
            header('Location: ../tecnico?msg=create_success');
        }
    }    

    public function atualizar()
    {
        $id = $_POST['id'];
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

        $tecnico = new ClassTecnico();
        $result = $tecnico->updateTecnico($id, $nome, $nascimento, $rg, $cpf, $telefone, $email, $cidade, $bairro, $logradouro, $uf, $cep);
        if ($result != null) {
            header('Location: ../tecnico?msg=update_success');
            
        }
    }  

    public function detalhes($id)
    {
        $tecnico = new ClassTecnico();
        $rowTecnico = $tecnico->readTecnico($id);
        return $rowTecnico;
    }
}
