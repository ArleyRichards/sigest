<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassRelatorio extends ClassConexao
{

    private $Db;

    #LISTAGEM DE CHAMADOS TOTAIS AGENDADOS
    public function consultaRelatorio1($inicio, $final)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT DISTINCT tecnico_id FROM chamados WHERE data_agendamento between '$inicio' AND '$final'");        
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [/*
                'id' => $Fetch['id'],
                'cliente_id' => $Fetch['cliente_id'],*/
                'tecnico_id' => $Fetch['tecnico_id']/*,
                'data_cadastro' => $Fetch['data_cadastro'],
                'data_agendamento' => $Fetch['data_agendamento'],
                'tipo' => $Fetch['tipo'],
                'descricao' => $Fetch['descricao'],
                'hora_inicio' => $Fetch['hora_inicio'],
                'hora_final' => $Fetch['hora_final'],
                'hora_total' => $Fetch['hora_total'],
                'data_agendamento' => $Fetch['data_agendamento'],
                'rat_entregue' => $Fetch['rat_entregue'],
                'numero_rat' => $Fetch['numero_rat'],
                'valor_tecnico' => $Fetch['valor_tecnico'],
                'valor_pecas' => $Fetch['valor_adicional'],
                'valor_adicional' => $Fetch['valor_adicional'],
                'valor_total' => $Fetch['valor_total'],*/
            ];
            $I++;
        }
        return $Array;
    }

    public function consultaRelatorio2($inicio, $final)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT DISTINCT cliente_id FROM chamados WHERE data_agendamento between '$inicio' AND '$final'");        
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [/*
                'id' => $Fetch['id'],*/
                'cliente_id' => $Fetch['cliente_id']/*
                
                'data_cadastro' => $Fetch['data_cadastro'],
                'data_agendamento' => $Fetch['data_agendamento'],
                'tipo' => $Fetch['tipo'],
                'descricao' => $Fetch['descricao'],
                'hora_inicio' => $Fetch['hora_inicio'],
                'hora_final' => $Fetch['hora_final'],
                'hora_total' => $Fetch['hora_total'],
                'data_agendamento' => $Fetch['data_agendamento'],
                'rat_entregue' => $Fetch['rat_entregue'],
                'numero_rat' => $Fetch['numero_rat'],
                'valor_tecnico' => $Fetch['valor_tecnico'],
                'valor_pecas' => $Fetch['valor_adicional'],
                'valor_adicional' => $Fetch['valor_adicional'],
                'valor_total' => $Fetch['valor_total'],*/
            ];
            $I++;
        }
        return $Array;
    }
    
    public function consultaChamadoPorTecnico($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE tecnico_id = '$id'");        
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'codigo' => $Fetch['codigo'],
                'cliente_id' => $Fetch['cliente_id'],
                'tecnico_id' => $Fetch['tecnico_id'],
                'data_cadastro' => $Fetch['data_cadastro'],
                'data_agendamento' => $Fetch['data_agendamento'],
                'tipo' => $Fetch['tipo'],
                'descricao' => $Fetch['descricao'],
                'hora_inicio' => $Fetch['hora_inicio'],
                'hora_final' => $Fetch['hora_final'],
                'hora_total' => $Fetch['hora_total'],
                'data_agendamento' => $Fetch['data_agendamento'],
                'rat_entregue' => $Fetch['rat_entregue'],
                'numero_rat' => $Fetch['numero_rat'],
                'valor_tecnico' => $Fetch['valor_tecnico'],
                'valor_pecas' => $Fetch['valor_adicional'],
                'valor_adicional' => $Fetch['valor_adicional'],
                'status' => $Fetch['status'],
                'valor_total' => $Fetch['valor_total'],
            ];
            $I++;
        }
        return $Array;
    }

    public function consultaChamadoPorCliente($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE cliente_id = '$id'");        
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'codigo' => $Fetch['codigo'],
                'cliente_id' => $Fetch['cliente_id'],
                'tecnico_id' => $Fetch['tecnico_id'],
                'data_cadastro' => $Fetch['data_cadastro'],
                'data_agendamento' => $Fetch['data_agendamento'],
                'tipo' => $Fetch['tipo'],
                'descricao' => $Fetch['descricao'],
                'hora_inicio' => $Fetch['hora_inicio'],
                'hora_final' => $Fetch['hora_final'],
                'hora_total' => $Fetch['hora_total'],
                'data_agendamento' => $Fetch['data_agendamento'],
                'rat_entregue' => $Fetch['rat_entregue'],
                'numero_rat' => $Fetch['numero_rat'],
                'valor_tecnico' => $Fetch['valor_tecnico'],
                'valor_pecas' => $Fetch['valor_adicional'],
                'valor_adicional' => $Fetch['valor_adicional'],
                'status' => $Fetch['status'],
                'valor_total' => $Fetch['valor_total'],
            ];
            $I++;
        }
        return $Array;
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
}
