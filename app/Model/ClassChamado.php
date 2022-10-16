<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassChamado extends ClassConexao
{

    private $Db;

    #LISTAGEM DE CHAMADOS TOTAIS AGENDADOS
    protected function listarChamadosAgendadosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE status = '1'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
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
                'valor_total' => $Fetch['valor_total'],
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE CHAMADOS TOTAIS AGENDADOS
    protected function listarChamadosAgendados($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE status = '1' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'cliente_id' => $Fetch['cliente_id'],
                'tecnico_id' => $Fetch['tecnico_id'],
                'data_cadastro' => $Fetch['data_cadastro'],
                'data_agendamento' => $Fetch['data_agendamento'],
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE CHAMADOS TOTAIS AGENDADOS
    protected function listarChamadosExecucaoCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE status = '2'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
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
                'valor_total' => $Fetch['valor_total'],
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE CHAMADOS TOTAIS AGENDADOS
    protected function listarChamadosExecucao($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE status = '2' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'cliente_id' => $Fetch['cliente_id'],
                'tecnico_id' => $Fetch['tecnico_id'],
                'data_cadastro' => $Fetch['data_cadastro'],
                'data_agendamento' => $Fetch['data_agendamento'],
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE CHAMADOS TOTAIS AGENDADOS
    protected function listarChamadosFinalizadosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE status = '5'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
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
                'valor_total' => $Fetch['valor_total'],
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE CHAMADOS TOTAIS AGENDADOS
    protected function listarChamadosFinalizados($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE status = '5' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'cliente_id' => $Fetch['cliente_id'],
                'tecnico_id' => $Fetch['tecnico_id'],
                'data_cadastro' => $Fetch['data_cadastro'],
                'data_agendamento' => $Fetch['data_agendamento'],
            ];
            $I++;
        }
        return $Array;
    }

    #MÉTODO DE APOIO Técnico
    protected function readChamadoByID($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM chamados WHERE id = '$id'");
        $BFetch->execute();
        $Fetch = $BFetch->fetchAll();
        return $Fetch;
    }

    #MÉTODO DE APOIO Técnico
    protected function readTecnicoByID($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE id = '$id'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    #MÉTODO DE APOIO Técnico
    protected function readClienteByID($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM clientes WHERE id = '$id'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    protected function readUsuarioByID($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE id = '$id'");
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    #MÉTODO DE APOIO
    #LISTAGEM DE TECNICOS TOTAIS ATIVOS
    protected function listarTecnicosAtivosCompleto()
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

    #MÉTODO DE APOIO
    #LISTAGEM DE TECNICOS TOTAIS ATIVOS
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
                'logradouro' => $Fetch['logradouro'],
                'uf' => $Fetch['uf'],
                'cep' => $Fetch['cep'],
            ];
            $I++;
        }
        return $Array;
    }

    #MÉTODO DE APOIO
    #LISTAGEM DE CLIENTES TOTAIS ATIVOS
    protected function listarClientesAtivosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM clientes");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome_fantasia' => $Fetch['razao_social'],
                'cidade' => $Fetch['cidade'],
                'bairro' => $Fetch['bairro'],
                'uf' => $Fetch['uf'],
                'cep' => $Fetch['cep'],
            ];
            $I++;
        }
        return $Array;
    }

    #MÉTODO DE APOIO
    #LISTAGEM DE CLIENTES TOTAIS ATIVOS
    protected function listarUsuariosAtivosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id']
            ];
            $I++;
        }
        return $Array;
    }

    #MÉTODO DE APOIO
    #LISTAGEM DE CLIENTES TOTAIS ATIVOS
    protected function listarGerentesAtivosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM gerentes");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id']
            ];
            $I++;
        }
        return $Array;
    }

    #MÉTODO DE APOIO
    #LISTAGEM DE TÉCNICOS PRESENTES NA REGIÃO
    protected function listarTecnicosPorRegiao($regiao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM `tecnicos` WHERE cidade = '$regiao';");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
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
    protected function consultaCPF($cpf)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM tecnicos WHERE cpf = '$cpf'");
        $BFetch->execute();

        return $Array;
    }

    #CREATE TECNICO
    protected function createChamado($usuario, $cliente, $tecnico, $descricao, $tipo, $data, $inicio)
    {

        $status = 1;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO chamados (usuario_id, cliente_id, tecnico_id, data_agendamento, status, tipo, descricao, hora_inicio)
                                                                 values (:usuario_id, :cliente_id, :tecnico_id, :data_agendamento, :status, :tipo, :descricao, :inicio)");
            $this->Db->bindParam(":usuario_id", $usuario, PDO::PARAM_INT);
            $this->Db->bindParam(":cliente_id", $cliente, PDO::PARAM_INT);
            $this->Db->bindParam(":tecnico_id", $tecnico, PDO::PARAM_INT);
            $this->Db->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $this->Db->bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $this->Db->bindParam(":data_agendamento", $data);
            $this->Db->bindParam(":status", $status, PDO::PARAM_INT);
            $this->Db->bindParam(":inicio", $inicio);

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

    protected function createMovimentacao($codigoChamado, $tipo, $valor, $descricao, $data, $hora, $chave, $tecnico_id, $usuario_id)
    {

        $situacao = 0;
        $chave = md5(time());

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO movimentacoes (codigo, tipo, descricao, data, hora, tecnico_id, usuario_id, valor, situacao, chave)
                                                                         values (:codigo, :tipo, :descricao, :data, :hora, :tecnico_id, :usuario_id, :valor, :situacao, :chave)");
            $this->Db->bindParam(":codigo", $codigoChamado, PDO::PARAM_STR);
            $this->Db->bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $this->Db->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $this->Db->bindParam(":data", $data);
            $this->Db->bindParam(":hora", $hora);
            $this->Db->bindParam(":valor", $valor);
            $this->Db->bindParam(":chave", $chave, PDO::PARAM_STR);
            $this->Db->bindParam(":situacao", $situacao);
            $this->Db->bindParam(":tecnico_id", $tecnico_id);
            $this->Db->bindParam(":usuario_id", $usuario_id);

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

    protected function iniciarChamadoDAO($id)
    {
        $status = 2;

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE chamados SET status = :status WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);
            $this->Db->bindParam(":status", $status, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Os dados foram atualizados";
            } else {
                $msg = "Erro ao atualizar os dados";
            }

            return $msg;
        } catch (Throwable $th) {
            //throw $th;
        }
    }

    protected function finalizarChamadoDAO($id, $codigoChamado, $numeroRat, $horaTermino, $tempoTotal, $valorTecnico, $valorPecas, $custosAdicionais, $valorTotal)
    {
        $status = 5;

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE chamados SET 
            status = :status,
            codigo = :codigo,
            numero_rat = :numero_rat,
            hora_final = :horaFinal,
            hora_total = :horaTotal,
            valor_tecnico = :valorTecnico,
            valor_pecas = :valorPecas,
            valor_adicional = :valorAdicional,
            valor_total = :valorTotal
            WHERE id = :id");
            $this->Db->bindParam(":codigo", $codigoChamado); //
            $this->Db->bindParam(":numero_rat", $numeroRat); //
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT); //
            $this->Db->bindParam(":status", $status, PDO::PARAM_INT); //           
            $this->Db->bindParam(":horaFinal", $horaTermino); //
            $this->Db->bindParam(":horaTotal", $tempoTotal); //
            $this->Db->bindParam(":valorTecnico", $valorTecnico); //
            $this->Db->bindParam(":valorPecas", $valorPecas); //
            $this->Db->bindParam(":valorAdicional", $custosAdicionais); //
            $this->Db->bindParam(":valorTotal", $valorTotal); //

            if ($BFetch->execute()) {
                $msg = "Os dados foram atualizados";
            } else {
                $msg = "Erro ao atualizar os dados";
            }

            return $msg;
        } catch (PDOException $ex) {
            return $ex;
        }
    }
}
