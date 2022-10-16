<?php
    namespace App\Model;

    use App\Model\ClassConexao;
    use PDO;
    use PDOException;
    use Throwable;

    class ClassDashboard extends ClassConexao{

        private $Db;

        #LISTAGEM DE VENDEDORES ATIVOS COM PAGINAÇÃO
        protected function listarVendedoresAtivos($pagina, $registro)
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'VENDEDOR' AND ativo = '1' LIMIT :pagina, :registro");
            $this->Db->bindParam(":pagina",$pagina, PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro, PDO::PARAM_INT);
            $BFetch->execute();

            $I=0;
            while($Fetch=$BFetch->fetch(PDO::FETCH_ASSOC)){
                $Array[$I]=[
                    'id'=>$Fetch['id'],
                    'nome'=>$Fetch['nome'],
                    'login'=>$Fetch['login'],
                    'fk_regioes'=>$Fetch['fk_regioes']
                ];
                $I++;
            }
            return $Array;
        }        

        #LISTAGEM DE VENDEDORES TOTAIS ATIVOS
        protected function listarVendedoresAtivosCompleto()
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'VENDEDOR' AND ativo = '1'");            
            $BFetch->execute();

            $I=0;
            while($Fetch=$BFetch->fetch(PDO::FETCH_ASSOC)){
                $Array[$I]=['id'=>$Fetch['id'],'nome'=>$Fetch['nome'],'login'=>$Fetch['login']];
                $I++;
            }
            return $Array;
        }

        #LISTAGEM DE VENDEDORES INATIVOS COM PAGINAÇÃO
        protected function listarVendedoresInativos($pagina, $registro)
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'VENDEDOR' AND ativo = '0' LIMIT :pagina, :registro");
            $this->Db->bindParam(":pagina",$pagina, PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro, PDO::PARAM_INT);
            $BFetch->execute();

            $I=0;
            while($Fetch=$BFetch->fetch(PDO::FETCH_ASSOC)){
                $Array[$I]=[
                    'id'=>$Fetch['id'],
                    'nome'=>$Fetch['nome'],
                    'login'=>$Fetch['login'],
                    'fk_regioes'=>$Fetch['fk_regioes']
                ];
                $I++;
            }
            return $Array;
        }

        #LISTAGEM DE VENDEDORES TOTAIS INATIVOS
        protected function listarVendedoresInativosCompleto()
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'VENDEDOR' AND ativo = '0'");            
            $BFetch->execute();

            $I=0;
            while($Fetch=$BFetch->fetch(PDO::FETCH_ASSOC)){
                $Array[$I]=['id'=>$Fetch['id'],'nome'=>$Fetch['nome'],'login'=>$Fetch['login']];
                $I++;
            }
            return $Array;
        }

        #LISTAGEM DE VENDEDORES ATIVOS COM PAGINAÇÃO
        protected function buscarVendedor($buscar, $pagina, $registro)
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nome LIKE '%$buscar%' AND nivel = 'VENDEDOR' LIMIT :pagina, :registro");
            $this->Db->bindParam(":pagina",$pagina, PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro, PDO::PARAM_INT);
            $BFetch->execute();

            $I=0;
            while($Fetch=$BFetch->fetch(PDO::FETCH_ASSOC)){
                $Array[$I]=[
                    'id'=>$Fetch['id'],
                    'nome'=>$Fetch['nome'],
                    'login'=>$Fetch['login'],
                    'fk_regioes'=>$Fetch['fk_regioes']
                ];
                $I++;
            }
            return $Array;
        }       
        
        #LISTAGEM DE VENDEDORES TOTAIS ATIVOS
        protected function buscarVendedorCompleto($buscar)
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nome LIKE '%$buscar%' AND nivel = 'VENDEDOR'");            
            //$this->Db->bindParam(":buscar",$buscar,\PDO::PARAM_STR);
            $BFetch->execute();

            $I=0;
            while($Fetch=$BFetch->fetch(PDO::FETCH_ASSOC)){
                $Array[$I]=['id'=>$Fetch['id'],'nome'=>$Fetch['nome'],'login'=>$Fetch['login']];
                $I++;
            }
            return $Array;
        }

        #MÉTODO DE APOIO
        protected function listarRegioesAtivas()
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM regioes WHERE ativo = '1'");
            /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
            $BFetch->execute();

            $Fetch=$BFetch->fetchAll();

            return $Fetch;
        }

        #MÉTODO DE APOIO
        protected function readRegiao($id_regiao)
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM regioes WHERE id = :id");
            $this->Db->bindParam(":id",$id_regiao, PDO::PARAM_INT);
            $BFetch->execute();

            $Fetch=$BFetch->fetchAll();

            return $Fetch;
        }

        #MÉTODO DE APOIO
        protected function listarGerentesAtivos()
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE nivel = 'GERENTE' AND ativo = '1'");
            /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
            $BFetch->execute();

            $Fetch=$BFetch->fetchAll();

            return $Fetch;
        }

        #MÉTODO DE APOIO - CONSULTA DE LOGIN DUPLICADO
        protected function consultaLogin($login)
        {
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE login = '$login'");
            /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
            $BFetch->execute();

            $Fetch=$BFetch->fetchAll();

            return $Fetch;
        }

        #CREATE VENDEDOR
        protected function createVendedor($nome, $login, $senha, $fk_regiao, $gerente, $limite)
        {
            $ativo = 1;            
            $data = null;
            
            try {            
                $this->Db=$this->conexaoDB()->prepare("INSERT INTO usuarios (nome, login, senha, fk_regioes, ativo, gerente, limite) values (:nome, :login, :senha, :fk_regiao, :ativo, :gerente, :limite)");
                $this->Db->bindParam(":nome",$nome, PDO::PARAM_STR);
                $this->Db->bindParam(":login",$login, PDO::PARAM_STR);
                $this->Db->bindParam(":senha",$senha, PDO::PARAM_STR);
                $this->Db->bindParam(":limite",$limite, PDO::PARAM_INT);
                $this->Db->bindParam(":fk_regiao",$fk_regiao, PDO::PARAM_INT);
                $this->Db->bindParam(":ativo",$ativo, PDO::PARAM_INT);
                $this->Db->bindParam(":gerente",$gerente, PDO::PARAM_INT);

                if($this->Db->execute()){
                    $data = "Sucesso no cadastro";
                }else{
                    $data = "Não foi possível finalizar o cadastro";
                }

            } catch (PDOException $ex) {
                return $ex->getMessage();
            }

            return $data;
        }

        protected function readVendedor($id){
            $Array = null;
            $BFetch=$this->Db=$this->conexaoDB()->prepare("SELECT * FROM usuarios WHERE id = '$id'");
            /*$this->Db->bindParam(":pagina",$pagina,\PDO::PARAM_INT);
            $this->Db->bindParam(":registro",$registro,\PDO::PARAM_INT);*/
            $BFetch->execute();

            $Fetch=$BFetch->fetchAll();

            return $Fetch;
        }

        protected function listarVendedoresPorGerente($id_gerente){
            try {
                $data = null;
                $this->Db=$this->conexaoDB()->prepare("SELECT * FROM vendedores WHERE fk_gerente = '$id_gerente'");
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
                $this->Db=$this->conexaoDB()->prepare("SELECT * FROM gerentes");
                $this->Db->execute();
                $data = $this->Db->fetchAll();
                return $data;
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
        }

        protected function updateVendedor($id, $nome, $login, $senha, $fk_regiao, $gerente, $limite){

            try {
                $msg = null;
                $BFetch=$this->Db=$this->conexaoDB()->prepare("UPDATE usuarios SET nome = :nome, login = :login, senha = :senha, fk_regioes = :fk_regioes, gerente = :gerente, limite = :limite WHERE id = :id");
                $this->Db->bindParam(":id",$id, PDO::PARAM_INT);
                $this->Db->bindParam(":nome",$nome, PDO::PARAM_STR);
                $this->Db->bindParam(":login",$login, PDO::PARAM_STR);
                $this->Db->bindParam(":senha",$senha, PDO::PARAM_STR);
                $this->Db->bindParam(":fk_regioes",$fk_regiao, PDO::PARAM_INT);
                $this->Db->bindParam(":gerente",$gerente, PDO::PARAM_INT);
                $this->Db->bindParam(":limite",$limite, PDO::PARAM_INT);

                if($BFetch->execute()){
                    $msg = "Os dados foram atualizados";
                }else{
                    $msg = "Erro ao atualizar os dados";
                }

                return $msg;
            } catch (Throwable $th) {
                //throw $th;
            }

        }

        protected function lockVendedor($id){

            try {
                $msg = null;
                $BFetch=$this->Db=$this->conexaoDB()->prepare("UPDATE usuarios SET ativo = 0 WHERE id = :id");
                $this->Db->bindParam(":id",$id, PDO::PARAM_INT);

                if($BFetch->execute()){
                    $msg = "Usuário bloqueado";
                }else{
                    $msg = "Erro ao realizar o bloqueio";
                }

                return $msg;
            } catch (Throwable $th) {
                //throw $th;
            }
        }

        protected function unlockVendedor($id){

            try {
                $msg = null;
                $BFetch=$this->Db=$this->conexaoDB()->prepare("UPDATE usuarios SET ativo = 1 WHERE id = :id");
                $this->Db->bindParam(":id",$id, PDO::PARAM_INT);

                if($BFetch->execute()){
                    $msg = "Usuário desbloqueado";
                }else{
                    $msg = "Erro ao realizar o desbloqueio";
                }

                return $msg;
            } catch (Throwable $th) {
                //throw $th;
            }
        }

        protected function deleteVendedor($id){
            try {
                $msg = null;
                $BFetch=$this->Db=$this->conexaoDB()->prepare("DELETE FROM usuarios WHERE id = :id");
                $this->Db->bindParam(":id",$id, PDO::PARAM_INT);

                if($BFetch->execute()){
                    $msg = "Usuário Excluído";
                }else{
                    $msg = "Erro ao realizar a exclusão";
                }
                return $msg;
            } catch (Throwable $th) {
                //throw $th;
            }
        }



        
    }