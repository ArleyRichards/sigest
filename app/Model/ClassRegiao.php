<?php

namespace App\Model;

use App\Model\ClassConexao;
use PDO;
use PDOException;
use Throwable;

class ClassRegiao extends ClassConexao
{

    private $Db;

    protected function cadastrarRegiao($nome, $ativo, $vendBru, $vendLiq, $gerBru, $gerLiq)
    {
        $this->Db = $this->conexaoDB()->prepare("INSERT INTO regioes (nome, ativo, vend_bru, vend_liq, ger_bru, ger_liq) VALUES (:nome, :ativo, :vend_bru, :vend_liq, :ger_bru, :ger_liq)");
        $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
        $this->Db->bindParam(":ativo", $ativo, PDO::PARAM_INT);
        $this->Db->bindParam(":vend_bru", $vendBru, PDO::PARAM_INT);
        $this->Db->bindParam(":vend_liq", $vendLiq, PDO::PARAM_INT);
        $this->Db->bindParam(":ger_bru", $gerBru, PDO::PARAM_INT);
        $this->Db->bindParam(":ger_liq", $gerLiq, PDO::PARAM_INT);
        $this->Db->execute();
    }

    #LISTAGEM DE REGIOES ATIVOS COM PAGINAÇÃO
    protected function listarRegioesAtivos($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM regioes WHERE ativo = '1' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome'],
                'vend_liq' => $Fetch['vend_liq'],
                'ger_liq' => $Fetch['ger_liq'],
                'vend_bru' => $Fetch['vend_bru'],
                'ger_bru' => $Fetch['ger_bru']
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE REGIOES TOTAIS ATIVOS
    protected function listarRegioesAtivosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM regioes WHERE ativo = '1'");
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

    #LISTAGEM DE REGIOES INATIVOS COM PAGINAÇÃO
    protected function listarRegioesInativos($pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM regioes WHERE ativo = '0' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
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

    #LISTAGEM DE REGIOES TOTAIS INATIVOS
    protected function listarRegioesInativosCompleto()
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM regioes WHERE ativo = '0'");
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


    protected function buscarRegiao($buscar, $pagina, $registro)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM regioes WHERE nome LIKE '%$buscar%' LIMIT :pagina, :registro");
        $this->Db->bindParam(":pagina", $pagina, PDO::PARAM_INT);
        $this->Db->bindParam(":registro", $registro, PDO::PARAM_INT);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome']
            ];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE VENDEDORES TOTAIS ATIVOS
    protected function buscarRegiaoCompleto($buscar)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM regioes WHERE nome LIKE '%$buscar%'");
        //$this->Db->bindParam(":buscar",$buscar,\PDO::PARAM_STR);
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = [
                'id' => $Fetch['id'],
                'nome' => $Fetch['nome']
            ];
            $I++;
        }
        return $Array;
    }

    #MÉTODO DE APOIO - CONSULTA DE LOGIN DUPLICADO
    protected function consultaNome($nome)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE login = '$nome'");
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    #CREATE VENDEDOR
    protected function createRegiao($nome)
    {
        $ativo = 1;
        $data = null;

        try {
            $this->Db = $this->conexaoDB()->prepare("INSERT INTO regioes (nome, ativo) values (:nome, :ativo)");
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);
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

    protected function lockRegiao($id)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE regioes SET ativo = 0 WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Região bloqueado";
            } else {
                $msg = "Erro ao realizar o bloqueio";
            }

            return $msg;
        } catch (Throwable $th) {
            //throw $th;
        }
    }

    protected function unlockRegiao($id)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE regioes SET ativo = 1 WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

            if ($BFetch->execute()) {
                $msg = "Região desbloqueada";
            } else {
                $msg = "Erro ao realizar o desbloqueio";
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
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE usuarios SET ativo = 0 WHERE fk_regioes = :id");
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

    protected function unlockVendedores($id)
    {
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE usuarios SET ativo = 1 WHERE fk_regioes = :id");
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

    #LISTAGEM DE VENDEDORES TOTAIS ATIVOS
    protected function listarVendedores($regiao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'VENDEDOR' AND ativo = '1' AND fk_regioes = '$regiao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = ['id' => $Fetch['id'], 'nome' => $Fetch['nome'], 'login' => $Fetch['login']];
            $I++;
        }
        return $Array;
    }

    #LISTAGEM DE GERENTES TOTAIS ATIVOS
    protected function listarGerentes($regiao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'GERENTE' AND ativo = '1' AND fk_regioes = '$regiao'");
        $BFetch->execute();

        $I = 0;
        while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) {
            $Array[$I] = ['id' => $Fetch['id'], 'nome' => $Fetch['nome'], 'login' => $Fetch['login']];
            $I++;
        }
        return $Array;
    }

    #MÉTODO DE APOIO
    protected function readRegiao($id_regiao)
    {
        $Array = null;
        $BFetch = $this->Db = $this->conexaoDB()->prepare("SELECT * FROM regioes WHERE id = :id");
        $this->Db->bindParam(":id", $id_regiao, PDO::PARAM_INT);
        $BFetch->execute();

        $Fetch = $BFetch->fetchAll();

        return $Fetch;
    }

    protected function updateRegiao($id, $nome)
    {

        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE regioes SET nome = :nome WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);
            $this->Db->bindParam(":nome", $nome, PDO::PARAM_STR);

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

    protected function updateComissao($id, $gerBru, $gerLiq, $vendBru, $vendLiq)
    {
        try {
            $msg = null;
            $BFetch = $this->Db = $this->conexaoDB()->prepare("UPDATE regioes SET ger_bru = '$gerBru', ger_liq = '$gerLiq', vend_bru = '$vendBru', vend_liq = '$vendLiq' WHERE id = :id");
            $this->Db->bindParam(":id", $id, PDO::PARAM_INT);

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
}
