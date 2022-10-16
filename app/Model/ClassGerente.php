<?php

namespace App\Model;

use App\Model\ClassConexao;
use DateTime;
use PDO;
use PDOException;
use Throwable;

class ClassGerente extends ClassConexao
{

    private $Db;

    #LISTAGEM DE GERENTES ATIVOS COM PAGINAÇÃO
    protected function listarGerentesAtivos($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'GERENTE' AND ativo = '1' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'login' => $Fetch['login'],                
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE GERENTES TOTAIS ATIVOS
    public function listarGerentesAtivosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'GERENTE'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = ['id' => $Fetch['id'], 'nome' => $Fetch['nome'], 'login' => $Fetch['login']];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE GERENTES INATIVOS COM PAGINAÇÃO
    protected function listarGerentesInativos($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'GERENTE' AND ativo = '0' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'login' => $Fetch['login'],                
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE GERENTES TOTAIS INATIVOS
    protected function listarGerentesInativosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'GERENTE' AND ativo = '0'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = ['id' => $Fetch['id'], 'nome' => $Fetch['nome'], 'login' => $Fetch['login']];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE VENDEDORES ATIVOS COM PAGINAÇÃO
    protected function buscarGerente($buscar, $pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nome LIKE '%$buscar%' AND nivel = 'GERENTE' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'login' => $Fetch['login'],                
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE VENDEDORES TOTAIS ATIVOS
    protected function buscarGerenteCompleto($buscar)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nome LIKE '%$buscar%' AND nivel = 'GERENTE'");
        //$this->Db->bindParam(":buscar",$buscar,\PDO::PARAM_STR);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = ['id' => $Fetch['id'], 'nome' => $Fetch['nome'], 'login' => $Fetch['login']];
            $I++;
        }
        return $Array;
    }

    #MÉTODO DE APOIO - CONSULTA DE LOGIN DUPLICADO
    protected function consultaLogin($login)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE login = '$login'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    #CREATE GERENTE
    protected function createGerente($nome, $login, $senha)
    {       
        $nivel = 'GERENTE';
        $deleted = null;
        $ativo = 1;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO usuarios (nome, login, nivel, senha, ativo) values (:nome, :login, '$nivel', :senha, '$ativo')");
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
            $this->Db->bindParam(":login", $login, PDO::PARAM_STR);
            $this->Db->bindParam(":senha", $senha, PDO::PARAM_STR);

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

    protected function readGerente($id)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE id = '$id'");
        /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    protected function listarVendedoresPorGerente($id_gerente)
    {
        try {
            $data = null;
            $this->Db = $this->conexaoDB()->prepare("SELECT * FROM vendedores WHERE fk_gerente = '$id_gerente'");
            $this->Db->execute();
            $data = $this->Db->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    protected function indexGerentes()
    {
        try {
            $data = null;
            $this->Db = $this->conexaoDB()->prepare("SELECT * FROM gerentes");
            $this->Db->execute();
            $data = $this->Db->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    protected function updateVendedor($id, $nome, $login, $senha, $fk_regiao, $gerente, $limite)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE usuarios SET nome = :nome, login = :login, senha = :senha, fk_regioes = :fk_regioes, gerente = :gerente, limite = :limite WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
            $this->Db->bindParam(":login", $login, PDO::PARAM_STR);
            $this->Db->bindParam(":senha", $senha, PDO::PARAM_STR);
            $this->Db->bindParam(":fk_regioes", $fk_regiao, PDO::PARAM_INT);
            $this->Db->bindParam(":gerente", $gerente, PDO::PARAM_INT);
            $this->Db->bindParam(":limite", $limite, PDO::PARAM_INT);

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

    protected function lockGerente($id)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE usuarios SET ativo = 0 WHERE id = :id");
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

    protected function lockVendedores($id)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE usuarios SET ativo = 0 WHERE gerente = :id");
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

    protected function unlockGerente($id)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE usuarios SET ativo = 1 WHERE id = :id");
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

    protected function unlockVendedores($id)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE usuarios SET ativo = 1 WHERE gerente = :id");
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

    protected function deleteGerente($id)
    {
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("DELETE FROM usuarios WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Usuário Excluído";
            } else {
                $msg = "Erro ao realizar a exclusão";
            }
            return $msg;
        } catch (Throwable $th) {
            //throw $th;
        }
    }
}
