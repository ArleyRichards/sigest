<?php

namespace App\Controller;

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerDashboard extends ClassRender implements InterfaceView {

    use TraitUrlParser;

    public function __construct() {
        ob_start();
        session_start();
        if (isset($_SESSION['id'])) {
            if ($_SESSION['nivel'] == 'ADMIN') {

                $this->painelAdmin();
            } else if ($_SESSION['nivel'] == 'GESTOR') {
                $this->painelGestor();
            }
        } else {
            header('Location: login');
        }
    }

    public function painelAdmin() {
        $this->setTitle("Dashboard");
        $this->setDescription("Painel Principal do Sistema");
        $this->setKeywords("dashboard, painel principal, sistema");
        $this->setDir("admin/dashboard");
        $this->renderLayout();
    }

    public function painelGestor() {
        $id_instituicao = $_SESSION['id_instituicao'];
        
        $Curso = new \App\Model\ClassCurso();
        $contCursos = count($Curso->all($id_instituicao));
        
        $Discente = new \App\Model\ClassDiscente();
        $contDiscentes = count($Discente->all($id_instituicao));
        
        $Docente = new \App\Model\ClassDocente();
        $contDocentes = count($Docente->all($id_instituicao));
        
        $Turma = new \App\Model\ClassTurma();
        $contTurmas = count($Turma->all($id_instituicao));
        
        
        //echo '<script>console.log('.json_encode($_SESSION).')</script>';        
        
        $this->setTitle("Dashboard");
        $this->setDescription("Painel Principal do Sistema");
        $this->setKeywords("dashboard, painel principal, sistema");
        $this->setDir("gestor/dashboard");
        $this->setData(['cursos' => $contCursos, 'discentes' => $contDiscentes, 'docentes' => $contDocentes, 'turmas' => $contTurmas]);
        $this->renderLayout();
    }

}

?>