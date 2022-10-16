<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassCliente extends ClassConexao
{

    private $Db;

    #LISTAGEM DE CLIENTES TOTAIS ATIVOS
    public function listarClientesAtivosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM clientes");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'razao_social' => $Fetch['razao_social'],                
                'nome_fantasia' => $Fetch['nome_fantasia'], 
                'cnpj' => $Fetch['cnpj'], 
                'inscricao_estadual' => $Fetch['inscricao_estadual'], 
                'email' => $Fetch['email'],
                'cep' => $Fetch['cep'],                                
                'logradouro' => $Fetch['logradouro'],                                
                'bairro' => $Fetch['bairro'],                
                'cidade' => $Fetch['cidade'],                
                'uf' => $Fetch['uf'],                                                
                'telefone' => $Fetch['telefone'],                
                'telefone_2' => $Fetch['telefone_2'],                
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE TECNICOS ATIVOS COM PAGINAÇÃO
    protected function listarClientesAtivos($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM clientes LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'razao_social' => $Fetch['razao_social'],                
                'cidade' => $Fetch['cidade'],
                'bairro' => $Fetch['bairro'],                
                'uf' => $Fetch['uf'],  
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE TECNICOS INATIVOS COM PAGINAÇÃO
    protected function listarTecnicosInativos($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE ativo = '0' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'rg' => $Fetch['rg'],
                'cpf' => $Fetch['cpf'],
                'telefone' => $Fetch['telefone'],
                'cidade' => $Fetch['cidade'],
                'bairro' => $Fetch['bairro'],
                'logradouro' => $Fetch['logradouro'],
                'complemento' => $Fetch['complemento'],
                'uf' => $Fetch['uf'],
                'cep' => $Fetch['cep'],
                'ativo' => $Fetch['ativo'],
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE TECNICOS TOTAIS INATIVOS
    protected function listarTecnicosInativosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE ativo = '0'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'rg' => $Fetch['rg'],
                'cpf' => $Fetch['cpf'],
                'telefone' => $Fetch['telefone'],
                'cidade' => $Fetch['cidade'],
                'bairro' => $Fetch['bairro'],
                'logradouro' => $Fetch['logradouro'],
                'complemento' => $Fetch['complemento'],
                'uf' => $Fetch['uf'],
                'cep' => $Fetch['cep'],
                'ativo' => $Fetch['ativo'],
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE TECNICOS ATIVOS COM PAGINAÇÃO
    protected function buscarTecnico($buscar, $pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE nome LIKE '%$buscar%' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'cidade' => $Fetch['cidade'],
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE TECNICOS TOTAIS ATIVOS
    protected function buscarTecnicoCompleto($buscar)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE nome LIKE '%$buscar%'");
        //$this->Db->bindParam(":buscar",$buscar,\PDO::PARAM_STR);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'cidade' => $Fetch['cidade']
            ];
            $I++;
        }
        return $Array;
    }     
    
    #VERIFICA SE O TÉCNICO JÁ ESTÁ CADASTRADO
    protected function consultaRazao($razao_social){
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM clientes WHERE razao_social = '$razao_social'");        
        $BFetch->execute();      

        return $Array;
    }
    
    #CREATE TECNICO
    public function createCliente($razao, $fantasia, $cnpj, $inscricao, $email, $telefone1, $telefone2, $cidade, $uf, $logradouro, $bairro, $cep)
    {
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO clientes (razao_social, nome_fantasia, cnpj, inscricao_estadual, email, cep, logradouro, bairro, cidade, uf, telefone, telefone_2)
             values (:razao, :fantasia, :cnpj, :inscricao, :email, :cep, :logradouro, :bairro, :cidade, :uf, :telefone1, :telefone2)");
            $this->Db->bindParam(":razao", $razao, PDO::PARAM_STR);
            $this->Db->bindParam(":fantasia", $fantasia, PDO::PARAM_STR);
            $this->Db->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
            $this->Db->bindParam(":inscricao", $inscricao, PDO::PARAM_STR);
            $this->Db->bindParam(":email", $email, PDO::PARAM_STR);            
            $this->Db->bindParam(":cep", $cep, PDO::PARAM_STR);           
            $this->Db->bindParam(":logradouro", $logradouro, PDO::PARAM_STR);
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

    protected function readTecnico($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE id = '$id'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    public function readCliente($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM clientes WHERE id = '$id'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    public function updateCliente($id, $razao, $fantasia, $cnpj, $inscricao, $email, $telefone1, $telefone2, $cidade, $uf, $logradouro, $bairro, $cep){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE clientes SET razao_social = '$razao', nome_fantasia = '$fantasia', cnpj = '$cnpj', inscricao_estadual = '$inscricao', email = '$email', telefone = '$telefone1', telefone_2 = '$telefone2', cidade = '$cidade', uf = '$uf', logradouro = '$logradouro', bairro = '$bairro', cep = '$cep' WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Dados Atualizados";
            } else {
                $msg = "Erro ao realizar a atualização";
            }

            return $msg;
        } catch (Throwable $th) {
            //throw $th;
        }
    }  



    
}
