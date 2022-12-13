<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassDiscente extends ClassConexao
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
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM di_discentes WHERE di_id_instituicao = '$instituicao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['di_id'],
                'nome' => $Fetch['di_nome'],      
                'id_instituicao' => $Fetch['di_id_instituicao'],
            ];
            $I++;
        }
        return $Array;
    }  

    #CADASTRA UM NOVO DISCENTE
    public function create($nome, $nomeMae, $nomePai, $nascimento, $cpf, $rg, $email, $telefone, $pcd, $instituicao)
    {
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO alunos (nome, nome_mae, nome_pai, nascimento, cpf, rg, email, telefone, pcd, id_instituicao)
             values (:nome, :nome_mae, :nome_pai, :nascimento, :cpf, :rg, :email, :telefone, :pcd, :id_instituicao)");
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
            $this->Db->bindParam(":nome_mae", $nomeMae, PDO::PARAM_STR);
            $this->Db->bindParam(":nome_pai", $nomePai, PDO::PARAM_STR);
            $this->Db->bindParam(":nascimento", $nascimento);
            $this->Db->bindParam(":cpf", $cpf, PDO::PARAM_STR);
            $this->Db->bindParam(":rg", $rg, PDO::PARAM_STR);
            $this->Db->bindParam(":email", $email, PDO::PARAM_STR);            
            $this->Db->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $this->Db->bindParam(":pcd", $pcd, PDO::PARAM_STR);
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
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM di_discentes WHERE di_id = '$id'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['di_id'],
                'nome' => $Fetch['di_nome'],      
                'telefone' => $Fetch['di_telefone'], 
                'nome_mae' => $Fetch['di_nome_mae'], 
                'nome_pai' => $Fetch['di_nome_pai'], 
                'nascimento' => $Fetch['di_nascimento'], 
                'cpf' => $Fetch['di_cpf'], 
                'rg' => $Fetch['di_rg'], 
                'email' => $Fetch['di_email'], 
                'pcd' => $Fetch['di_pcd'], 
                'id_instituicao' => $Fetch['di_id_instituicao'],
            ];
            $I++;
        }
        return $Array;
    } 

    #ATUALIZA OS DADOS DO DISCENTE
    public function update($id, $nome, $nomeMae, $nomePai, $nascimento, $cpf, $rg, $email, $telefone, $pcd, $instituicao){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE di_discentes SET di_nome = '$nome', di_nome_mae = '$nomeMae', di_nome_pai = '$nomePai', di_nascimento = '$nascimento', di_cpf = '$cpf', di_rg = '$rg',  di_email = '$email', di_telefone = '$telefone', di_pcd = '$pcd', di_id_instituicao = '$instituicao' WHERE di_id = :id");
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

    #MÉTODO DE APOIO
    #EXIBE OS DETALHES DA INSTITUIÇÃO
    public function readInstituicao($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM escolas WHERE id = '$id'");
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }   
   
}
