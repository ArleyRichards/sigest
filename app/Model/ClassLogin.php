<?php
namespace App\Model;

use App\Model\ClassConexao;
use PDO;

class ClassLogin extends ClassConexao{

    private $Db;

    #Retorna o Usuário e senha
public function selecionaUsuario($email, $senha)
{
    $Array = [];
    $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $BFetch->bindParam(":email",$email, PDO::PARAM_STR);
    $BFetch->bindParam(":senha",$senha, PDO::PARAM_STR);
    $BFetch->execute();

    $I=0;
    
    while($Fetch=$BFetch->fetch(PDO::FETCH_ASSOC)){
        $Array[$I]=[
            'id'=>$Fetch['id'],            
            ];
        $I++;
    }
    //$Fetch=$BFetch->fetchAll();
    return $Array;
}

}
?>