<?php

namespace App\Controller;

use App\Model\ClassDocente;
use App\Model\ClassInstituicao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerDocente extends ClassRender implements InterfaceView
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
                    $this->msg = 'Docente cadastrado com sucesso!';
                } else if ($_GET['msg'] == 'update_success') {
                    $this->msg = 'Dados atualizados com sucesso!';
                }
            }

            $Docente = new ClassDocente();
            $Instituicao = $_SESSION['id_instituicao'];

            $this->setTitle("Docentes");
            $this->setDescription("Painel Docentes");
            $this->setKeywords("dashboard, painel principal, sistema");
            $this->setDir("gestor/docente/index");
            $this->setData(['msg' => $this->msg, 'docente' => $Docente->all($Instituicao)]);
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
            if (isset($_SESSION['id'])) {                
                $this->setTitle("Docentes");
                $this->setDescription("Painel Docentes");
                $this->setKeywords("dashboard, painel principal, sistema");
                $this->setDir("gestor/docente/cadastro");
                $this->setData(['msg' => $this->msg]);
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
                    $Docente = new ClassDocente();
                    $Instituicao = new ClassInstituicao();

                    $rowDocente = $Docente->read($id);
                    $rowInstituicao = $Instituicao->read($rowDocente[0]['id_instituicao']);

                    $this->setTitle("Docente");
                    $this->setDescription("Painel Docente");
                    $this->setKeywords("dashboard, painel principal, sistema");
                    $this->setDir("gestor/docente/detalhes");
                    $this->setData(['msg' => $this->msg, 'docente' => $rowDocente, 'instituicao' => $rowInstituicao]);
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
                    $Docente = new ClassDocente();
                    $rowDocente = $Docente->read($id);
                    $this->setTitle("Docentes");
                    $this->setDescription("Painel Docentes");
                    $this->setKeywords("dashboard, painel principal, sistema");
                    $this->setDir("gestor/docente/edicao");
                    $this->setData(['msg' => $this->msg, 'docente' => $rowDocente]);
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

    public function salvar()
    {
        $Docente = new ClassDocente();        
        $pcd = $_POST['pcd'];
        $instituicao = $_POST['id_instituicao'];

        if (isset($_POST)) {
            if (isset($_POST['nome']) && $_POST['nome'] != '') {
                $nome = $_POST['nome'];

                if (isset($_POST['formacao']) && $_POST['formacao'] != '') {
                    $formacao = $_POST['formacao'];

                    if (isset($_POST['cpf']) && $_POST['cpf'] != '') {
                        $cpf = $_POST['cpf'];

                        if (isset($_POST['rg']) && $_POST['rg'] != '') {
                            $rg = $_POST['rg'];

                            if (isset($_POST['nascimento']) && $_POST['nascimento'] != '') {
                                $nascimento = $_POST['nascimento'];

                                if (isset($_POST['email']) && $_POST['email'] != '') {
                                    $email = $_POST['email'];

                                    if (isset($_POST['telefone']) && $_POST['telefone'] != '') {
                                        $telefone = $_POST['telefone'];

                                        $result = $Docente->create($nome, $formacao, $nascimento, $cpf, $rg, $email, $telefone, $pcd, $instituicao);

                                        if ($result == null) {
                                            header('Location:' . DIRPAGE . 'docente/cadastro?msg=error');
                                        } else {
                                            header('Location:' . DIRPAGE . 'docente?msg=create_success');
                                        }
                                    } else {
                                        header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                                    }
                                } else {
                                    header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                                }
                            } else {
                                header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                            }
                        } else {
                            header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                        }
                    } else {
                        header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
            }
        }
    }

    public function atualizar()
    {
        $Docente = new ClassDocente();        
        $pcd = $_POST['pcd'];
        $instituicao = $_POST['id_instituicao'];
        $id = $_POST['id_docente'];

        if (isset($_POST)) {
            if (isset($_POST['nome']) && $_POST['nome'] != '') {
                $nome = $_POST['nome'];

                if (isset($_POST['formacao']) && $_POST['formacao'] != '') {
                    $formacao = $_POST['formacao'];

                    if (isset($_POST['cpf']) && $_POST['cpf'] != '') {
                        $cpf = $_POST['cpf'];

                        if (isset($_POST['rg']) && $_POST['rg'] != '') {
                            $rg = $_POST['rg'];

                            if (isset($_POST['nascimento']) && $_POST['nascimento'] != '') {
                                $nascimento = $_POST['nascimento'];

                                if (isset($_POST['email']) && $_POST['email'] != '') {
                                    $email = $_POST['email'];

                                    if (isset($_POST['telefone']) && $_POST['telefone'] != '') {
                                        $telefone = $_POST['telefone'];

                                        $result = $Docente->update($id, $nome, $formacao, $nascimento, $cpf, $rg, $email, $telefone, $pcd, $instituicao);
                                        
                                        if ($result == null) {
                                            header('Location:' . DIRPAGE . 'docente/edicao?msg=error');
                                        } else {
                                            header('Location:' . DIRPAGE . 'docente?msg=update_success');
                                        }
                                    } else {
                                        header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                                    }
                                } else {
                                    header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                                }
                            } else {
                                header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                            }
                        } else {
                            header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                        }
                    } else {
                        header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'docente/cadastro?msg=incomplete_fields');
            }
        }
    }
}
