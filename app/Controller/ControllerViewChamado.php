<?php
namespace App\Controller;

use App\Model\ClassChamado;
use Src\Classes\ClassRender;
use Src\Classes\ClassPagination;
use Src\Traits\TraitUrlParser;

class ControllerViewChamado extends ClassChamado {

    use TraitUrlParser;

    public function __construct()
    {
        session_start();
        $Render=new ClassRender();   
        
                  
        if(count($this->parseUrl())==1) {
            $Render->setTitle("Painel Administrativo | Técnicos");
            $Render->setDescription("Painel de Controle de Técnicos");
            $Render->setKeywords("Controle de Técnicos");
            $Render->setDir("view-chamado");
            $Render->setData($this->visualizar());
            
            
            $Render->renderLayout();  
        }
        $Render->setDir("chamado");
        $Render->renderLayout();     
    }

    public function visualizar(){
        $chamado = null;
        if(isset($_GET['id'])){        
            $id = $_GET['id'];
            $chamado = $this->readChamadoByID($id);
        }
        return $chamado;
    }
}
?>