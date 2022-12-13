<?php

namespace App\Model;

use App\Model\ClassConexao;
use PDO;

class ClassLogin extends ClassConexao {

    private $Db;

    #Retorna o Usuário e senha

    public function selecionaUsuario($email, $senha) {
        $Array = [];
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM us_usuarios WHERE us_email = :email AND us_senha = :senha");
        $BFetch->bindParam(":email", $email, PDO::PARAM_STR);
        $BFetch->bindParam(":senha", $senha, PDO::PARAM_STR);
        $BFetch->execute();

        $I = 0;

        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'us_id' => $Fetch['us_id'],
                'us_email' => $Fetch['us_email'],
                'us_nivel' => $Fetch['us_nivel'],
                'us_nome' => $Fetch['us_nome'],
                'us_id_instituicao' => $Fetch['us_id_instituicao']
            ];
            $I++;
        }
        //$Fetch=$BFetch->fetchAll();
        return $Array;
    }
}

?>