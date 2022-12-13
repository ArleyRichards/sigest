<?php

namespace App\Controller;

use App\Model\ClassTurma;
use App\Model\ClassCurso;
use App\Model\ClassDocente;
use App\Model\ClassMatricula;
use App\Model\ClassInstituicao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerMatricula extends ClassRender implements InterfaceView {

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
    }

    public function cadastro() {
    }

    public function detalhes($id) {
    }

    public function edicao($id) {
    }

    public function atualizar() {
    
    }
}
