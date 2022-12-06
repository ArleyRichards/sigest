<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassTurma extends ClassConexao
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
            ];
            $I++;
        }
        return $Array;
    }  

    #CADASTRA UM NOVO DISCENTE
    public function create($codigo, $id_curso, $vagas, $id_docente, $data_inicio, $data_fim, $horario_inicio, $horario_fim, $id_instituicao)
    {
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO turmas (codigo, id_curso, vagas, id_docente, data_inicio, data_fim, horario_inicio, horario_fim, id_instituicao, ativo)
                                                                 values (:codigo, :id_curso, :vagas, :id_docente, :data_inicio, :data_fim, :horario_inicio, :horario_fim, :id_instituicao, :ativo)");
            $this->Db->bindParam(":codigo", $codigo, PDO::PARAM_STR);
            $this->Db->bindParam(":id_curso", $id_curso, PDO::PARAM_INT);            
            $this->Db->bindParam(":vagas", $vagas, PDO::PARAM_INT);
            $this->Db->bindParam(":id_docente", $id_docente, PDO::PARAM_INT);
            $this->Db->bindParam(":data_inicio", $data_inicio);
            $this->Db->bindParam(":data_fim", $data_fim);
            $this->Db->bindParam(":horario_inicio", $horario_inicio);            
            $this->Db->bindParam(":horario_fim", $horario_fim);            
            $this->Db->bindParam(":id_instituicao", $id_instituicao, PDO::PARAM_INT);
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
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM turmas WHERE id = '$id'");
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    } 

    #ATUALIZA OS DADOS DO DISCENTE
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
