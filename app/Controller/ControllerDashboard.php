<?php
namespace App\Controller;

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerDashboard extends ClassRender implements InterfaceView{

    use TraitUrlParser;

    public function __construct(){
        ob_start();
        session_start();
        if (isset($_SESSION['id'])) { 
            if($_SESSION['nivel'] == 'ADMIN'){
                $this->setTitle("Dashboard");
                $this->setDescription("Painel Principal do Sistema");
                $this->setKeywords("dashboard, painel principal, sistema");
                $this->setDir("admin/dashboard");
                $this->renderLayout();    
            }else if($_SESSION['nivel'] == 'GESTOR'){
                $this->setTitle("Dashboard");
                $this->setDescription("Painel Principal do Sistema");
                $this->setKeywords("dashboard, painel principal, sistema");
                $this->setDir("gestor/dashboard");
                $this->renderLayout();    
            }
                    
        }else{
            header ('Location: login');
        }        
    }
}
?>