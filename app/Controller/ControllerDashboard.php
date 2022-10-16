<?php
namespace App\Controller;

use App\Model\ClassDashboard;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerDashboard extends ClassDashboard{

    use TraitUrlParser;

    public function __construct(){
        ob_start();
        session_start();
        if (isset($_SESSION['login'])) {
            $Render=new ClassRender();
            $Render->setTitle("Dashboard");
            $Render->setDescription("Painel Principal do Sistema");
            $Render->setKeywords("dashboard, painel principal, sistema");
            $Render->setDir("dashboard");
            $Render->renderLayout();            
        }else{
            header ('Location: login');
        }
        
    }
}
?>