<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassPecas extends ClassConexao
{

    #LISTAGEM DE CLIENTES TOTAIS ATIVOS
    public function listarPecasCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM pecas");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'codigo' => $Fetch['codigo'],                
                'descricao' => $Fetch['descricao'], 
                'valor_unitario' => $Fetch['valor_unitario'], 
                'quantidade' => $Fetch['quantidade']                             
            ];
            $I++;
        }
        return $Array;
    }

    public function createPeca($codigo, $descricao, $valor, $quantidade){
        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO pecas (codigo, descricao, valor_unitario, quantidade)
             values (:codigo, :descricao, :valor, :quantidade)");
            $this->Db->bindParam(":codigo", $codigo, PDO::PARAM_STR);
            $this->Db->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $this->Db->bindParam(":valor", $valor);
            $this->Db->bindParam(":quantidade", $quantidade, PDO::PARAM_INT);            

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

    public function readPeca($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM pecas WHERE id = '$id'");
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    public function updatePeca($id, $codigo, $descricao, $valor, $quantidade){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE pecas SET codigo = '$codigo', descricao = '$descricao', valor_unitario = '$valor', quantidade = '$quantidade' WHERE id = :id");
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
