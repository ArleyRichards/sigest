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
            $this->setData(['msg' => $this->msg, 'gestor' => $gestor->all(), 'instituicao' => $this->listarInstituicoes()]);
            $this->renderLayout();
        } else {
            header('Location: login');
        }
    }

    /*
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
                $Render->setTitle("Instituições");
                $Render->setDescription("Painel Instituições");
                $Render->setKeywords("dashboard, painel principal, sistema");
                $Render->setDir("admin/instituicao/cadastro");
                $Render->setData(['msg' => $this->msg]);
                $Render->renderLayout();
            } else {
                header('Location: login');
            }
        }
    }
    */

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

    /*
    public function salvar()
    {
        $Instituicao = new ClassInstituicao();
        $inscricao = $_POST['inscricao-estadual'];
        $site = $_POST['site'];
        $numero = $_POST['numero'];
        $telefone2 = $_POST['telefone2'];

        if (isset($_POST)) {
            if (isset($_POST['razao-social']) && $_POST['razao-social'] != '') {
                $razao = $_POST['razao-social'];

                if (isset($_POST['nome-fantasia']) && $_POST['nome-fantasia'] != '') {
                    $fantasia = $_POST['nome-fantasia'];

                    if (isset($_POST['cnpj']) && $_POST['cnpj'] != '') {
                        $cnpj = $_POST['cnpj'];

                        if (isset($_POST['regime']) && $_POST['regime'] != '') {
                            $regime = $_POST['regime'];

                            if (isset($_POST['email']) && $_POST['email'] != '') {
                                $email = $_POST['email'];

                                if (isset($_POST['uf']) && $_POST['uf'] != '') {
                                    $uf = $_POST['uf'];

                                    if (isset($_POST['cidade']) && $_POST['cidade'] != '') {
                                        $cidade = $_POST['cidade'];

                                        if (isset($_POST['bairro']) && $_POST['bairro'] != '') {
                                            $bairro = $_POST['bairro'];

                                            if (isset($_POST['logradouro']) && $_POST['logradouro'] != '') {
                                                $logradouro = $_POST['logradouro'];

                                                if (isset($_POST['cep']) && $_POST['cep'] != '') {
                                                    $cep = $_POST['cep'];

                                                    if (isset($_POST['telefone']) && $_POST['telefone'] != '') {
                                                        $telefone1 = $_POST['telefone'];

                                                        $result = $Instituicao->create($razao, $fantasia, $cnpj, $inscricao, $regime, $site, $email, $uf, $cidade, $bairro, $logradouro, $numero, $cep, $telefone1, $telefone2);
                                                        if ($result == null) {
                                                            header('Location:' . DIRPAGE . 'instituicao/cadastro?msg=error');
                                                        } else {
                                                            header('Location:' . DIRPAGE . 'instituicao?msg=create_success');
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
    */

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

    #MÉTODOS DE APOIO
    //MÉTODO DE APOIO PARA EXIBIR O NOME DAS INSTITUIÇÕES
    public function listarInstituicoes()
    {
        $gestor = new ClassGestor();
        $rowGestor = $gestor->all();
        $gestores = array();
        for ($i = 0; $i < count($rowGestor); $i++) {
            $rowInstituicao = $gestor->readInstituicao($rowGestor[$i]['instituicao']);
            $gestores[$i] = $rowInstituicao[0];
        }
        return $gestores;
    }

    #MÉTODOS DE APOIO
    //MÉTODO DE APOIO PARA EXIBIR O NOME DAS INSTITUIÇÕES
    public function detalhesInstituicao($id)
    {
        $Gestor = new ClassGestor();
        $rowGestor = $Gestor->read($id);
        foreach ($rowGestor as $key => $gestor) {
        }
        $rowInstituicao = $Gestor->readInstituicao($gestor['instituicao']);

        return $rowInstituicao;
    }
}
