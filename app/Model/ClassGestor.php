<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassGestor extends ClassConexao
{
    private $Db;

    #LISTAGEM DE GESTORES TOTAIS
    public function all()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM us_usuarios INNER JOIN it_instituicoes ON it_instituicoes.it_id = us_usuarios.us_id_instituicao WHERE us_nivel ='GESTOR'");
        $BFetch->execute();        
        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['us_id'],
                'nome' => $Fetch['us_nome'],                
                'email' => $Fetch['us_email'], 
                'nivel' => $Fetch['us_nivel'], 
                'ativo' => $Fetch['us_ativo'],
                'instituicao' => $Fetch['us_id_instituicao'],
                'nome_fantasia' => $Fetch['it_nome_fantasia'],
                'uf' => $Fetch['it_uf'],
            ];
            $I++;
        }
        return $Array;
        //return $Fetch;
    }  

    #CADASTRA UM NOVO GESTOR
    public function create($razao, $fantasia, $cnpj, $inscricao, $regime, $site, $email, $uf, $cidade, $bairro, $logradouro, $numero, $cep, $telefone1, $telefone2)
    {
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO escolas (razao_social, nome_fantasia, cnpj, inscricao_estadual, regime, site, email, cep, endereco, numero, bairro, cidade, uf, telefone_1, telefone_2)
             values (:razao, :fantasia, :cnpj, :inscricao, :regime, :site, :email, :cep, :logradouro, :numero, :bairro, :cidade, :uf, :telefone1, :telefone2)");
            $this->Db->bindParam(":razao", $razao, PDO::PARAM_STR);
            $this->Db->bindParam(":fantasia", $fantasia, PDO::PARAM_STR);
            $this->Db->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
            $this->Db->bindParam(":inscricao", $inscricao, PDO::PARAM_STR);
            $this->Db->bindParam(":regime", $regime, PDO::PARAM_STR);
            $this->Db->bindParam(":site", $site, PDO::PARAM_STR);
            $this->Db->bindParam(":email", $email, PDO::PARAM_STR);            
            $this->Db->bindParam(":cep", $cep, PDO::PARAM_STR);           
            $this->Db->bindParam(":logradouro", $logradouro, PDO::PARAM_STR);
            $this->Db->bindParam(":numero", $numero, PDO::PARAM_INT);
            $this->Db->bindParam(":bairro", $bairro, PDO::PARAM_STR);
            $this->Db->bindParam(":cidade", $cidade, PDO::PARAM_STR);            
            $this->Db->bindParam(":uf", $uf, PDO::PARAM_STR);
            $this->Db->bindParam(":telefone1", $telefone1, PDO::PARAM_STR);
            $this->Db->bindParam(":telefone2", $telefone2, PDO::PARAM_STR);

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
    
    #EXIBE OS DETALHES DO GESTOR
    public function read($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE id = '$id'");
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    } 

    #ATUALIZA OS DADOS DO GESTOR
    public function update($id, $nome, $email, $instituicao, $nivel){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE usuarios SET nome = '$nome', email = '$email', instituicao = '$instituicao', nivel = '$nivel' WHERE id = :id");
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
