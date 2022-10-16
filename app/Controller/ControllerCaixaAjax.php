<?php

namespace App\Controller;

use App\Model\ClassMovimentacao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerCaixaAjax extends ClassMovimentacao
{

  use TraitUrlParser;

  public function __construct()
  {
  }

  public function recuperarVar()
  {
  }

  public function listarAtual()
  {
    $vendedor = $_POST['vendedor'];

    // Array com os dias da semana
    $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

    //CAPTURA O DIA DE HOJE
    $hoje = time();

    $diasemana_hoje = date('w', $hoje);

    $time_dom = null;
    //PROCURAR O DOMINGO ANTERIOR
    if ($diasemana_hoje == 0) {
      $time_dom = strtotime('-7 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 1) {
      $time_dom = strtotime('-1 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 2) {
      $time_dom = strtotime('-2 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 3) {
      $time_dom = strtotime('-3 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 4) {
      $time_dom = strtotime('-4 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 5) {
      $time_dom = strtotime('-5 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 6) {
      $time_dom = strtotime('-6 day', $hoje);
      $ant_dom = date('w', $time_dom);
    }

    $dh = date("Y-m-d", $hoje);
    $dd = date("Y-m-d", $time_dom);

    $fetchMovimentacoes = $this->listarMovimentacoesVendedor($hoje, $time_dom, $vendedor);
    $saldoAnterior = 0;
    $valorBruto = 0;
    $valorComissao = 0;
    $valorSaida = 0;
    $valorCredito = 0;
    $valorDebito = 0;
    $saldoTotal = 0;

    if ($fetchMovimentacoes) {

      foreach ($fetchMovimentacoes as $key => $mov) {
        if ($mov['tipo'] == 'ENTRADA') {
          $valorBruto = $valorBruto + $mov['valor'];
        }
        if ($mov['tipo'] == 'SAIDA') {
          $valorSaida = $valorSaida + $mov['valor'];
        }
        if ($mov['tipo'] == 'CREDITO') {
          $valorCredito = $valorCredito + $mov['valor'];
        }        
        if ($mov['tipo'] == 'COMISSAO') {
          $valorComissao = $valorComissao + $mov['valor'];
        }
      }

      $saldoTotal = 0;

      echo
      '<div class="table-rep-plugin">
        <div class="table-responsive" data-pattern="priority-columns">
          <table id="tech-companies-1" class="table table-striped">
            <tbody>
              <tr>
                <th>Saldo Anterior</th>
                <td>R$ ' . number_format($saldoAnterior, 2, ',', '.') . '</td>                
              </tr>
              <tr>
                <th>Total Apostado</th>
                <td>R$ ' . number_format($valorBruto, 2, ',', '.') . '</td>                
              </tr>
              <tr>
                <th>Comissões</th>
                <td>R$ ' . number_format($valorComissao, 2, ',', '.') . '</td>    
              </tr>
              <tr>
                <th>Prêmios</th>
                <td>R$ ' . number_format($valorSaida, 2, ',', '.') . '</td>                  
              </tr>
              <tr>
                <th>Créditos</th>
                <td>R$ ' . number_format($valorCredito, 2, ',', '.') . '</td>                  
              </tr>
              <tr>
                <th>Débitos</th>
                <td>R$ ' . number_format($valorDebito, 2, ',', '.') . '</td>   
              </tr>
              <tr>
                <th>Saldo</th>
                <td>R$ ' . number_format($valorBruto + $valorCredito - $valorComissao - $valorDebito, 2, ',', '.') . '</td>                   
              </tr>
            </tbody>';
    }else{
      echo
      '<div class="table-rep-plugin">
        <div class="table-responsive" data-pattern="priority-columns">
          <table id="tech-companies-1" class="table table-striped">
            <tbody>
              <tr>
                <th>Saldo Anterior</th>
                <td>R$ ' . number_format($saldoAnterior, 2, ',', '.') . '</td>     
              </tr>
              <tr>
                <th>Total Apostado</th>
                <td>R$ ' . number_format($valorBruto, 2, ',', '.') . '</td>                
              </tr>
              <tr>
                <th>Comissões</th>
                <td>R$ ' . number_format($valorComissao, 2, ',', '.') . '</td>    
              </tr>
              <tr>
                <th>Prêmios</th>
                <td>R$ ' . number_format($valorSaida, 2, ',', '.') . '</td>                  
              </tr>
              <tr>
                <th>Créditos</th>
                <td>R$ ' . number_format($valorCredito, 2, ',', '.') . '</td>                  
              </tr>
              <tr>
                <th>Débitos</th>
                <td>R$ ' . number_format($valorDebito, 2, ',', '.') . '</td>   
              </tr>
              <tr>
                <th>Saldo</th>
                <td>R$ ' . number_format($saldoTotal, 2, ',', '.') . '</td>                   
              </tr>
            </tbody>';
    }
  }

  public function listarAtivos()
  {
    /*
    if (isset($_POST['pagina'])) {
      $pagina = $_POST['pagina'];
    } else {
      $pagina = 1;
    }
    $registros = 10;
    $inicio = ($registros * $pagina) - $registros;

    $consultaCompleta = $this->listarVendedoresAtivosCompleto();
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

      $rowVendedores = $this->listarVendedoresAtivos($inicio, $registros);
      echo  '<p>' . $itens . ' Resultados para essa consulta</p>';
      echo
      '<div class="table-rep-plugin">
      <div class="table-responsive" data-pattern="priority-columns">
          <table id="tech-companies-1" class="table table-striped">
        <thead>
          <tr style="background-color: #E6E8E6">
            <th>Vendedor</th>
            <th>Região</th>
            <th>Ações</th>
          </tr>
        </thead>      
        <tbody>';

      foreach ($rowVendedores as $key => $vendedor) {

        $rowRegioes = $this->readRegiao($vendedor['fk_regioes']);

        echo
        '<tr>
              <td>' . $vendedor['nome'] . '</td>
              <td>' . $rowRegioes[0]['nome'] . '</td>
              <td>
                <button id="info" class="btn shadow" style="background-color: #E6E8E6" value="' . $vendedor['id'] . '" data-bs-toggle="modal" data-bs-target="#modal-info"><i class="fas fa-info" style="color: #F15025"></i></button>                
                <button id="lock" class="btn shadow" style="background-color: #E6E8E6" value="' . $vendedor['id'] . '"><i class="fas fa-lock" style="color: #F15025"></i></button>
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

      echo '<button class="btn btn-outline-light" style="background-color: #f15025; border: solid 2px #F15025;">' . $pagina . '</button>';

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
    */
  }

  public function listarAnterior()
  {

    // Array com os dias da semana
    $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

    //CAPTURA O DIA DE HOJE
    $hoje = time();

    $diasemana_hoje = date('w', $hoje);

    $time_dom = null;
    //PROCURAR O DOMINGO ANTERIOR
    if ($diasemana_hoje == 0) {
      $time_dom = strtotime('-7 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 1) {
      $time_dom = strtotime('-1 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 2) {
      $time_dom = strtotime('-2 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 3) {
      $time_dom = strtotime('-3 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 4) {
      $time_dom = strtotime('-4 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 5) {
      $time_dom = strtotime('-5 day', $hoje);
      $ant_dom = date('w', $time_dom);
    } else if ($diasemana_hoje == 6) {
      $time_dom = strtotime('-6 day', $hoje);
      $ant_dom = date('w', $time_dom);
    }

    $dh = date("Y-m-d", $hoje);
    $dd = date("Y-m-d", $time_dom);

    $fetchMovimentacoes = $this->listarMovimentacoes($dh, $dd);

    echo
    '<table class="table table-hover m-b-0">
      <thead>
        <tr>
          <th>Gerente</th>
          <th>Saldo Anterior</th>
          <th>Entradas</th>
          <th>Saídas</th>
          <th>Créditos</th>
          <th>Débitos</th>
          <th>Comissão</th>
          <th>Saldo</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>';

    foreach ($fetchMovimentacoes as $key => $mov) {

      $rowVend = $this->readVendedor($mov['fk_usuario']);

      foreach ($rowVend as $key => $user) {
      }

      $rowReg = $this->readRegiao($user['fk_regioes']);

      foreach ($rowReg as $key => $regiao) {
      }

      echo '
        <tr>
            <td>' . $user['nome'] . '</td>
            <td>' . $user['nivel'] . '</td>
            <td>' . $regiao['nome'] . '</td>
            <td>' . $mov['tipo'] . '</td>
            <td>' . date("d-m-Y", strtotime($mov['time'])) . '</td>
            <td>R$ ' . $mov['valor'] . '</td>
        </tr>';
    }

    echo '   
    </tbody>
    </table>';
  }
}
