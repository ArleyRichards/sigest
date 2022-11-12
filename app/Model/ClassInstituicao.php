<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassInstituicao extends ClassConexao
{
    private $Db;

    #LISTAGEM DE INSTITUIÇÕES TOTAIS
    public function all()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM escolas");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'razao_social' => $Fetch['razao_social'],                
                'nome_fantasia' => $Fetch['nome_fantasia'], 
                'cnpj' => $Fetch['cnpj'], 
                'inscricao_estadual' => $Fetch['inscricao_estadual'], 
                'site' => $Fetch['site'],
                'email' => $Fetch['email'],
                'cep' => $Fetch['cep'],                                
                'endereco' => $Fetch['endereco'],                                
                'numero' => $Fetch['numero'],                                
                'bairro' => $Fetch['bairro'],                
                'cidade' => $Fetch['cidade'],                
                'uf' => $Fetch['uf'],                                                
                'telefone_1' => $Fetch['telefone_1'], 
                'telefone_2' => $Fetch['telefone_2'], 
            ];
            $I++;
        }
        return $Array;
    }  

    #CADASTRA UMA NOVA INSTITUIÇÃO
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
    
    #EXIBE OS DETALHES DA INSTITUIÇÃO
    public function read($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM escolas WHERE id = '$id'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    #VERIFICA SE O TÉCNICO JÁ ESTÁ CADASTRADO
    protected function consultaRazao($razao_social){
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM clientes WHERE razao_social = '$razao_social'");        
        $BFetch->execute();      

        return $Array;
    }
    

    public function update($id, $razao, $fantasia, $cnpj, $inscricao, $regime, $site, $email, $uf, $cidade, $bairro, $logradouro, $numero, $cep, $telefone1, $telefone2){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE escolas SET razao_social = '$razao', nome_fantasia = '$fantasia', cnpj = '$cnpj', inscricao_estadual = '$inscricao', regime = '$regime', site = '$site', email = '$email', telefone_1 = '$telefone1', telefone_2 = '$telefone2', cidade = '$cidade', uf = '$uf', endereco = '$logradouro', numero = '$numero' , bairro = '$bairro', cep = '$cep' WHERE id = :id");
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
