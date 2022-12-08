<?php

namespace App\Controller;

use App\Model\ClassCurso;
use App\Model\ClassInstituicao;
use App\Model\ClassTurma;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerCurso extends ClassRender implements InterfaceView {

    use TraitUrlParser;

    public $msg = '';

    public function __construct() {
        ob_start();
        session_start();
        if (count($this->parseUrl()) == 1) {
            $this->index();
        }
    }

    public function index() {
        //session_start();
        if (isset($_SESSION['id'])) {
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'create_success') {
                    $this->msg = 'Curso cadastrado com sucesso!';
                } else if ($_GET['msg'] == 'update_success') {
                    $this->msg = 'Dados atualizados com sucesso!';
                }
            }

            $Curso = new ClassCurso();
            $Instituicao = $_SESSION['id_instituicao'];

            $this->setTitle("Cursos");
            $this->setDescription("Painel Cursos");
            $this->setKeywords("dashboard, painel principal, sistema");
            $this->setDir("gestor/curso/index");
            $this->setData(['msg' => $this->msg, 'curso' => $Curso->all($Instituicao)]);
            $this->renderLayout();
        } else {
            header('Location: login');
        }
    }

    public function cadastro() {
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
            if (isset($_SESSION['id'])) {
                $Render = new ClassRender();
                $Render->setTitle("Cursos");
                $Render->setDescription("Painel Cursos");
                $Render->setKeywords("dashboard, painel principal, sistema");
                $Render->setDir("gestor/curso/cadastro");
                $Render->setData(['msg' => $this->msg]);
                $Render->renderLayout();
            } else {
                header('Location: login');
            }
        }
    }

    public function detalhes($id) {
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
                    $Curso = new ClassCurso();
                    $Turma = new ClassTurma();
                    $Instituicao = new ClassInstituicao();

                    $rowCurso = $Curso->read($id);           
                    $rowTurma = $Turma->selectByCurso($id);
                    $rowInstituicao = $Instituicao->read($rowCurso[0]['id_instituicao']);

                    $this->setTitle("Cursos");
                    $this->setDescription("Painel Cursos");
                    $this->setKeywords("dashboard, painel principal, sistema");
                    $this->setDir("gestor/curso/detalhes");
                    $this->setData(['msg' => $this->msg, 'curso' => $rowCurso, 'turma' => $rowTurma, 'instituicao' => $rowInstituicao]);
                    $this->renderLayout();
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

    public function edicao($id) {        
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
                    $Curso = new ClassCurso();
                    $rowCurso = $Curso->read($id);
                    $this->setTitle("Cursos");
                    $this->setDescription("Painel Cursos");
                    $this->setKeywords("dashboard, painel principal, sistema");
                    $this->setDir("gestor/curso/edicao");
                    $this->setData(['msg' => $this->msg, 'curso' => $rowCurso]);
                    $this->renderLayout();
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

    public function salvar() {
        $Curso = new ClassCurso();        

        if (isset($_POST)) {
            $instituicao = $_POST['id_instituicao'];
            $descricao = $_POST['descricao'];
            
            if (isset($_POST['nome']) && $_POST['nome'] != '') {
                $nome = $_POST['nome'];

                if (isset($_POST['nivel']) && $_POST['nivel'] != '') {
                    $nivel = $_POST['nivel'];

                    if (isset($_POST['ch']) && $_POST['ch'] != '') {
                        $ch = $_POST['ch'];

                        $result = $Curso->create($nome, $nivel, $ch, $descricao, $instituicao);

                        if ($result == null) {
                            header('Location:' . DIRPAGE . 'curso/cadastro?msg=error');
                        } else {
                            header('Location:' . DIRPAGE . 'curso?msg=create_success');
                        }
                        
                    } else {
                        header('Location:' . DIRPAGE . 'curso/cadastro?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'curso/cadastro?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'curso/cadastro?msg=incomplete_fields');
            }
        }
    }

    public function atualizar() {
        $Curso = new ClassCurso();   

        if (isset($_POST)) {
            //$instituicao = $_POST['id_instituicao'];
            $id = $_POST['id_curso'];
            $descricao = $_POST['descricao'];
            
            if (isset($_POST['nome']) && $_POST['nome'] != '') {
                $nome = $_POST['nome'];

                if (isset($_POST['nivel']) && $_POST['nivel'] != '') {
                    $nivel = $_POST['nivel'];

                    if (isset($_POST['ch']) && $_POST['ch'] != '') {
                        $ch = $_POST['ch'];

                        $result = $Curso->update($id, $nome, $nivel, $ch, $descricao);

                        if ($result == null) {
                            header('Location:' . DIRPAGE . 'curso?msg=error');
                        } else {
                            header('Location:' . DIRPAGE . 'curso?msg=create_success');
                        }
                        
                    } else {
                        header('Location:' . DIRPAGE . 'curso/edicao?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'curso/edicao?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'curso/edicao?msg=incomplete_fields');
            }            
            
        }
    }

}
