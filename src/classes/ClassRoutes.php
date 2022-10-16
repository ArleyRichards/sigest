<?php
namespace Src\Classes;

use App\Controller\ControllerImprimir;
use Src\Traits\TraitUrlParser;

class ClassRoutes{

    use TraitUrlParser;

    private $Rota;

    #Método de retorno da rota
    public function getRota(){
        $Url=$this->parseUrl();
        $I=$Url[0];

        $this->Rota=array(
            ""=>"ControllerIndex",
            "login"=>"ControllerLogin",
            "loginAjax"=>"ControllerLoginAjax",
            "dashboard"=>"ControllerDashboard",
            "caixa"=>"ControllerCaixa",    
            "caixaAjax"=>"ControllerCaixaAjax", 
            "chamado"=>"ControllerChamado",
            "chamadoAjax"=>"ControllerChamadoAjax",
            "tecnico"=>"ControllerTecnico",
            "tecnicoAjax"=>"ControllerTecnicoAjax",
            "gerente"=>"ControllerGerente",
            "gerenteAjax"=>"ControllerGerenteAjax",
            "cliente" => "ControllerCliente",
            "clienteAjax" => "ControllerClienteAjax",
            "integrador" => "ControllerIntegrador",
            "integradorAjax" => "ControllerIntegradorAjax",
            "peca" => "ControllerPeca",
            "peca-excell" => "ControllerPecaExcell",
            "view-tecnico"=>"ControllerViewTecnico",
            "view-chamado"=>"ControllerViewChamado",
            "view-cliente"=>"ControllerViewCliente",
            "imprimir"=>"ControllerImprimir",
            "excell"=>"ControllerExcell",
            "cliente-excell"=>"ControllerClienteExcell",
            "tecnico-excell"=>"ControllerTecnicoExcell",
            "financeiro-painel"=>"ControllerFinanceiroPainel",
            "relatorio"=>"ControllerRelatorio",
            "logout"=>"ControllerLogout",
        );

        if(array_key_exists($I,$this->Rota)){
            
            if(file_exists(DIRREQ."app/Controller/{$this->Rota[$I]}.php")){
                return $this->Rota[$I];
            }else{
                return "Controller404";
            }

        }else{
            return "Controller404";
        }
    }
}

?>