<?php
namespace App\Controller;

use App\Model\ClassDashboard;
use App\Model\ClassMovimentacao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerCaixa extends ClassMovimentacao{

    use TraitUrlParser;

    public function __construct(){
        $Render=new ClassRender();
        $Render->setTitle("Caixa | APPBET");
        $Render->setDescription("Painel Principal do Sistema");
        $Render->setKeywords("dashboard, painel principal, sistema");
        $Render->setDir("caixa");
        $Render->renderLayout();
    }
}
?>