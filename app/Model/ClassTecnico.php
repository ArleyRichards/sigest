<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassTecnico extends ClassConexao
{

    private $Db;

    #LISTAGEM DE TECNICOS TOTAIS ATIVOS
    public function listarTecnicosAtivosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE ativo = '1'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'rg' => $Fetch['rg'],
                'cpf' => $Fetch['cpf'],
                'telefone' => $Fetch['telefone'],
                'nascimento' => $Fetch['nascimento'],
                'email' => $Fetch['email'],
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
    protected function listarTecnicosAtivos($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE ativo = '1' LIMIT :pagina, :registro");
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

    #LISTAGEM DE TECNICOS INATIVOS COM PAGINAÇÃO
    protected function listarContas($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM contas WHERE id_usuario = '$id'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'banco' => $Fetch['banco'],
                'agencia' => $Fetch['agencia'],
                'conta' => $Fetch['conta'],
                'chave' => $Fetch['chave']
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
    protected function consultaCPF($cpf){
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE cpf = '$cpf'");        
        $BFetch->execute();      

        return $Array;
    }
    
    #CREATE TECNICO
    public function createTecnico($nome, $nascimento, $rg, $cpf, $telefone, $email, $cidade ,$bairro, $logradouro, $uf, $cep)
    {
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO tecnicos (nome, nascimento, rg, cpf, telefone, email, cidade, bairro, logradouro, uf, cep, ativo) values (:nome, :nascimento, :rg, :cpf, :telefone, :email, :cidade, :bairro, :logradouro, :uf, :cep, :ativo)");
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
            $this->Db->bindParam(":nascimento", $nascimento);
            $this->Db->bindParam(":rg", $rg, PDO::PARAM_STR);
            $this->Db->bindParam(":cpf", $cpf, PDO::PARAM_STR);
            $this->Db->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $this->Db->bindParam(":email", $email, PDO::PARAM_STR);
            $this->Db->bindParam(":cidade", $cidade, PDO::PARAM_STR);
            $this->Db->bindParam(":bairro", $bairro, PDO::PARAM_STR);
            $this->Db->bindParam(":logradouro", $logradouro, PDO::PARAM_STR);            
            $this->Db->bindParam(":uf", $uf, PDO::PARAM_STR);
            $this->Db->bindParam(":cep", $cep, PDO::PARAM_STR);
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

    public function updateTecnico($id, $nome, $nascimento, $rg, $cpf, $telefone, $email, $cidade, $bairro, $logradouro, $uf, $cep)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE tecnicos SET nome = '$nome', nascimento = '$nascimento', rg = '$rg', cpf = '$cpf', telefone = '$telefone', email = '$email', cidade = '$cidade', bairro = '$bairro', logradouro = '$logradouro', uf = '$uf', cep = '$cep' WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Dados Atualizados";
            } else {
                $msg = "Erro ao realizar o desbloqueio";
            }

            return $msg;
        } catch (Throwable $th) {
            //throw $th;
        }
    }

    public function readTecnico($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE id = '$id'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    protected function lockTecnico($id)
    {
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE tecnicos SET ativo = 0 WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Usuário bloqueado";
            } else {
                $msg = "Erro ao realizar o bloqueio";
            }

            return $msg;
        } catch (Throwable $th) {
            //throw $th;
        }
    }

    protected function unlockTecnico($id)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE tecnicos SET ativo = 1 WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Usuário desbloqueado";
            } else {
                $msg = "Erro ao realizar o desbloqueio";
            }

            return $msg;
        } catch (Throwable $th) {
            //throw $th;
        }
    }

    protected function insertMovimentacao($valor, $tipo, $fk_usuario)
    {

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO movimentacoes (tipo, valor, fk_usuario) values ('$tipo', '$valor', '$fk_usuario')");            

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

    public function createConta($banco, $agencia, $conta, $chave, $tecnico){
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO contas (banco, agencia, conta, chave, id_usuario) values (:banco, :agencia, :conta, :chave, :id_usuario)");
            $this->Db->bindParam(":banco", $banco, PDO::PARAM_STR);
            $this->Db->bindParam(":agencia", $agencia, PDO::PARAM_STR);
            $this->Db->bindParam(":conta", $conta, PDO::PARAM_STR);
            $this->Db->bindParam(":chave", $chave, PDO::PARAM_STR);
            $this->Db->bindParam(":id_usuario", $tecnico, PDO::PARAM_STR);

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
