<?php

namespace App\Controller;

use Src\Classes\ClassRender;
use App\Model\ClassPecas;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerPeca extends ClassRender implements InterfaceView
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
        $peca = new ClassPecas();
        $result = $peca->listarPecasCompleto();
        if (count($this->parseUrl()) == 1) {
            $this->setTitle("Painel Administrativo | Peças");
            $this->setDescription("Painel de Controle de Peças");
            $this->setKeywords("Controle de Peças");
            $this->setDir("peca");
            $this->setData($result);
            $this->renderLayout();

            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'create_success') {
                    echo '<script>toastr["success"]("Peça Cadastrado com Sucesso!");</script>';
                } else if ($_GET['msg'] == 'account_added') {
                    echo '<script>toastr["success"]("Dados bancários atualizados!");</script>';
                } else if ($_GET['msg'] == 'update_success') {
                    echo '<script>toastr["success"]("Dados cadastrais atualizados!");</script>';
                }
            }
        } else {
            $this->setDir("peca");
            $this->renderLayout();
        }
    }

    public function cadastro()
    {
        $peca = new ClassPecas();
        if (count($this->parseUrl()) == 2) {
            $this->setTitle("Painel Administrativo | Técnicos");
            $this->setDescription("Painel de Controle de Técnicos");
            $this->setKeywords("Controle de Técnicos");
            $this->setDir("form-peca");

            $this->renderLayout();
        }
        $this->setDir("peca");
        $this->renderLayout();
    }

    public function editar()
    {
        $peca = new ClassPecas();
        if (count($this->parseUrl()) == 2) {
            if (isset($_GET['id'])) {
                $dados = $this->detalhes($_GET['id']);
                $this->setData($dados);

                $this->setTitle("Painel Administrativo | Peças");
                $this->setDescription("Painel de Controle de Peças");
                $this->setKeywords("Controle de Peças");
                $this->setDir("form-peca-edit");
                $this->renderLayout();
            } else {
                $this->setDir("peca");
                $this->renderLayout();
            }
        }
        $this->setDir("peca");
        $this->renderLayout();
    }

    public function salvar()
    {
        $codigo = $_POST['codigo'];
        $descricao = $_POST['descricao'];
        $valor = doubleval($_POST['valor']);
        $quantidade = $_POST['quantidade'];

        $peca = new ClassPecas();
        $result = $peca->createPeca($codigo, $descricao, $valor, $quantidade);
        if ($result != null) {
            
            header('Location: ../peca?msg=create_success');
        }
    }

    public function atualizar()
    {
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $descricao = $_POST['descricao'];
        $valor = doubleval($_POST['valor']);
        $quantidade = $_POST['quantidade'];

        $peca = new ClassPecas();
        $result = $peca->updatePeca($id, $codigo, $descricao, $valor, $quantidade);
        if ($result != null) {
            header('Location: ../peca?msg=update_success');
        }
    }

    public function detalhes($id)
    {
        $peca = new ClassPecas();
        $rowPeca = $peca->readPeca($id);
        return $rowPeca;
    }

    public function visualizar($id){
        $peca = new ClassPecas();
        if (count($this->parseUrl()) == 3) {            
            $dados = $this->detalhes($id);
            $this->setData($dados);

            $this->setTitle("Painel Administrativo | Peças");
            $this->setDescription("Painel de Controle de Peças");
            $this->setKeywords("Controle de Peças");
            $this->setDir("view-peca");
            $this->renderLayout();
        } else {
            $this->setDir("peca");
            $this->renderLayout();
        }        
        $this->setDir("peca");
        $this->renderLayout();
    }
}
