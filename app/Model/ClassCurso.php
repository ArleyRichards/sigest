<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassCurso extends ClassConexao
{
    private $Db;

    #ADMIN
    #LISTAGEM DE DISCENTES TOTAIS
    /*
    public function all()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM alunos");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],                
                'email' => $Fetch['email'], 
                'nivel' => $Fetch['nivel'], 
                'ativo' => $Fetch['ativo'],
                'instituicao' => $Fetch['instituicao'],
            ];
            $I++;
        }
        return $Array;
    }  
    */

    #GESTOR
    #LISTAGEM DE DISCENTES TOTAIS POR INSTITUICAO
    public function all($instituicao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM cr_cursos WHERE cr_id_instituicao = '$instituicao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['cr_id'],
                'nome' => $Fetch['cr_nome'],      
                'nivel' => $Fetch['cr_nivel'],      
                'carga_horaria' => $Fetch['cr_carga_horaria']   
            ];
            $I++;
        }
        return $Array;
    }  

    #CADASTRA UM NOVO DISCENTE
    public function create($nome, $nivel, $ch, $descricao, $instituicao)
    {
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO cr_cursos (cr_nome, cr_nivel, cr_carga_horaria, cr_descricao, cr_ativo, cr_id_instituicao)
             values (:nome, :nivel, :carga_horaria, :descricao, :id_instituicao, :ativo)");
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
            $this->Db->bindParam(":nivel", $nivel, PDO::PARAM_STR);            
            $this->Db->bindParam(":carga_horaria", $ch, PDO::PARAM_INT);
            $this->Db->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $this->Db->bindParam(":ativo", $ativo, PDO::PARAM_INT);
            $this->Db->bindParam(":id_instituicao", $instituicao, PDO::PARAM_INT);            

            if ($this->Db->execute()) {
                $data = "Sucesso no cadastro";
            } else {
                $data = "Não foi possível finalizar o cadastro";
            }
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        return $data;
    }
    
    #EXIBE OS DETALHES DO DISCENTE
    public function read($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM cr_cursos WHERE cr_id = '$id'");
        $BFetch->execute();

        //$Fetch = $BFetch->fetchAll();
        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['cr_id'],
                'nome' => $Fetch['cr_nome'],      
                'nivel' => $Fetch['cr_nivel'],  
                'descricao' => $Fetch['cr_descricao'],     
                'carga_horaria' => $Fetch['cr_carga_horaria']   
            ];
            $I++;
        }
        return $Array;

        //return $Fetch;
    } 

    #ATUALIZA OS DADOS DO DISCENTE
    public function update($id, $nome, $nivel, $ch, $descricao){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE cr_cursos SET cr_nome = '$nome', cr_nivel = '$nivel', cr_carga_horaria = '$ch', cr_descricao = '$descricao' WHERE cr_id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Dados Atualizados";
            } else {
                $msg = "Erro ao realizar a atualização";
            }

            return $msg;
        } catch (PDOException $ex) {
            $msg = $ex->getMessage();
            return $msg;
        }
    }  
   
}
