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
            ""=>"ControllerLogin",
            "login"=>"ControllerLogin",
            "registro"=>"ControllerRegistro",
            "logout"=>"ControllerLogout",            
            "dashboard"=>"ControllerDashboard"
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