<?php
namespace App\Controller;

use Src\Classes\ClassRender;
use App\Model\ClassTecnico;
use Src\Classes\ClassPagination;
use Src\Traits\TraitUrlParser;

class ControllerViewTecnico extends ClassTecnico {

    use TraitUrlParser;

    public function __construct()
    {
        session_start();
        $Render=new ClassRender();   
        
        //$dados = $this->listarGerentes();            
        if(count($this->parseUrl())==1) {
            $Render->setTitle("Painel Administrativo | Técnicos");
            $Render->setDescription("Painel de Controle de Técnicos");
            $Render->setKeywords("Controle de Técnicos");
            $Render->setDir("view-tecnico");
            $Render->setData($this->visualizar());
            $Render->setDados($this->visualizarContas());
            
            //$Render->setDados($dados);
            $Render->renderLayout();  
        }
        $Render->setDir("view-tecnico");
        $Render->renderLayout();     
    }

    public function inserirconta(){
        if (isset($_POST)) {
            $banco = $_POST['banco'];
            $agencia = $_POST['agencia'];
            $conta = $_POST['conta'];
            $chave = $_POST['chave'];
            $tecnico = $_POST['tecnico_id'];

            $result = $this->createConta($banco, $agencia, $conta, $chave, $tecnico);

            if ($result != null) {
                echo '<script> window.location.href = "../tecnico?msg=account_added"</script>';
                //header('Location: ../tecnico?msg=account_added');
            }
        }

    }

    public function visualizar(){
        $data = null;
        if(isset($_GET['id'])){        
            $id = $_GET['id'];
            $data = $this->readTecnico($id);
        }

        return $data;
    }

    public function visualizarContas(){
        $data = null;
        if(isset($_GET['id'])){        
            $id = $_GET['id'];
            $data = $this->listarContas($id);
        }

        return $data;
    }
}
?>