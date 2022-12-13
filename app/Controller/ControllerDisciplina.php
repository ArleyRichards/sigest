<?php

namespace App\Controller;

use App\Model\ClassTurma;
use App\Model\ClassCurso;
use App\Model\ClassDocente;
use App\Model\ClassInstituicao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerTurma extends ClassRender implements InterfaceView {

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
                    $this->msg = 'Turma aberta com sucesso!';
                } else if ($_GET['msg'] == 'update_success') {
                    $this->msg = 'Dados atualizados com sucesso!';
                }
            }
            $Turma = new ClassTurma();
            $Instituicao = $_SESSION['id_instituicao'];

            //CHAMADA DOS MÉTODOS DE APOIO
            $resultCursos = $this->listaCursos($Turma->all($Instituicao));
            $resultDocentes = $this->listaDocentes($Turma->all($Instituicao));

            $this->setTitle("Turmas");
            $this->setDescription("Painel Turmas");
            $this->setKeywords("dashboard, painel principal, sistema");
            $this->setDir("gestor/turma/index");
            $this->setData(['msg' => $this->msg, 'turma' => $Turma->all($Instituicao), 'curso' => $resultCursos, 'docente' => $resultDocentes]);
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
                $Instituicao = $_SESSION['id_instituicao'];
                $Curso = new ClassCurso();
                $Docente = new ClassDocente();
                $rowCursos = $Curso->all($Instituicao);
                $rowDocente = $Docente->all($Instituicao);

                $this->setTitle("Turmas");
                $this->setDescription("Painel Turmas");
                $this->setKeywords("dashboard, painel principal, sistema");
                $this->setDir("gestor/turma/cadastro");
                $this->setData(['msg' => $this->msg, 'curso' => $rowCursos, 'docente' => $rowDocente]);
                $this->renderLayout();
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
                    $Docente = new ClassDocente();

                    $rowTurma = $Turma->read($id);
                    $rowCurso = $Curso->read($rowTurma[0]['id_curso']);
                    $rowDocente = $Docente->read($rowTurma[0]['id_docente']);

                    $this->setTitle("Turma");
                    $this->setDescription("Painel Turma");
                    $this->setKeywords("dashboard, painel principal, sistema");
                    $this->setDir("gestor/turma/detalhes");
                    $this->setData(['msg' => $this->msg, 'turma' => $rowTurma, 'curso' => $rowCurso, 'docente' => $rowDocente]);
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
                    $Turma = new ClassTurma();
                    $rowTurma = $Turma->read($id);
                    $Instituicao = $_SESSION['id_instituicao'];
                    $Curso = new ClassCurso();
                    $Docente = new ClassDocente();
                    $rowCursos = $Curso->all($Instituicao);
                    $rowDocente = $Docente->all($Instituicao);

                    $this->setTitle("Turmas");
                    $this->setDescription("Painel Turmas");
                    $this->setKeywords("dashboard, painel principal, sistema");
                    $this->setDir("gestor/turma/edicao");
                    $this->setData(['msg' => $this->msg, 'turma' => $rowTurma, 'curso' => $rowCursos, 'docente' => $rowDocente]);
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
        $Turma = new ClassTurma();
        $id_instituicao = $_POST['id_instituicao'];

        if (isset($_POST)) {
            if (isset($_POST['codigo']) && $_POST['codigo'] != '') {
                $codigo = $_POST['codigo'];

                if (isset($_POST['curso']) && $_POST['curso'] != '') {
                    $id_curso = $_POST['curso'];

                    if (isset($_POST['vagas']) && $_POST['vagas'] != '') {
                        $vagas = $_POST['vagas'];

                        if (isset($_POST['docente']) && $_POST['docente'] != '') {
                            $id_docente = $_POST['docente'];

                            if (isset($_POST['data_inicio']) && $_POST['data_inicio'] != '') {
                                $data_inicio = $_POST['data_inicio'];

                                if (isset($_POST['data_fim']) && $_POST['data_fim'] != '') {
                                    $data_fim = $_POST['data_fim'];

                                    if (isset($_POST['horario_inicio']) && $_POST['horario_inicio'] != '') {
                                        $horario_inicio = $_POST['horario_inicio'];

                                        if (isset($_POST['horario_fim']) && $_POST['horario_fim'] != '') {
                                            $horario_fim = $_POST['horario_fim'];

                                            $result = $Turma->create($codigo, $id_curso, $vagas, $id_docente, $data_inicio, $data_fim, $horario_inicio, $horario_fim, $id_instituicao);

                                            if ($result == null) {
                                                header('Location:' . DIRPAGE . 'turma/cadastro?msg=error');
                                            } else {
                                                //echo '<script>console.log("'.var_dump($_POST).'")</script>';

                                                header('Location:' . DIRPAGE . 'turma?msg=create_success');
                                            }
                                        } else {
                                            header('Location:' . DIRPAGE . 'turma/cadastro?msg=incomplete_fields');
                                        }
                                    } else {
                                        header('Location:' . DIRPAGE . 'turma/cadastro?msg=incomplete_fields');
                                    }
                                } else {
                                    header('Location:' . DIRPAGE . 'turma/cadastro?msg=incomplete_fields');
                                }
                            } else {
                                header('Location:' . DIRPAGE . 'turma/cadastro?msg=incomplete_fields');
                            }
                        } else {
                            header('Location:' . DIRPAGE . 'turma/cadastro?msg=incomplete_fields');
                        }
                    } else {
                        header('Location:' . DIRPAGE . 'turma/cadastro?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'turma/cadastro?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'turma/cadastro?msg=incomplete_fields');
            }
        }
    }

    public function atualizar() {
        $Turma = new ClassTurma();
        $id = $_POST['id_turma'];
        $instituicao = $_POST['id_instituicao'];

        if (isset($_POST)) {
            if (isset($_POST['codigo']) && $_POST['codigo'] != '') {
                $codigo = $_POST['codigo'];

                if (isset($_POST['curso']) && $_POST['curso'] != '') {
                    $curso = $_POST['curso'];

                    if (isset($_POST['vagas']) && $_POST['vagas'] != '') {
                        $vagas = $_POST['vagas'];

                        if (isset($_POST['docente']) && $_POST['docente'] != '') {
                            $docente = $_POST['docente'];

                            if (isset($_POST['data_inicio']) && $_POST['data_inicio'] != '') {
                                $data_inicio = $_POST['data_inicio'];

                                if (isset($_POST['data_fim']) && $_POST['data_fim'] != '') {
                                    $data_fim = $_POST['data_fim'];

                                    if (isset($_POST['horario_inicio']) && $_POST['horario_inicio'] != '') {
                                        $horario_inicio = $_POST['horario_inicio'];

                                        if (isset($_POST['horario_fim']) && $_POST['horario_fim'] != '') {
                                            $horario_fim = $_POST['horario_fim'];

                                            $result = $Turma->update($id, $codigo, $curso, $vagas, $docente, $data_inicio, $data_fim, $horario_inicio, $horario_fim);

                                            if ($result == null) {
                                                header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=error' . $result);
                                            } else {
                                                header('Location:' . DIRPAGE . 'turma?msg=update_success');
                                            }
                                        } else {
                                            header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=incomplete_fields');
                                        }
                                    } else {
                                        header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=incomplete_fields');
                                    }
                                } else {
                                    header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=incomplete_fields');
                                }
                            } else {
                                header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=incomplete_fields');
                            }
                        } else {
                            header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=incomplete_fields');
                        }
                    } else {
                        header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=incomplete_fields');
                    }
                } else {
                    header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=incomplete_fields');
                }
            } else {
                header('Location:' . DIRPAGE . 'turma/edicao/' . $id . '?msg=incomplete_fields');
            }
        }
    }

    //MÉTODOS EXCLUSIVOS DA TURMA
    public function abrir($id) {
        //session_start();
        $this->msg = null;
        if (count($this->parseUrl()) == 3) {
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'error') {
                    $this->msg = 'Erro ao salvar os dados';
                } else if ($_GET['msg'] == 'incomplete_fields') {
                    $this->msg = 'Preencha todos os campos obrigatórios';
                }
            }
            if (isset($_SESSION['id'])) {
                $Instituicao = $_SESSION['id_instituicao'];
                $Curso = new ClassCurso();
                $Docente = new ClassDocente();
                $rowCursos = $Curso->read($id);
                $rowDocente = $Docente->all($Instituicao);

                $this->setTitle("Turmas");
                $this->setDescription("Painel Turmas");
                $this->setKeywords("dashboard, painel principal, sistema");
                $this->setDir("gestor/turma/abrir");
                $this->setData(['msg' => $this->msg, 'curso' => $rowCursos, 'docente' => $rowDocente]);
                $this->renderLayout();
            } else {
                header('Location: login');
            }
        }
    }

    //MÉTODOS DE APOIO
    public function listaCursos($rowTurmas) {
        $Curso = new ClassCurso();
        $cursos = [];

        if (isset($rowTurmas) && $rowTurmas != null) {
            foreach ($rowTurmas as $key => $turma) {
                $cursos[$key] = $Curso->read($turma['id_curso']);
            }
        }

        /* echo '<script> console.log("'.json_encode($rowTurmas).'")</script>';
          var_dump($rowTurmas[0]); */

        return $cursos;
    }

    public function listaDocentes($rowTurmas) {
        $Docente = new ClassDocente();
        $docentes = [];

        if (isset($rowTurmas) && $rowTurmas != null) {
            foreach ($rowTurmas as $key => $turma) {
                $docentes[$key] = $Docente->read($turma['id_docente']);
            }
        }
        /* echo '<script> console.log("'.json_encode($rowTurmas).'")</script>';
          var_dump($rowTurmas[0]); */
        return $docentes;
    }

}
