<?php
namespace App\Controller;

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerAdmin extends ClassRender implements InterfaceView{

    use TraitUrlParser;

    public function __construct(){
        ob_start();
        session_start();
        if (isset($_SESSION['id'])) {
            $Render=new ClassRender();
            $Render->setTitle("Dashboard");
            $Render->setDescription("Painel Principal do Sistema");
            $Render->setKeywords("dashboard, painel principal, sistema");
            $Render->setDir("admin/dashboard");
            $Render->renderLayout();            
        }else{
            header ('Location: login');
        }
        
    }
}
?>