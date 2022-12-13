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
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM it_instituicoes");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['it_id'],
                'razao_social' => $Fetch['it_razao_social'],                
                'nome_fantasia' => $Fetch['it_nome_fantasia'], 
                'regime' => $Fetch['it_regime'], 
                'cnpj' => $Fetch['it_cnpj'], 
                'inscricao_estadual' => $Fetch['it_inscricao_estadual'], 
                'site' => $Fetch['it_site'],
                'email' => $Fetch['it_email'],
                'cep' => $Fetch['it_cep'],                                
                'endereco' => $Fetch['it_endereco'],                                
                'numero' => $Fetch['it_numero'],                                
                'bairro' => $Fetch['it_bairro'],                
                'cidade' => $Fetch['it_cidade'],                
                'uf' => $Fetch['it_uf'],                                                
                'telefone_1' => $Fetch['it_telefone_1'], 
                'telefone_2' => $Fetch['it_telefone_2'], 
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
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO it_instituicoes (it_razao_social, it_nome_fantasia, it_cnpj, it_inscricao_estadual, it_regime, it_site, it_email, it_cep, it_endereco, it_numero, it_bairro, it_cidade, it_uf, it_telefone_1, it_telefone_2)
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
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM it_instituicoes WHERE it_id = '$id'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        //$Fetch = $BFetch->fetchAll();
        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['it_id'],
                'razao_social' => $Fetch['it_razao_social'],                
                'nome_fantasia' => $Fetch['it_nome_fantasia'], 
                'cnpj' => $Fetch['it_cnpj'], 
                'inscricao_estadual' => $Fetch['it_inscricao_estadual'], 
                'regime' => $Fetch['it_regime'], 
                'site' => $Fetch['it_site'],
                'email' => $Fetch['it_email'],
                'cep' => $Fetch['it_cep'],                                
                'endereco' => $Fetch['it_endereco'],                                
                'numero' => $Fetch['it_numero'],                                
                'bairro' => $Fetch['it_bairro'],                
                'cidade' => $Fetch['it_cidade'],                
                'uf' => $Fetch['it_uf'],                                                
                'telefone_1' => $Fetch['it_telefone_1'], 
                'telefone_2' => $Fetch['it_telefone_2'], 
            ];
            $I++;
        }
        return $Array;        
    }

    #VERIFICA SE JÁ HÁ UMA INSTITUIÇÃO CADASTRADA
    protected function consultaRazao($razao){
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM it_instituicoes WHERE razao_social = '$razao'");        
        $BFetch->execute();      

        return $Array;
    }    

    #ATUALIZA OS DADOS DA INSTITUIÇÃO
    public function update($id, $razao, $fantasia, $cnpj, $inscricao, $regime, $site, $email, $uf, $cidade, $bairro, $logradouro, $numero, $cep, $telefone1, $telefone2){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE it_instituicoes SET it_razao_social = '$razao', it_nome_fantasia = '$fantasia', it_cnpj = '$cnpj', it_inscricao_estadual = '$inscricao', it_regime = '$regime', it_site = '$site', it_email = '$email', it_telefone_1 = '$telefone1', it_telefone_2 = '$telefone2', it_cidade = '$cidade', it_uf = '$uf', it_endereco = '$logradouro', it_numero = '$numero' , it_bairro = '$bairro', it_cep = '$cep' WHERE it_id = :id");
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
