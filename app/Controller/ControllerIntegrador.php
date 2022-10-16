<?php
namespace App\Controller;

use Src\Classes\ClassRender;
use App\Model\ClassIntegrador;
use Src\Classes\ClassPagination;
use Src\Traits\TraitUrlParser;

class ControllerIntegrador extends ClassIntegrador {

    use TraitUrlParser;

    public function __construct()
    {
        session_start();
        $Render=new ClassRender();   
        $data = $this->listarIntegradoresAtivosCompleto();
        //$dados = $this->listarGerentes();            
        if(count($this->parseUrl())==1) {
            $Render->setTitle("Painel Administrativo | Integradores");
            $Render->setDescription("Painel de Controle de Integradores");
            $Render->setKeywords("Controle de Integradores");
            $Render->setDir("integrador");
            $Render->setData($data);
            //$Render->setDados($dados);
            $Render->renderLayout();  
        }
        $Render->setDir("integrador");
        $Render->renderLayout();     
        
    }

    public function listarAtivos(){
        
        if(isset($_POST['pagina'])){
            $pagina = $_POST['pagina'];
        }else{
            $pagina = 1;
        }

        $registros = 10;
        $rowRegioes = $this->listarAtivos($pagina, $registros);        
    }
}
?>