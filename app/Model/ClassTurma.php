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
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tr_turmas INNER JOIN cr_cursos ON cr_cursos.cr_id = tr_turmas.tr_id_curso INNER JOIN do_docentes ON do_docentes.do_id = tr_turmas.tr_id_docente WHERE tr_id_instituicao = '$instituicao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['tr_id'],
                'codigo' => $Fetch['tr_codigo'],      
                'vagas' => $Fetch['tr_vagas'],
                'data_inicio' => $Fetch['tr_data_inicio'],
                'horario_inicio' => $Fetch['tr_horario_inicio'],
                'id_curso' =>  $Fetch['tr_id_curso'],
                'id_docente' =>  $Fetch['tr_id_docente'],
                'status' =>  $Fetch['tr_status'],
                'curso' => $Fetch['cr_nome'],
                'docente' => $Fetch['do_nome'],
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
        $status = 'ABERTA';

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO tr_turmas (tr_codigo, tr_id_curso, tr_vagas, tr_id_docente, tr_data_inicio, tr_data_fim, tr_horario_inicio, tr_horario_fim, tr_id_instituicao, tr_status, tr_ativo)
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
    
    #EXIBE OS DETALHES DO DISCENTE
    public function read($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tr_turmas INNER JOIN cr_cursos ON cr_cursos.cr_id = tr_turmas.tr_id_curso INNER JOIN do_docentes ON do_docentes.do_id = tr_turmas.tr_id_docente WHERE tr_id = '$id'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['tr_id'],
                'codigo' => $Fetch['tr_codigo'],      
                'vagas' => $Fetch['tr_vagas'],
                'data_inicio' => $Fetch['tr_data_inicio'],
                'horario_inicio' => $Fetch['tr_horario_inicio'],
                'id_curso' =>  $Fetch['tr_id_curso'],
                'id_docente' =>  $Fetch['tr_id_docente'],
                'status' =>  $Fetch['tr_status'],
                'data_inicio' =>  $Fetch['tr_data_inicio'],
                'data_fim' =>  $Fetch['tr_data_fim'],
                'curso' => $Fetch['cr_nome'],
                'docente' => $Fetch['do_nome'],
                'email' => $Fetch['do_email'],
                'telefone' => $Fetch['do_telefone'],
            ];
            $I++;
        }
        return $Array;
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

    public function selectByCurso($id){
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tr_turmas WHERE tr_id_curso = '$id'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['tr_id'],
                'codigo' => $Fetch['tr_codigo'],      
                'vagas' => $Fetch['tr_vagas'],
                'data_inicio' => $Fetch['tr_data_inicio'],
                'horario_inicio' => $Fetch['tr_horario_inicio'],
                'id_curso' =>  $Fetch['tr_id_curso'],
                'id_docente' =>  $Fetch['tr_id_docente'],
                'status' =>  $Fetch['tr_status'],
            ];
            $I++;
        }
        return $Array;        
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
