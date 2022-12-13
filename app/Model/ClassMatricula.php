<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassMatricula extends ClassConexao
{
    private $Db;   

    #GESTOR
    #LISTAGEM DE DISCENTES TOTAIS POR INSTITUICAO
    public function selectByCurso($instituicao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM turmas WHERE id_instituicao = '$instituicao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'codigo' => $Fetch['codigo'],      
                'vagas' => $Fetch['vagas'],
                'data_inicio' => $Fetch['data_inicio'],
                'horario_inicio' => $Fetch['horario_inicio'],
                'id_curso' =>  $Fetch['id_curso'],
                'id_docente' =>  $Fetch['id_docente'],
                'status' =>  $Fetch['status'],
            ];
            $I++;
        }
        return $Array;
    }  
    
    public function selectByTurma($instituicao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM turmas WHERE id_instituicao = '$instituicao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'codigo' => $Fetch['codigo'],      
                'vagas' => $Fetch['vagas'],
                'data_inicio' => $Fetch['data_inicio'],
                'horario_inicio' => $Fetch['horario_inicio'],
                'id_curso' =>  $Fetch['id_curso'],
                'id_docente' =>  $Fetch['id_docente'],
                'status' =>  $Fetch['status'],
            ];
            $I++;
        }
        return $Array;
    }  
    
    public function selectByAluno($instituicao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM turmas WHERE id_instituicao = '$instituicao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'codigo' => $Fetch['codigo'],      
                'vagas' => $Fetch['vagas'],
                'data_inicio' => $Fetch['data_inicio'],
                'horario_inicio' => $Fetch['horario_inicio'],
                'id_curso' =>  $Fetch['id_curso'],
                'id_docente' =>  $Fetch['id_docente'],
                'status' =>  $Fetch['status'],
            ];
            $I++;
        }
        return $Array;
    }  
    
    public function selectByInstituicao($instituicao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM turmas WHERE id_instituicao = '$instituicao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'codigo' => $Fetch['codigo'],      
                'vagas' => $Fetch['vagas'],
                'data_inicio' => $Fetch['data_inicio'],
                'horario_inicio' => $Fetch['horario_inicio'],
                'id_curso' =>  $Fetch['id_curso'],
                'id_docente' =>  $Fetch['id_docente'],
                'status' =>  $Fetch['status'],
            ];
            $I++;
        }
        return $Array;
    }  

    #CADASTRA UMA NOVA MATRÍCULA
    public function create($codigo, $id_curso, $vagas, $id_docente, $data_inicio, $data_fim, $horario_inicio, $horario_fim, $id_instituicao)
    {
        $ativo = 1;
        $data = null;
        $status = 'ABERTA';

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO turmas (codigo, id_curso, vagas, id_docente, data_inicio, data_fim, horario_inicio, horario_fim, id_instituicao, status, ativo)
                                                                 values (:codigo, :id_curso, :vagas, :id_docente, :data_inicio, :data_fim, :horario_inicio, :horario_fim, :id_instituicao, :status, :ativo)");
            $this->Db->bindParam(":codigo", $codigo, PDO::PARAM_STR);
            $this->Db->bindParam(":id_curso", $id_curso, PDO::PARAM_INT);            
            $this->Db->bindParam(":vagas", $vagas, PDO::PARAM_INT);
            $this->Db->bindParam(":id_docente", $id_docente, PDO::PARAM_INT);
            $this->Db->bindParam(":data_inicio", $data_inicio);
            $this->Db->bindParam(":data_fim", $data_fim);
            $this->Db->bindParam(":horario_inicio", $horario_inicio);            
            $this->Db->bindParam(":horario_fim", $horario_fim);            
            $this->Db->bindParam(":id_instituicao", $id_instituicao, PDO::PARAM_INT);
            $this->Db->bindParam(":status", $status, PDO::PARAM_STR);
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
    
    #EXIBE OS DETALHES DA MATRICULA
    public function read($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM turmas WHERE id = '$id'");
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    } 

    #ATUALIZA OS DADOS DA MATRICULA
    public function update($id, $codigo, $curso, $vagas, $docente, $data_inicio, $data_fim, $horario_inicio, $horario_fim){
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE turmas SET codigo = '$codigo', id_curso = '$curso', vagas = '$vagas', id_docente = '$docente', data_inicio = '$data_inicio',  data_fim = '$data_fim', horario_inicio = '$horario_inicio', horario_fim = '$horario_fim' WHERE id = :id");
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
