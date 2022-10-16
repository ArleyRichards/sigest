<?php
namespace App\Model;

use App\Model\ClassConexao;
use PDO;

class ClassLogin extends ClassConexao{

    private $Db;

    #Retorna o Usuário e senha
public function selecionaUsuario($login, $senha)
{
    $Array = [];
    $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE login = :login AND senha = :senha");
    $BFetch->bindParam(":login",$login, PDO::PARAM_STR);
    $BFetch->bindParam(":senha",$senha, PDO::PARAM_STR);
    $BFetch->execute();

    $I=0;
    
    while($Fetch=$BFetch->fetch(PDO::FETCH_ASSOC)){
        $Array[$I]=[
            'id'=>$Fetch['id'],
            'login'=>$Fetch['login'],
            'nome'=>$Fetch['nome'],            
            'nivel'=>$Fetch['nivel']                 
        ];
        $I++;
    }
    //$Fetch=$BFetch->fetchAll();
    return $Array;
}

}
?>