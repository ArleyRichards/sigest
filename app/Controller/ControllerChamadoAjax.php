<?php

namespace App\Controller;

use App\Model\ClassChamado;
use DateTime;
use Src\Traits\TraitUrlParser;

class ControllerChamadoAjax extends ClassChamado
{

    use TraitUrlParser;

    public $id;

    public $usuario;
    public $cliente;
    public $tecnico;
    public $descricao;
    public $tipo;
    public $rat;
    public $data;
    public $inicio;
    public $termino;
    public $valor_tecnico;
    public $valor_pecas;
    public $custos_adicionais;
    public $valor_total;   

    public function __construct()
    {
    }

    public function recuperarVar()
    {
        if (isset($_POST['id'])) {
            $this->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($_POST['usuario'])) {
            $this->usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($_POST['cliente'])) {
            $this->cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($_POST['tecnico'])) {
            $this->tecnico = filter_input(INPUT_POST, 'tecnico', FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($_POST['descricao'])) {
            $this->descricao = filter_input(INPUT_POST, 'descricao');
        }
        if (isset($_POST['tipo'])) {
            $this->tipo = filter_input(INPUT_POST, 'tipo');
        }
        if (isset($_POST['rat'])) {
            $this->rat = filter_input(INPUT_POST, 'rat');
        }
        if (isset($_POST['data'])) {
            $this->data = filter_input(INPUT_POST, 'data');
        }
        if (isset($_POST['inicio'])) {
            $this->inicio = filter_input(INPUT_POST, 'inicio');
        }
        if (isset($_POST['termino'])) {
            $this->termino = filter_input(INPUT_POST, 'termino');
        }
        if (isset($_POST['valor_tecnico'])) {
            $this->valor_tecnico = filter_input(INPUT_POST, 'valor_tecnico', FILTER_SANITIZE_NUMBER_FLOAT);
        }
        if (isset($_POST['valor_pecas'])) {
            $this->valor_pecas = filter_input(INPUT_POST, 'valor_pecas', FILTER_SANITIZE_NUMBER_FLOAT);
        }
        if (isset($_POST['custos_adicionais'])) {
            $this->custos_adicionais = filter_input(INPUT_POST, 'custos_adicionais', FILTER_SANITIZE_NUMBER_FLOAT);
        }
        if (isset($_POST['valor_total'])) {
            $this->valor_total = filter_input(INPUT_POST, 'valor_total', FILTER_SANITIZE_NUMBER_FLOAT);
        }
    }

    public function listarAgendados()
    {
        if (isset($_POST['pagina'])) {
            $pagina = $_POST['pagina'];
        } else {
            $pagina = 1;
        }
        $registros = 10;
        $inicio = ($registros * $pagina) - $registros;

        $consultaCompleta = $this->listarChamadosAgendadosCompleto();
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

            $rowChamados = $this->listarChamadosAgendados($inicio, $registros);
            echo '<p>' . $itens . ' Resultados para essa consulta</p>';
            echo
            '<div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-striped">
                    <thead>
                    <tr style="background-color: #E6E8E6">            
                        <th>Cliente</th>
                        <th>Técnico</th>
                        <th>Cidade</th>
                        <th>Uf</th>
                        <th>Cadastro</th>
                        <th>Agendamento</th>
                        <th>...</th>
                    </tr>
                    </thead>      
                    <tbody>';

            foreach ($rowChamados as $key => $chamado) {

                $rowCliente = $this->readClienteByID($chamado['cliente_id']);
                foreach ($rowCliente as $key => $cliente) {
                    # code...
                }

                $rowTecnicos = $this->readTecnicoByID($chamado['tecnico_id']);
                foreach ($rowTecnicos as $key => $tecnico) {
                    # code...
                }               

                echo
                '<tr>                                 
                    <td>'.$cliente['nome_fantasia'].'</td>                                  
                    <td><a href="view-tecnico?id='.$tecnico['id'].'">' . $tecnico['nome'] . '</a></td>
                    <td>'.$cliente['cidade'].'</td>   
                    <td>'.$cliente['uf'].'</td>   
                    <td>' . date("d-m-Y", strtotime($chamado['data_cadastro'])).'</td>
                    <td>' . date("d-m-Y", strtotime($chamado['data_agendamento'])) . '</td>
                    <td>
                        <button type="button" id="info" class="btn btn-info shadow" value="' . $chamado['id'] . '" data-toggle="modal" data-target="#modal-info"><i class="fa fa-info"></i></button>                        
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

    public function listarExecucao()
    {
        if (isset($_POST['pagina'])) {
            $pagina = $_POST['pagina'];
        } else {
            $pagina = 1;
        }
        $registros = 10;
        $inicio = ($registros * $pagina) - $registros;

        $consultaCompleta = $this->listarChamadosExecucaoCompleto();
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

            $rowChamados = $this->listarChamadosExecucao($inicio, $registros);
            echo '<p>' . $itens . ' Resultados para essa consulta</p>';
            echo
            '<div class="table-rep-plugin">
      <div class="table-responsive" data-pattern="priority-columns">
          <table id="tech-companies-1" class="table table-striped">
        <thead>
          <tr style="background-color: #E6E8E6">            
            <th>Cliente</th>
            <th>Técnico</th>
            <th>Cidade</th>
            <th>Uf</th>
            <th>Cadastro</th>
            <th>Agendamento</th>
            <th>...</th>
          </tr>
        </thead>      
        <tbody>';

            foreach ($rowChamados as $key => $chamado) {

                $rowCliente = $this->readClienteByID($chamado['cliente_id']);
                foreach ($rowCliente as $key => $cliente) {
                    # code...
                }

                $rowTecnicos = $this->readTecnicoByID($chamado['tecnico_id']);
                foreach ($rowTecnicos as $key => $tecnico) {
                    # code...
                }               

                echo
                '<tr>                                 
                    <td>'.$cliente['nome_fantasia'].'</td>                                  
                    <td>' . $tecnico['nome'] . '</td>
                    <td>'.$cliente['cidade'].'</td>   
                    <td>'.$cliente['uf'].'</td>   
                    <td>' . date("d-m-Y", strtotime($chamado['data_cadastro'])).'</td>
                    <td>' . date("d-m-Y", strtotime($chamado['data_agendamento'])) . '</td>
                    <td>
                        <button type="button" id="info-execucao" class="btn btn-info shadow" value="' . $chamado['id'] . '" data-toggle="modal" data-target="#modal-info-execucao"><i class="fa fa-info"></i></button>                        
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

    public function listarFinalizados()
    {
        if (isset($_POST['pagina'])) {
            $pagina = $_POST['pagina'];
        } else {
            $pagina = 1;
        }
        $registros = 10;
        $inicio = ($registros * $pagina) - $registros;

        $consultaCompleta = $this->listarChamadosFinalizadosCompleto();
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

            $rowChamados = $this->listarChamadosFinalizados($inicio, $registros);
            echo '<p>' . $itens . ' Resultados para essa consulta</p>';
            echo
            '<div class="table-rep-plugin">
      <div class="table-responsive" data-pattern="priority-columns">
          <table id="tech-companies-1" class="table table-striped">
        <thead>
          <tr style="background-color: #E6E8E6">            
            <th>Cliente</th>
            <th>Técnico</th>
            <th>Cidade</th>
            <th>Uf</th>
            <th>Cadastro</th>
            <th>Agendamento</th>
            <th>...</th>
          </tr>
        </thead>      
        <tbody>';

            foreach ($rowChamados as $key => $chamado) {

                $rowCliente = $this->readClienteByID($chamado['cliente_id']);
                foreach ($rowCliente as $key => $cliente) {
                    # code...
                }

                $rowTecnicos = $this->readTecnicoByID($chamado['tecnico_id']);
                foreach ($rowTecnicos as $key => $tecnico) {
                    # code...
                }               

                echo
                '<tr>                                 
                    <td>'.$cliente['nome_fantasia'].'</td>                                  
                    <td>' . $tecnico['nome'] . '</td>
                    <td>'.$cliente['cidade'].'</td>   
                    <td>'.$cliente['uf'].'</td>   
                    <td>' . date("d-m-Y", strtotime($chamado['data_cadastro'])).'</td>
                    <td>' . date("d-m-Y", strtotime($chamado['data_agendamento'])) . '</td>
                    <td>
                        <button type="button" id="botao-faturar" class="btn btn-info shadow" value="' . $chamado['id'] . '" data-toggle="modal" data-target="#modal-faturar"><i class="fa fa-info"></i></button>                        
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

    public function contarAgendados()
    {
        $consultaCompleta = $this->listarChamadosAgendadosCompleto();
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }

        echo $itens;
    }    

    public function contarExecucao()
    {
        $consultaCompleta = $this->listarChamadosExecucaoCompleto();
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }

        echo $itens;
    }    

    public function contarFinalizados()
    {
        $consultaCompleta = $this->listarChamadosFinalizadosCompleto();
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }

        echo $itens;
    }

    public function contarTecnicos()
    {
        $consultaCompleta = $this->listarTecnicosAtivosCompleto();
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }

        echo $itens;
    }   

    public function contarGerentes()
    {
        $consultaCompleta = $this->listarGerentesAtivosCompleto();
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }

        echo $itens;
    }  

    public function contarUsuarios()
    {
        $consultaCompleta = $this->listarUsuariosAtivosCompleto();
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }

        echo $itens;
    }     

    public function contarClientes()
    {
        $consultaCompleta = $this->listarClientesAtivosCompleto();
        if ($consultaCompleta != null) {
            $itens = count($consultaCompleta);
        } else {
            $itens = 0;
        }

        echo $itens;
    }  

    public function cadastro()
    {
        $this->recuperarVar();               
        
        $create = $this->createChamado($this->usuario, $this->cliente, $this->tecnico, $this->descricao, $this->tipo, $this->rat, $this->data, $this->inicio);        

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

    public function selecionaTecnico()
    {
        $id_cliente = $_POST['id_data'];

        $rowCliente = $this->readClienteByID($id_cliente);
        foreach ($rowCliente as $key => $cliente) {
            
        }

        $rowTecnicos = $this->listarTecnicosPorRegiao($cliente['cidade']);
        

        if ($rowTecnicos == null) {
            echo '<option class="text-muted" value="0">Nenhum Técnico Disponível na Região</option>';
        } else {
            foreach ($rowTecnicos as $key => $tecnico) {
                echo '<option value="'.$tecnico['id'].'">' . $tecnico['nome'] . '</option>';
            }
        }
    }

    public function visualizar()
    {
        $this->recuperarVar();
        $rowRead = $this->readChamadoById($this->id);
        foreach ($rowRead as $key => $readChamado) {
            
        }

        
        $rowCliente = $this->readClienteByID($readChamado['cliente_id']);
        foreach ($rowCliente as $key => $cliente) {
            # code...
        }

        $rowTecnico = $this->readTecnicoByID($readChamado['tecnico_id']);
        foreach ($rowTecnico as $key => $tecnico) {
            # code...
        }        
        
        $rowUsuario = $this->readUsuarioByID($readChamado['usuario_id']);
        foreach ($rowUsuario as $key => $usuario) {
            # code...
        }
        
        
        echo
            '<form>
                <div class="d-flex mb-2 justify-content-between p-0">
                    <div class="form-group col-2">
                        <label>Codigo</label>    
                        <input id="id_chamado" class="form-control form-control-sm text-end" disabled value="' . $this->id . '">          
                    </div>
                    <div class="form-group col-10 text-end">
                        <label>Descrição</label>    
                        <input id="nome_fantasia" class="form-control form-control-sm text-end" disabled value="' .$readChamado['descricao'].'">                              
                    </div>        
                </div>
                <div class="d-flex justify-content-between col-12">                    
                    <p><i class="fas fa-calendar-alt text-primary"></i> Cadastrado em: ' . date("d/m/Y", strtotime($readChamado['data_cadastro'])) . ' por: <span class="badge badge-info">'.$usuario['nome'].'</span></p>
                    <p><i class="fas fa-calendar-alt text-primary"></i> Agendado para: <span class="badge badge-secondary">' . date("d/m/Y", strtotime($readChamado['data_cadastro'])).'</span></p>                                    
                </div>
                <hr>
                <div class="d-flex mb-2 justify-content-between p-0">
                    <div class="form-group col-3">
                        <label>Codigo</label>    
                        <input id="id_chamado" class="form-control form-control-sm text-end" disabled value="' . $this->id . '">          
                    </div>
                    <div class="form-group col-9 text-end">
                        <label>Cliente</label>    
                        <input id="nome_fantasia" class="form-control form-control-sm text-end" disabled value="' .$readChamado['cliente_id'].' - '. $cliente['nome_fantasia'] . '">                              
                    </div>        
                </div>
                <div class="d-flex mb-2 justify-content-between">
                    <div class="form-group col-6 mb-2">
                        <label>Cidade</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['cidade'] . '">
                    </div>
                    <div class="form-group col-2 mb-2">
                        <label>UF</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['uf'] . '">
                    </div>
                    <div class="form-group col-4 mb-2">
                        <label>Bairro</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['bairro'] . '"></div>
                </div>
                <div class="d-flex mb-2 justify-content-between">
                    <div class="form-group col-8 mb-2">
                        <label>Logradouro</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['logradouro'] . '">
                    </div>
                    <div class="form-group col-4 mb-2">
                        <label>Cep</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['cep'] . '">  
                    </div>
                </div>
                <hr>   
                <div class="d-flex mb-2 justify-content-between">
                    <div class="form-group col-8 mb-2">
                        <label>Técnico</label>    
                        <input class="form-control form-control-sm " disabled value="' . $readChamado['tecnico_id'].' - '.$tecnico['nome'].'">
                    </div>
                    <div class="form-group col-4 mb-2">
                        <label>Tipo</label>    
                        <input class="form-control form-control-sm " disabled value="' . $readChamado['tipo'] . '">  
                    </div>
                </div> 
                <hr>
                <div class="d-flex mb-0 justify-content-end">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="botao-iniciar" value="'.$readChamado['id'].'"><i class="fa fa-wrench"> </i> Iniciar Serviço</button>						
                        <a href="imprimir/chamado?id='. $readChamado['id'] .'" class="btn btn-info"><i class="fa fa-file-pdf"></i> PDF</a>
                        <button type="button" class="btn btn-info" id="botao-reagendar"><i class="fa fa-clock"> </i> Reagendar</button>
						<button type="button" class="btn btn-danger"><i class="fa fa-trash"> </i> Cancelar</button>
                    </div>
                </div> 
            </form>';
    }

     public function visualizarExecucao()
    {
        $this->recuperarVar();
        $rowRead = $this->readChamadoById($this->id);
        foreach ($rowRead as $key => $readChamado) {
            
        }

        
        $rowCliente = $this->readClienteByID($readChamado['cliente_id']);
        foreach ($rowCliente as $key => $cliente) {
            # code...
        }

        $rowTecnico = $this->readTecnicoByID($readChamado['tecnico_id']);
        foreach ($rowTecnico as $key => $tecnico) {
            # code...
        }        
        
        $rowUsuario = $this->readUsuarioByID($readChamado['usuario_id']);
        foreach ($rowUsuario as $key => $usuario) {
            # code...
        }
        
        
        echo
            '<form>
                <div class="d-flex mb-2 justify-content-between p-0">
                    <div class="form-group col-2">
                        <label>Codigo</label>    
                        <input id="id_chamado" class="form-control form-control-sm text-end" disabled value="' . $this->id . '">          
                    </div>
                    <div class="form-group col-10 text-end">
                        <label>Descrição</label>    
                        <input id="nome_fantasia" class="form-control form-control-sm text-end" disabled value="' .$readChamado['descricao'].'">                              
                    </div>        
                </div>
                <div class="d-flex justify-content-between col-12">                    
                    <p><i class="fas fa-calendar-alt text-primary"></i> Cadastrado em: ' . date("d/m/Y", strtotime($readChamado['data_cadastro'])) . ' por: <span class="badge badge-info">'.$usuario['nome'].'</span></p>
                    <p><i class="fas fa-calendar-alt text-primary"></i> Agendado para: <span class="badge badge-secondary">' . date("d/m/Y", strtotime($readChamado['data_cadastro'])).'</span></p>                                    
                </div>
                <hr>
                <div class="d-flex mb-2 justify-content-between p-0">
                    <div class="form-group col-3">
                        <label>Codigo</label>    
                        <input id="id_chamado" class="form-control form-control-sm text-end" disabled value="' . $this->id . '">          
                    </div>
                    <div class="form-group col-9 text-end">
                        <label>Cliente</label>    
                        <input id="nome_fantasia" class="form-control form-control-sm text-end" disabled value="' .$readChamado['cliente_id'].' - '. $cliente['nome_fantasia'] . '">                              
                    </div>        
                </div>
                <div class="d-flex mb-2 justify-content-between">
                    <div class="form-group col-6 mb-2">
                        <label>Cidade</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['cidade'] . '">
                    </div>
                    <div class="form-group col-2 mb-2">
                        <label>UF</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['uf'] . '">
                    </div>
                    <div class="form-group col-4 mb-2">
                        <label>Bairro</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['bairro'] . '"></div>
                </div>
                <div class="d-flex mb-2 justify-content-between">
                    <div class="form-group col-8 mb-2">
                        <label>Logradouro</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['logradouro'] . '">
                    </div>
                    <div class="form-group col-4 mb-2">
                        <label>Cep</label>    
                        <input class="form-control form-control-sm " disabled value="' . $cliente['cep'] . '">  
                    </div>
                </div>
                <hr>   
                <div class="d-flex mb-2 justify-content-between">
                    <div class="form-group col-8 mb-2">
                        <label>Técnico</label>    
                        <input class="form-control form-control-sm " disabled value="' . $readChamado['tecnico_id'].' - '.$tecnico['nome'].'">
                    </div>
                    <div class="form-group col-4 mb-2">
                        <label>Tipo</label>    
                        <input class="form-control form-control-sm " disabled value="' . $readChamado['tipo'] . '">  
                    </div>
                </div> 
                <hr>
                <div class="d-flex mb-0 justify-content-end">
                    <div class="form-group">
                        <button type="button" data-toggle="modal" data-target="#modal-informar-termino" class="btn btn-primary" id="botao-servico-finalizado" value="'.$readChamado['id'].'"><i class="fa fa-check"> </i> Serviço Finalizado</button>						                        
                        <button type="button" data-toggle="modal" data-target="#modal-informar-nao-termino" class="btn btn-warning" id="botao-nao-finalizado" value="'.$readChamado['id'].'"><i class="fa fa-clock"> </i> Não Finalizado</button>
						
                    </div>
                </div> 
            </form>';
    }  

    public function iniciarChamado()
    {
        $this->recuperarVar();

        $update = $this->iniciarChamadoDAO($this->id);

        echo $update;
    }

    public function finalizarChamado()
    {
        $this->recuperarVar();
        $rowRead = $this->readChamadoById($this->id);
        foreach ($rowRead as $key => $readChamado) {}   

        $inicio = new DateTime($readChamado['hora_inicio']);
        
        echo
            '<form>
                <div class="form-row">
                    <input type="hidden" value="'.$readChamado['tecnico_id'].'" id="tecnico-id">
                    <input type="hidden" value="'.$readChamado['usuario_id'].'" id="usuario-id">
                    <div class="form-group col">
                        <label>Id Chamado</label>    
                        <input type="text" id="id-chamado" class="form-control form-control-sm text-end" value="'.$this->id.'" disabled>                                  
                    </div>       
                    <div class="form-group col">                        
                        <label>Código Chamado</label>    
                        <input type="text" id="codigo-chamado" class="form-control form-control-sm text-end">                         
                    </div>           
                    <div class="form-group col">
                        <label>Número RAT</label>    
                        <input type="text" id="numero-rat" class="form-control form-control-sm text-end">                    
                    </div>     
                </div>
                <input type="hidden" id="id-chamado-finalizar" value="'.$this->id.'">
                <div class="form-row">
                    <div class="form-group col">
                        <label>Iniciado em:</label>    
                        <input type="time" id="hora-inicio" class="form-control form-control-sm text-end" value="' .  $inicio->format("H:i"). '">    
                    </div>       
                    <div class="form-group col">                        
                        <label>Finalizado em:</label>    
                        <input type="time" id="hora-termino" class="form-control form-control-sm text-end">                         
                    </div>                     
                    <button class="btn btn-success" id="botao-calcular"> <i class="fa fa-calculator"></i></button>      
                </div>
                
                <hr>
                <div class="form-row">
                    <div class="form-group col">
                        <label>Valor Técnico</label>    
                        <input type="text" id="valor-tecnico" class="form-control form-control-sm text-end">                                  
                    </div>       
                    <div class="form-group col">                        
                        <label>Valor Peças</label>    
                        <input type="text" id="valor-pecas" class="form-control form-control-sm text-end">                         
                    </div>  
                    <div class="form-group col">
                        <label>Custos Adicionais</label>    
                        <input type="text" id="custos-adicionais" class="form-control form-control-sm text-end">                                  
                    </div>       
                    <button class="btn btn-success" id="botao-calcular-valor"> <i class="fa fa-calculator"></i></button>                                         
                </div>
                <hr>   
                <div class="form-row">   
                    <div class="form-group col">                    
                        <label>Tempo Total</label>    
                        <input type="text" id="tempo-total" class="form-control form-control-sm" disabled>     
                    </div>    
                    <div class="form-group col">                    
                        <label>Valor Total</label>    
                        <input type="text" id="valor-total" class="form-control form-control-sm text-end" disabled>     
                    </div>                              
                </div>
            </form>
            ';
 
    }

    public function naoFinalizar()
    {
        $this->recuperarVar();
        $rowRead = $this->readChamadoById($this->id);
        foreach ($rowRead as $key => $readChamado) {}           
        
        echo
            '<form>                
                <div class="form-row">
                    <div class="form-group col">
                        <label>ID Chamado</label>    
                        <input type="text" id="id-chamado" class="form-control form-control-sm text-end" value="'.$this->id.'" disabled>
                    </div>       
                    <div class="form-group col">                        
                        <label>Código Chamado</label>    
                        <input type="text" id="codigo-chamado" class="form-control form-control-sm text-end">
                    </div>                                         
                </div>
                <div class="form-group">
                    <label>Observações</label>    
                    <textarea class="form-control" style="resize:none;"></textarea>                    
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label>Custos Adicionais</label>    
                        <input type="text" id="custos-adicionais" class="form-control form-control-sm text-end">                                  
                    </div>  
                </div>
                <hr>
                <button class="btn btn-primary"><i class="fa fa-copy"></i> Duplicar</button>                
                <button class="btn btn-primary"><i class="fa fa-cogs"></i> Cadastrar como Peça</button>                
            </form>
            ';
    }

    public function calculaTempo(){
        $tempoInicio = $_POST['tempo_inicio'];
        $tempoTermino = $_POST['tempo_termino'];
        $tempoInicio .= ':00';
        $tempoTermino .= ':00';

        $horaInicio = DateTime::createFromFormat('H:s:s', $tempoInicio);
        $horaTermino = DateTime::createFromFormat('H:i:s', $tempoTermino);       

        $intervalo = $horaInicio->diff($horaTermino);        
        echo $intervalo->format("%H:%I");        
    }

    public function calculaValor(){
        $valorTecnico = doubleval($_POST['valorTecnico']);
        $valorPecas = doubleval($_POST['valorPecas']);
        $custosAdicionais = doubleval($_POST['custosAdicionais']);        

        $valorTotal = $valorTecnico + $valorPecas + $custosAdicionais;
        echo $valorTotal;    
    }

    public function finalizar(){       

        $this->recuperarVar();

        $codigoChamado = $_POST['codigo']; 
        $numeroRat = $_POST['numero_rat'];
        $horaTermino = $_POST['horaTermino'];
        $tempoTotal = $_POST['tempoTotal'];
        $valorTecnico = $_POST['valorTecnico'];
        $valorPecas = $_POST['valorPecas'];
        $valorTotal = $_POST['valorTotal'];
        $custosAdicionais = $_POST['custosAdicionais'];        
        $tecnico_id = $_POST['tecnico_id'];
        $usuario_id = $_POST['usuario_id'];

        $update = $this->finalizarChamadoDAO($this->id, $codigoChamado, $numeroRat, $horaTermino, $tempoTotal, $valorTecnico, $valorPecas, $custosAdicionais, $valorTotal);

        $data = date("Y-m-d");
        $hora = date("H:i:s");
        $chave = md5(time());


        //$usuario_id = $_SESSION['id'];
        $movimentacao2 = $this->createMovimentacao($codigoChamado, "A RECEBER",$valorTotal, "PAGAMENTO SERVIÇO", $data, $hora, $chave, $tecnico_id, $usuario_id);
        $movimentacao1 = $this->createMovimentacao($codigoChamado, "A PAGAR",  $valorTecnico, "PAGAMENTO TÉCNICO", $data, $hora, $chave, $tecnico_id, $usuario_id);       
        
    }
}
