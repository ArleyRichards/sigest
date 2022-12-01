<?php

namespace App\Controller;

use App\Model\ClassDiscente;
use App\Model\ClassInstituicao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerTurma extends ClassRender implements InterfaceView
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
                    $this->msg = 'Discente cadastrado com sucesso!';
                } else if ($_GET['msg'] == 'update_success') {
                    $this->msg = 'Dados atualizados com sucesso!';
                }
            }

            $Discente = new ClassDiscente();
            $Instituicao = $_SESSION['id_instituicao'];

            $this->setTitle("Discentes");
            $this->setDescription("Painel Discentes");
            $this->setKeywords("dashboard, painel principal, sistema");
            $this->setDir("gestor/discente/index");
            $this->setData(['msg' => $this->msg, 'discente' => $Discente->all($Instituicao)]);
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
                $Render = new ClassRender();
                $Render->setTitle("Discentes");
                $Render->setDescription("Painel Discentes");
                $Render->setKeywords("dashboard, painel principal, sistema");
                $Render->setDir("gestor/discente/cadastro");
                $Render->setData(['msg' => $this->msg]);
                $Render->renderLayout();
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
                    $Discente = new ClassDiscente();
                    $Instituicao = new ClassInstituicao();

                    $rowDiscente = $Discente->read($id);
                    $rowInstituicao = $Instituicao->read($rowDiscente[0]['id_instituicao']);

                    $this->setTitle("Discente");
                    $this->setDescription("Painel Discente");
                    $this->setKeywords("dashboard, painel principal, sistema");
                    $this->setDir("gestor/discente/detalhes");
                    $this->setData(['msg' => $this->msg, 'discente' => $rowDiscente, 'instituicao' => $rowInstituicao]);
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
                    $Discente = new ClassDiscente();
                    $rowDiscente = $Discente->read($id);
                    $this->setTitle("Discentes");
                    $this->setDescription("Painel Discentes");
                    $this->setKeywords("dashboard, painel principal, sistema");
                    $this->setDir("gestor/discente/edicao");
                    $this->setData(['msg' => $this->msg, 'discente' => $rowDiscente]);
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
        $Discente = new ClassDiscente();
        $nomePai = $_POST['nome-pai'];
        $pcd = $_POST['pcd'];
        $instituicao = $_POST['id_instituicao'];

        if (isset($_POST)) {
            if (isset($_POST['nome']) && $_POST['nome'] != '') {
                $nome = $_POST['nome'];

                if (isset($_POST['nome-mae']) && $_POST['nome-mae'] != '') {
                    $nomeMae = $_POST['nome-mae'];

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

                                        $result = $Discente->create($nome, $nomeMae, $nomePai, $nascimento, $cpf, $rg, $email, $telefone, $pcd, $instituicao);

                                        if ($result == null) {
                                            header('Location:' . DIRPAGE . 'discente/cadastro?msg=error');
                                        } else {
                                            header('Location:' . DIRPAGE . 'discente?msg=create_success');
                                        }
                                    } else {
                                        header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                                    }
                                } else {
                                    header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                                }
                            } else {
                                header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                            }
                        } else {
                            header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                        }
                    } else {
                        header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
            }
        }
    }

    public function atualizar()
    {
        $Discente = new ClassDiscente();
        $nomePai = $_POST['nome-pai'];
        $pcd = $_POST['pcd'];
        $instituicao = $_POST['id_instituicao'];
        $id = $_POST['id_discente'];

        if (isset($_POST)) {
            if (isset($_POST['nome']) && $_POST['nome'] != '') {
                $nome = $_POST['nome'];

                if (isset($_POST['nome-mae']) && $_POST['nome-mae'] != '') {
                    $nomeMae = $_POST['nome-mae'];

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

                                        $result = $Discente->update($id, $nome, $nomeMae, $nomePai, $nascimento, $cpf, $rg, $email, $telefone, $pcd, $instituicao);
                                        
                                        if ($result == null) {
                                            header('Location:' . DIRPAGE . 'discente/edicao?msg=error');
                                        } else {
                                            header('Location:' . DIRPAGE . 'discente?msg=update_success');
                                        }
                                    } else {
                                        header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                                    }
                                } else {
                                    header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                                }
                            } else {
                                header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                            }
                        } else {
                            header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                        }
                    } else {
                        header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'discente/cadastro?msg=incomplete_fields');
            }
        }
    }
}
