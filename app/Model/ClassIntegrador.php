<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassIntegrador extends ClassConexao
{
    #LISTAGEM DE CLIENTES TOTAIS ATIVOS
    protected function listarIntegradoresAtivosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM integradoras");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],                
                'cidade' => $Fetch['cidade'],
                'bairro' => $Fetch['bairro'],                
                'uf' => $Fetch['uf'],                                
                'cep' => $Fetch['cep'],                                
            ];
            $I++;
        }
        return $Array;
    }

    #CREATE TECNICO
    protected function createIntegradora($nome, $cidade ,$bairro, $logradouro, $uf, $cep)
    {
        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO integradoras (nome, cidade, bairro, logradouro, uf, cep) values (:nome, :cidade, :bairro, :logradouro, :uf, :cep)");
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
            $this->Db->bindParam(":cidade", $cidade, PDO::PARAM_STR);
            $this->Db->bindParam(":bairro", $bairro, PDO::PARAM_STR);
            $this->Db->bindParam(":logradouro", $logradouro, PDO::PARAM_STR);
            $this->Db->bindParam(":uf", $uf, PDO::PARAM_STR);
            $this->Db->bindParam(":cep", $cep, PDO::PARAM_STR);           

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
    

    
}
