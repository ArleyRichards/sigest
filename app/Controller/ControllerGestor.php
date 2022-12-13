<?php

namespace App\Controller;

use App\Model\ClassGestor;
use App\Model\ClassInstituicao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerGestor extends ClassRender implements InterfaceView
{

    use TraitUrlParser;
    public $msg = '';

    public function __construct()
    {
        ob_start();
        session_start();
        if (count($this->parseUrl()) == 1) {
            $this->index();
        }
    }

    public function index()
    {
        //session_start();
        if (isset($_SESSION['id'])) {
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'create_success') {
                    $this->msg = 'Instituição cadastrada com sucesso!';
                } else if ($_GET['msg'] == 'update_success') {
                    $this->msg = 'Dados atualizados com sucesso!';
                }
            }

            $gestor = new ClassGestor();
            
            $this->setTitle("Gestores");
            $this->setDescription("Painel Gestores");
            $this->setKeywords("dashboard, painel principal, sistema");
            $this->setDir("admin/gestor/index");
            $this->setData(['msg' => $this->msg, 'gestor' => $gestor->all()]);
            $this->renderLayout();
        } else {
            header('Location: login');
        }
    }

   
    public function cadastro()
    {
        //session_start();
        $this->msg = null;
        if (count($this->parseUrl()) == 2) {
            
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'error') {
                    $this->msg = 'Erro ao salvar os dados';
                } else if ($_GET['msg'] == 'incomplete_fields') {
                    $this->msg = 'Preencha todos os campos obrigatórios';
                }
            }
            
            $Instituicao = new ClassInstituicao();
            $rowInstituicao = $Instituicao->all();
            
            if (isset($_SESSION['id'])) {
                $this->setTitle("Gestores");
                $this->setDescription("Painel Gestores");
                $this->setKeywords("dashboard, painel principal, sistema");
                $this->setDir("admin/gestor/cadastro");
                $this->setData(['msg' => $this->msg, 'instituicoes' => $rowInstituicao]);
                $this->renderLayout();
            } else {
                header('Location: login');
            }
        }
    }
  

    public function detalhes($id)
    {
        //session_start();
        $this->msg = null;
        if ($id) {
            if (count($this->parseUrl()) == 3) {
                if (isset($_GET['msg'])) {
                    if ($_GET['msg'] == 'error') {
                        $this->msg = 'Erro ao salvar os dados';
                    } else if ($_GET['msg'] == 'incomplete_fields') {
                        $this->msg = 'Preencha todos os campos obrigatórios';
                    }
                }
                if (isset($_SESSION['id'])) {
                    $Gestor = new ClassGestor();
                    $rowGestor = $Gestor->read($id);
                    $rowInstituicao = $this->detalhesInstituicao($id);
                    $Render = new ClassRender();
                    $Render->setTitle("Gestores");
                    $Render->setDescription("Painel Instituições");
                    $Render->setKeywords("dashboard, painel principal, sistema");
                    $Render->setDir("admin/gestor/detalhes");
                    $Render->setData(['msg' => $this->msg, 'gestor' => $rowGestor, 'instituicao' => $rowInstituicao]);
                    $Render->renderLayout();
                } else {
                    header('Location: ' . DIRPAGE . '/login');
                }
            } else {

                $this->index();
            }
        } else {
            $this->index();
        }
    }

    public function edicao($id)
    {
        //session_start();
        $this->msg = null;
        if ($id) {
            if (count($this->parseUrl()) == 3) {
                if (isset($_GET['msg'])) {
                    if ($_GET['msg'] == 'error') {
                        $this->msg = 'Erro ao salvar os dados';
                    } else if ($_GET['msg'] == 'incomplete_fields') {
                        $this->msg = 'Preencha todos os campos obrigatórios';
                    }
                }
                if (isset($_SESSION['id'])) {
                    $Gestor = new ClassGestor();
                    $Instituicao = new ClassInstituicao();

                    $rowGestor = $Gestor->read($id);
                    $rowInstituicao = $Instituicao->all();
                    $readInstituicao = $Instituicao->read($rowGestor[0]['instituicao']);

                    $Render = new ClassRender();
                    $Render->setTitle("Gestores");
                    $Render->setDescription("Painel Gestores");
                    $Render->setKeywords("dashboard, painel principal, sistema");
                    $Render->setDir("admin/gestor/edicao");
                    $Render->setData(['msg' => $this->msg, 'gestor' => $rowGestor, 'instituicao' => $rowInstituicao, 'readInstituicao' => $readInstituicao]);
                    $Render->renderLayout();
                } else {
                    header('Location: ' . DIRPAGE . '/login');
                }
            } else {

                $this->index();
            }
        } else {
            $this->index();
        }
    }
    
    public function salvar()
    {
        if(isset($_POST)){
            
        }
    }   

    public function atualizar()
    {
        $Gestor = new ClassGestor();
        $id = $_POST['id'];

        if (isset($_POST)) {
            if (isset($_POST['nome']) && $_POST['nome'] != '') {
                $nome = $_POST['nome'];

                if (isset($_POST['email']) && $_POST['email'] != '') {
                    $email = $_POST['email'];

                    if (isset($_POST['instituicao']) && $_POST['instituicao'] != '') {
                        $instituicao = $_POST['instituicao'];

                        if (isset($_POST['nivel']) && $_POST['nivel'] != '') {
                            $nivel = $_POST['nivel'];

                            $result = $Gestor->update($id, $nome, $email, $instituicao, $nivel);

                            if ($result == null) {
                                header('Location:' . DIRPAGE . 'gestor/edicao?msg=error');
                            } else {
                                header('Location:' . DIRPAGE . 'gestor?msg=update_success');
                            }

                        } else {
                            header('Location:' . DIRPAGE . 'instituicao/cadastro?msg=incomplete_fields');
                        }
                    } else {
                        header('Location:' . DIRPAGE . 'instituicao/cadastro?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'instituicao/cadastro?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'instituicao/cadastro?msg=incomplete_fields');
            }
        }
    }
}
