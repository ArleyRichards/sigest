<?php
namespace App\Controller;

use Src\Classes\ClassRender;
use App\Model\ClassChamado;
use Src\Classes\ClassPagination;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerChamado extends ClassChamado{

    use TraitUrlParser;

    public function __construct()
    {
        $id = null;
        session_start();
        $Render=new ClassRender();   
        $data = $this->listarChamadosAgendadosCompleto();
        $data_tecnico = $this->readTecnico($id);      

        $selectClientes = $this->listarClientes();
        $selectTecnicos = $this->listarTecnicos();

        $dados = [$selectClientes, $selectTecnicos];

        if(count($this->parseUrl())==1) {
            $Render->setTitle("Painel Administrativo | Chamados");
            $Render->setDescription("Painel de Controle de Chamados");
            $Render->setKeywords("Controle de Chamados");
            $Render->setDir("chamado");
            $Render->setData($data);
            $Render->setDados($data_tecnico);
            $Render->setVar1($dados);
            $Render->renderLayout();  
        } 
                
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

    public function cadastro(){
        
        $Render=new ClassRender();

        $Render->setTitle("Painel Administrativo | Chamados");
        $Render->setDescription("Painel de Controle de Chamados");
        $Render->setKeywords("Controle de Chamados");
        $Render->setDir("form-chamado");        
        
        $selectClientes = $this->listarClientes();
        $selectTecnicos = $this->listarTecnicos();
        $selectIntegradores = $this->listarIntegradores();
        $dados = [$selectClientes, $selectTecnicos, $selectIntegradores];

        $Render->setVar1($dados);
        $Render->renderLayout();  
    }

    public function agendar(){
        $usuario = $_SESSION['id'];
        if(isset($_POST['cliente'])){ $cliente = filter_input( INPUT_POST, 'cliente'); }
        if(isset($_POST['integradora'])){ $integradora = filter_input( INPUT_POST, 'integradora'); }
        if(isset($_POST['tecnico'])){ $tecnico = filter_input( INPUT_POST, 'tecnico'); }
        if(isset($_POST['tipo'])){ $tipo = filter_input( INPUT_POST, 'tipo'); }
        if(isset($_POST['descricao'])){ $descricao = filter_input( INPUT_POST, 'descricao'); }
        if(isset($_POST['data'])){ $data = filter_input( INPUT_POST, 'data'); }
        if(isset($_POST['hora'])){ $hora = filter_input( INPUT_POST, 'hora'); }

        $result = $this->createChamado($usuario, $cliente, $tecnico, $descricao, $tipo, $data, $hora);
        if($result == null){

        }else{
            header('Location:'.DIRPAGE.'chamado');           
        }
    }


    public function readTecnico($id){
        $rowTecnico = $this->readTecnicoByID($id);
        return $rowTecnico;
    }

    //MÉTODOS DE APOIO//

    public function listarClientes(){
        $rowClientes = $this->listarClientesAtivosCompleto();
        return $rowClientes;
    }
    
    public function listarTecnicos(){
        $rowTecnicos = $this->listarTecnicosAtivosCompleto();
        return $rowTecnicos;
    }

    public function listarIntegradores(){
        $rowTecnicos = $this->listarIntegradoresAtivosCompleto();
        return $rowTecnicos;
    }
}
?>