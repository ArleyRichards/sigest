<?php

namespace App\Controller;

use App\Model\ClassGerente;
use App\Model\ClassRegiao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerGerenteAjax extends ClassGerente
{

  use TraitUrlParser;

  public $id;
  public $nome;
  public $login;
  public $senha;

  public function __construct()
  {
  }

  public function recuperarVar()
  {
    if (isset($_POST['id'])) {
      $this->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
    if (isset($_POST['nome'])) {
      $this->nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['login'])) {
      $this->login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['senha'])) {
      $this->senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
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

    $consultaCompleta = $this->listarGerentesAtivosCompleto();
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

      $rowVendedores = $this->listarGerentesAtivos($inicio, $registros);
      echo  '<p>' . $itens . ' Resultados para essa consulta</p>';
      echo
      '
      <div class="table-rep-plugin">
        <div class="table-responsive" data-pattern="priority-columns">
            <table id="tech-companies-1" class="table table-striped">      
        <thead>
          <tr style="background-color: #E6E8E6">
            <th>Gerente</th>            
            <th>Ações</th>
          </tr>
        </thead>      
        <tbody>';

      foreach ($rowVendedores as $key => $vendedor) {        

        echo
        '<tr>
              <td>' . $vendedor['nome'] . '</td>
              
              <td>
                <button id="info" class="btn btn-info shadow" value="' . $vendedor['id'] . '" data-toggle="modal" data-target="#modal-info"><i class="fa fa-info text-light"></i></button>                
                <button id="lock" class="btn btn-warning shadow" value="' . $vendedor['id'] . '"><i class="fa fa-lock text-light"></i></button>
              </td>
            </tr>';
      }
      echo '</tbody>
      </table>
      </div>
      </div>';
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

      echo '<button class="btn btn-primary btn-outline-light" style="border: solid 2px #F15025;">' . $pagina . '</button>';

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

  public function listarInativos()
  {
    if (isset($_POST['pagina'])) {
      $pagina = $_POST['pagina'];
    } else {
      $pagina = 1;
    }
    $registros = 10;
    $inicio = ($registros * $pagina) - $registros;

    $consultaCompleta = $this->listarGerentesInativosCompleto();
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

      $rowGerentes = $this->listarGerentesInativos($inicio, $registros);
      echo  '<p>' . $itens . ' Resultados para essa consulta</p>';
      echo
      '<div class="table-rep-plugin">
      <div class="table-responsive" data-pattern="priority-columns">
          <table id="tech-companies-1" class="table table-striped">
        <thead>
          <tr style="background-color: #E6E8E6">
            <th>Gerente</th>            
            <th>Ações</th>
          </tr>
        </thead>      
        <tbody>';

      foreach ($rowGerentes as $key => $gerente) {
        echo
        '<tr>
              <td>' . $gerente['nome'] . '</td>              
              <td>                
                <button id="unlock" class="btn btn-warning shadow" value="' . $gerente['id'] . '"><i class="fa fa-unlock"></i></button>                
                <button id="del" class="btn btn-danger shadow" value="' . $gerente['id'] . '"><i class="fa fa-trash text-light"></i></button>                
              </td>
            </tr>';
      }
      echo '</tbody>
      </table>
      </div></div>';



      echo
      '<div class="d-flex justify-content-center">
      <div class="text-center">
        <div class="btn-group" role="group" aria-label="Basic outlined example">';

      echo '<a href="#" id="pag_pri_lock" value="1" class="btn btn-outline-secondary">Primeira</a>';

      for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
          echo ' <a class="btn btn-outline-secondary" id="pag_ant_lock" href="#" value="' . $pag_ant . '">' . $pag_ant . '</a>';
        }
      }

      echo '<button class="btn btn-primary btn-outline-light" border: solid 2px #F15025;">' . $pagina . '</button>';

      for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $qtd_paginas) {
          echo ' <a class="btn btn-outline-secondary" id="pag_dep_lock" href="#" value="' . $pag_dep . '">' . $pag_dep . '</a>';
        }
      }

      echo ' <a href="#" id="pag_ult_lock" value="' . $qtd_paginas . '" class="btn btn-outline-secondary">Última</a>';
      echo
      '</div>	
      </div>		
    </div>';
    }
  }

  public function cadastro()
  {
    $this->recuperarVar();

    $consulta = $this->consultaLogin($this->login);

    if ($consulta == null) {
      $create = $this->createGerente($this->nome, $this->login, $this->senha);
    } else {
      echo "Já existe um usuário com esse Login.";
    }

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

    $consultaCompleta = $this->buscarGerenteCompleto($this->varBusca);
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
      $rowGerentes = $this->buscarGerente($this->varBusca, $inicio, $registros);
      echo  '<p>' . $itens . ' Resultados para essa consulta</p>';
      echo
      '<div class="table-rep-plugin">
        <div class="table-responsive" data-pattern="priority-columns">
            <table id="tech-companies-1" class="table table-striped">
      
        <thead>
          <tr style="background-color: #E6E8E6">
            <th>Gerente</th>            
            <th>Ações</th>
          </tr>
        </thead>      
        <tbody>';

      //var_dump($this->varBusca);    
      foreach ($rowGerentes as $key => $gerente) {
        echo
        '<tr>
              <td>' . $gerente['nome'] . '</td>              
              <td>
                <button class="btn btn-info shadow" style="background-color: #E6E8E6" value="' . $gerente['id'] . '"><i class="fas fa-info text-light"></i></button>                                
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

      echo '<button class="btn btn-primary btn-outline-light" border: solid 2px #F15025;">' . $pagina . '</button>';

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
    $rowRead = $this->readGerente($this->id);
    foreach ($rowRead as $key => $readGerente) {
      # code...
    }

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
        <input class="form-control form-control-sm " disabled value="' . $readGerente['nome'] . '">
      </div>
      <hr>
      <p><i class="fas fa-calendar-alt text-laranja"></i> Cadastro: ' . date("d/m/Y", strtotime($readGerente['created_at'])) . '</p>                       
      <hr>
    </form>';
  }

  public function editar()
  {
    $this->recuperarVar();
    $rowRead = $this->readGerente($this->id);
    foreach ($rowRead as $key => $readVendedor) {
      # code...
    }

    echo
    '</select>
							</div>
							<div><small class="text-danger" id="verificacao-gerente"></small></div>
							
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
							
							<div><small class="text-danger" id="verificacao-senha"></small></div>
							<div class="mb-3">
								<label for="campoSenha" class="form-label">Senha</label>
								<input type="password" class="form-control" id="edit-campoSenha" value="' . $readVendedor['senha'] . '">
							</div>
							<div class="mb-3">
								<label for="campoSenhaVerificada" class="form-label">Redigite a Senha</label>
								<input type="password" class="form-control" id="edit-campoSenhaVerificada" value="' . $readVendedor['senha'] . '">
							</div>';    
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

    $lock = $this->lockGerente($this->id);
    $lockVendedores = $this->lockVendedores($this->id);

    echo $lock;
  }

  public function desbloquear()
  {
    $this->recuperarVar();

    $unlock = $this->unlockGerente($this->id);
    $unlockVendedores = $this->unlockVendedores($this->id);

    echo $unlock;
  }

  public function excluir()
  {
    $this->recuperarVar();

    $delete = $this->deleteGerente($this->id);

    echo $delete;
  }
}
