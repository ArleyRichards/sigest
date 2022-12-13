<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassDocente extends ClassConexao
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
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM do_docentes WHERE do_id_instituicao = '$instituicao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['do_id'],
                'nome' => $Fetch['do_nome'],      
                'id_instituicao' => $Fetch['do_id_instituicao'],
            ];
            $I++;
        }
        return $Array;
    }  

    #CADASTRA UM NOVO DISCENTE
    public function create($nome, $formacao, $nascimento, $cpf, $rg, $email, $telefone, $pcd, $instituicao)
    {
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO do_docentes (do_nome, do_formacao, do_nascimento, do_cpf, do_rg, do_email, do_telefone, do_pcd, do_id_instituicao, do_ativo)
             values (:nome, :formacao, :nascimento, :cpf, :rg, :email, :telefone, :pcd, :id_instituicao, :ativo)");
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
            $this->Db->bindParam(":formacao", $formacao, PDO::PARAM_STR);            
            $this->Db->bindParam(":nascimento", $nascimento);
            $this->Db->bindParam(":cpf", $cpf, PDO::PARAM_STR);
            $this->Db->bindParam(":rg", $rg, PDO::PARAM_STR);
            $this->Db->bindParam(":email", $email, PDO::PARAM_STR);            
            $this->Db->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $this->Db->bindParam(":pcd", $pcd, PDO::PARAM_STR);
            $this->Db->bindParam(":id_instituicao", $instituicao, PDO::PARAM_INT);
            $this->Db->bindParam(":ativo", $ativo, PDO::PARAM_INT);

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
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM do_docentes WHERE do_id = '$id'");
        $BFetch->execute();

//        $Fetch = $BFetch->fetchAll();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['do_id'],
                'nome' => $Fetch['do_nome'],  
                'email' => $Fetch['do_email'],
                'telefone' => $Fetch['do_telefone'],              
                'formacao' => $Fetch['do_formacao'],
                'nascimento' => $Fetch['do_nascimento'],
                'cpf' => $Fetch['do_cpf'],
                'rg' => $Fetch['do_rg'],
                'pcd' => $Fetch['do_pcd'],
                'id_instituicao' => $Fetch['do_id_instituicao'],
            ];
            $I++;
        }
        return $Array;
    } 

    #ATUALIZA OS DADOS DO DISCENTE
    public function update($id, $nome, $formacao, $nascimento, $cpf, $rg, $email, $telefone, $pcd, $instituicao){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE do_docentes SET do_nome = '$nome', do_formacao = '$formacao', do_nascimento = '$nascimento', do_cpf = '$cpf', do_rg = '$rg',  do_email = '$email', do_telefone = '$telefone', do_pcd = '$pcd', do_id_instituicao = '$instituicao' WHERE do_id = :id");
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
