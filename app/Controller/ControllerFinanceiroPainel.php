<?php
namespace App\Controller;

use App\Model\ClassMovimentacao;
use Src\Classes\ClassRender;
use Src\Classes\ClassPagination;
use Src\Traits\TraitUrlParser;

class ControllerFinanceiroPainel extends ClassMovimentacao {

    use TraitUrlParser;

    public function __construct()
    {
        session_start();
        $Render=new ClassRender();           
        $data = array($this->listarFinalizados(), $this->listarDebitos(), $this->listarTecnicos());            
        if(count($this->parseUrl())==1) {
            $Render->setTitle("Painel Financeiro");
            $Render->setDescription("Painel Financeiro");
            $Render->setKeywords("Controle Financeiro");
            $Render->setDir("financeiro-painel");
            $Render->setData($data);                        
            $Render->renderLayout();  
        }
        $Render->setDir("financeiro-painel");
        $Render->renderLayout();     
        
    }

    public function listarFinalizados(){
        //$rowFinalizados = $this->listarChamadosFinalizadosCompleto();
        $rowAReceber = $this->listarAReceber();
        return $rowAReceber;   
    }

    public function listarDebitos(){        
        $rowAPagar = $this->listarAPagar();
        return $rowAPagar;   
    }

    public function listarTecnicos(){        
        $rowChamados = $this->listarDebitos();
        $tecnicos = array();
        for ($i=0; $i < count($rowChamados); $i++) { 
            $rowTecnicos = $this->readTecnico($rowChamados[$i]['tecnico_id']);
            $tecnicos[$i] = $rowTecnicos[0]['nome'];
        }
        return $tecnicos;   
    }
    
}
?>