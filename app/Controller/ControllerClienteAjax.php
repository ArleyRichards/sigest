<?php

namespace App\Controller;

use App\Model\ClassCliente;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerClienteAjax extends ClassCliente
{

    use TraitUrlParser;

    public $id;
    public $nome;
    public $rg;
    public $cpf;
    public $telefone;
    public $cidade;
    public $bairro;
    public $logradouro;
    public $complemento;
    public $uf;
    public $cep;
    public $ativo;

    public function __construct()
    {
    }

    public function recuperarVar()
    {
        if (isset($_POST['id'])) {
            $this->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($_POST['razao'])) {
            $this->razao = filter_input(INPUT_POST, 'razao', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['email'])) {
            $this->email = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_EMAIL);
        }
        if (isset($_POST['telefone'])) {
            $this->telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['cidade'])) {
            $this->cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['bairro'])) {
            $this->bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($_POST['logradouro'])) {
            $this->logradouro = filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['complemento'])) {
            $this->complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['uf'])) {
            $this->uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['cep'])) {
            $this->cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
        }
    }

    public function listarAtivos()
    {
        if (isset($_POST['pagina'])) {
            $pagina = $_POST['pagina'];
        } else {
            $pagina = 1;
        }
        $registros = 10;
        $inicio = ($registros * $pagina) - $registros;

        $consultaCompleta = $this->listarClientesAtivosCompleto();
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }

        if ($itens < 1) {
            echo '<p class="text-muted">Nenhum resultado encontrado.</p>';
        } else {

            $qtd_paginas = ceil($itens / $registros);
            $max_links = 2;
            $primeira = 1;

            $rowClientes = $this->listarClientesAtivos($inicio, $registros);
            echo '<p>' . $itens . ' Resultados para essa consulta</p>';
            echo
            '<div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-striped">
                    <thead>
                    <tr style="background-color: #E6E8E6">
                        <th>...</th>
                        <th>Cliente</th>
                        <th>Região</th>
                        <th>UF</th>
                        <th>Ações</th>
                    </tr>
                    </thead>      
                    <tbody>';

            foreach ($rowClientes as $key => $cliente) {
                echo
                '<tr>
                    <td><span><i class="fa fa-bookmark"></i></span></td>              
                    <td>' . $cliente['razao_social'] . '</td>              
                    <td>' . $cliente['cidade'] . '</td>
                    <td>' . $cliente['uf'] . '</td>
                    <td>
                        <button id="info" class="btn btn-info shadow" value="' . $cliente['id'] . '" data-toggle="modal" data-target="#modal-info"><i class="fa fa-info"></i></button>                
                        <button id="lock" class="btn btn-warning shadow" value="' . $cliente['id'] . '"><i class="fa fa-lock"></i></button>
                    </td>
                </tr>';
            }
            echo '</tbody>
      </table></div></div>';
            echo
            '<div class="d-flex justify-content-center">
      <div class="text-center">
        <div class="btn-group" role="group" aria-label="Basic outlined example">';

            echo '<a href="#" id="pag_pri" value="1" class="btn btn-outline-secondary">Primeira</a>';

            for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                if ($pag_ant >= 1) {
                    echo ' <a class="btn btn-outline-secondary" id="pag_ant" href="#" value="' . $pag_ant . '">' . $pag_ant . '</a>';
                }
            }

            echo '<button class="btn btn-primary btn-outline-light">' . $pagina . '</button>';

            for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                if ($pag_dep <= $qtd_paginas) {
                    echo ' <a class="btn btn-outline-secondary" id="pag_dep" href="#" value="' . $pag_dep . '">' . $pag_dep . '</a>';
                }
            }

            echo ' <a href="#" id="pag_ult" value="' . $qtd_paginas . '" class="btn btn-outline-secondary">Última</a>';
            echo
            '</div>	
      </div>		
    </div>';
        }
    }

    public function cadastro()
    {
        $this->recuperarVar();

        //$consulta = $this->consultaRazao($this->razao_social);
        
        $create = $this->createCliente($this->razao, $this->telefone, $this->email, $this->telefone, $this->cidade, $this->bairro, $this->logradouro, $this->complemento, $this->uf, $this->cep);        

        echo $create;
    }

    public function buscar()
    {
        if (isset($_POST['buscar'])) {
            $this->varBusca = filter_input(INPUT_POST, 'buscar', FILTER_SANITIZE_STRING);
        }

        if (isset($_POST['pagina'])) {
            $pagina = $_POST['pagina'];
        } else {
            $pagina = 1;
        }
        $registros = 10;
        $inicio = ($registros * $pagina) - $registros;

        $consultaCompleta = $this->buscarTecnicoCompleto($this->varBusca);
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }


        if ($itens < 1) {
            echo '<p class="text-muted">Nenhum resultado encontrado.</p>';
        } else {
            $qtd_paginas = ceil($itens / $registros);
            $max_links = 2;
            $primeira = 1;
            $rowTecnicos = $this->buscarTecnico($this->varBusca, $inicio, $registros);
            echo '<p>' . $itens . ' Resultados para essa consulta</p>';
            echo
            '<div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-striped">
                    <thead>
                    <tr style="background-color: #E6E8E6">
                        <th>Técnico</th>
                        <th>Região</th>
                        <th>Ações</th>
                    </tr>
                    </thead>      
                    <tbody>';

            //var_dump($this->varBusca);
            foreach ($rowTecnicos as $key => $tecnico) {               

                echo
                    '<tr>
              <td>' . $tecnico['nome'] . '</td>
              <td>' . $tecnico['cidade'] . '</td>              
              <td>
                <button class="btn btn-info shadow" value="' . $tecnico['id'] . '"><i class="fas fa-info"></i></button>                                
              </td>
            </tr>';
            }
            echo '</tbody>
      </table></div></div>';


            echo
            '<div class="d-flex justify-content-center">
      <div class="text-center">
        <div class="btn-group" role="group" aria-label="Basic outlined example">';

            echo '<a href="#" id="pag_pri_busca" value="1" class="btn btn-outline-secondary">Primeira</a>';

            for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                if ($pag_ant >= 1) {
                    echo ' <a class="btn btn-outline-secondary" id="pag_ant_busca" href="#" value="' . $pag_ant . '">' . $pag_ant . '</a>';
                }
            }

            echo '<button class="btn btn-primary btn-outline-light">' . $pagina . '</button>';

            for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                if ($pag_dep <= $qtd_paginas) {
                    echo ' <a class="btn btn-outline-secondary" id="pag_dep_busca" href="#" value="' . $pag_dep . '">' . $pag_dep . '</a>';
                }
            }

            echo ' <a href="#" id="pag_ult_busca" value="' . $qtd_paginas . '" class="btn btn-outline-secondary">Última</a>';
            echo
            '</div>	
      </div>		
    </div>';
        }
    }

    public function visualizar()
    {
        $this->recuperarVar();
        $rowRead = $this->readTecnico($this->id);
        foreach ($rowRead as $key => $readTecnico) {
            
        }

        /*
        $rowGerente = $this->readTecnico($readTecnico['gerente']);
        foreach ($rowGerente as $key => $readGerente) {
            # code...
        }
        */
        /*
        $rowRegiao = $this->readRegiao($readVendedor['fk_regioes']);
        foreach ($rowRegiao as $key => $readRegiao) {
            # code...
        }
        */

        echo
            '<form>
                <div class="d-flex mb-2 justify-content-between">
                    <div class="form-group col-3 ">
                    <label>Codigo</label>    
                    <input id="id_usuario" class="form-control form-control-sm text-end" disabled value="' . $this->id . '">          
                    </div>
                    <div class="form-group col-3 text-end">
                    <span class="badge rounded-pill bg-success">Ativo</span>
                    </div>        
                </div>
                <div class="form-group mb-2">
                    <label>Nome</label>    
                    <input class="form-control form-control-sm " disabled value="' . $readTecnico['nome'] . '">
                </div>
                <hr>
                <p><i class="fas fa-calendar-alt text-laranja"></i> Cadastro: ' . date("d/m/Y", strtotime($readTecnico['created_at'])) . '</p>
                <p><i class="fas fa-receipt text-laranja"></i> Bilhetes:</p>
                <hr>
            </form>';
    
    }

    public function editar()
    {
        $this->recuperarVar();
        $rowRead = $this->readVendedor($this->id);
        foreach ($rowRead as $key => $readVendedor) {
            # code...
        }

        $rowGerente = $this->readVendedor($readVendedor['gerente']);
        foreach ($rowGerente as $key => $readGerente) {
            # code...
        }

        $rowGerentes = $this->listarGerentesAtivos();

        $rowRegiao = $this->readRegiao($readVendedor['fk_regioes']);
        foreach ($rowRegiao as $key => $readRegiao) {
            # code...
        }

        $rowRegioes = $this->listarRegioesAtivas();

        echo
            '<div class="form-group col-3 ">
    <label>Codigo</label>    
    <input id="edit-id" class="form-control form-control-sm text-end" disabled value="' . $this->id . '">          
    </div>
    <div><small class="text-danger" id="verificacao-regiao"></small></div>
        <div class="mb-3">
          <label for="selectRegiao" class="form-label">Região</label>
            <select class="form-select" id="edit-selectRegiao" aria-label="Default select example">
									<option class="bg-secondary" value="' . $readRegiao['id'] . '" selected>' . $readRegiao['nome'] . '</option>';
        foreach ($rowRegioes as $regiao => $col) {
            echo '<option value="' . $col['id'] . '">' . $col['nome'] . '</option>';
        }
        echo
            '</select>
							</div>
							<div><small class="text-danger" id="verificacao-gerente"></small></div>
							<div class="mb-3">
								<label for="selectGerente" class="form-label">Atribuir Gerente</label>
								<select class="form-select" id="edit-selectGerente" aria-label="Default select example">
									<option class="bg-secondary" value="' . $readGerente['id'] . '" selected>' . $readGerente['nome'] . '</option>';

        foreach ($rowGerentes as $gerente => $colGerente) {
            echo '<option value="' . $colGerente['id'] . '">' . $colGerente['nome'] . '</option>';
        }
        echo
            '</select>
							</div>
							<div><small class="text-danger" id="verificacao-nome"></small></div>
							<div class="mb-3">
								<label for="campoNome" class="form-label">Nome</label>
								<input type="text" class="form-control" id="edit-campoNome" value="' . $readVendedor['nome'] . '">
							</div>
							<div><small class="text-danger" id="verificacao-login"></small></div>
							<div class="mb-3">
								<label for="campoLogin" class="form-label">Login</label>
								<input type="text" class="form-control" id="edit-campoLogin" value="' . $readVendedor['login'] . '">
							</div>
							<div><small class="text-danger" id="verificacao-credito"></small></div>
							<div class="mb-3">
								<label for="campoLogin" class="form-label">Limite de Crédito</label>
								<div class="input-group mb-3">
									<span class="input-group-text">R$</span>
									<input id="edit-campoLimite" type="number" class="form-control" aria-label="Limite de Crédito" value="' . $readVendedor['limite'] . '">
									<span class="input-group-text">.00</span>
								</div>
							</div>
							<div><small class="text-danger" id="verificacao-senha"></small></div>
							<div class="mb-3">
								<label for="campoSenha" class="form-label">Senha</label>
								<input type="password" class="form-control" id="edit-campoSenha" value="' . $readVendedor['senha'] . '">
							</div>
							<div class="mb-3">
								<label for="campoSenhaVerificada" class="form-label">Redigite a Senha</label>
								<input type="password" class="form-control" id="edit-campoSenhaVerificada" value="' . $readVendedor['senha'] . '">
							</div>';

        /*
        echo
        '<form>
          <div class="d-flex mb-2 justify-content-between">
            <div class="form-group col-3 ">
              <label>Codigo</label>
              <input class="form-control form-control-sm text-end" disabled value="'.$this->id.'">
            </div>
            <div class="form-group col-3 text-end">
              <span class="badge rounded-pill bg-success">Ativo</span>
            </div>
          </div>
          <div class="form-group mb-2">
            <label>Nome</label>
            <input class="form-control form-control-sm " disabled value="'.$readVendedor['nome'].'">
          </div>
          <hr>
          <p><i class="fas fa-calendar-alt text-laranja"></i> Cadastro: '.date("d/m/Y", strtotime($readVendedor['cadastro'])).'</p>
          <p><i class="fas fa-user text-laranja"></i> Gerente: '.$readGerente['nome'].'</p>
          <p><i class="fas fa-map-marker-alt text-laranja"></i> Região: '.$readRegiao['nome'].'</p>
          <p><i class="fas fa-receipt text-laranja"></i> Bilhetes:</p>
          <hr>
        </form>';*/
    }

    public function atualizar()
    {
        $this->recuperarVar();

        $update = $this->updateVendedor($this->id, $this->nome, $this->login, $this->senha, $this->fk_regiao, $this->gerente, $this->limite);

        echo $update;
    }

    public function bloquear()
    {
        $this->recuperarVar();

        $lock = $this->lockTecnico($this->id);

        echo $lock;
    }

    public function desbloquear()
    {
        $this->recuperarVar();

        $unlock = $this->unlockTecnico($this->id);

        echo $unlock;
    }
}
