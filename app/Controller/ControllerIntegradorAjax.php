<?php

namespace App\Controller;

use App\Model\ClassCliente;
use App\Model\ClassIntegrador;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerIntegradorAjax extends ClassIntegrador
{
    use TraitUrlParser;

    public $id;
    public $nome;        
    public $cidade;
    public $bairro;
    public $logradouro;
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
        if (isset($_POST['nome'])) {
            $this->nome = filter_input(INPUT_POST, 'nome');
        }
        if (isset($_POST['bairro'])) {
            $this->bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
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
        if (isset($_POST['uf'])) {
            $this->uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
        }
        if (isset($_POST['cep'])) {
            $this->cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
        }
    }   

    public function cadastro()
    {
        $this->recuperarVar();        
        
        $create = $this->createIntegradora($this->nome, $this->cidade, $this->bairro, $this->logradouro, $this->uf, $this->cep);        

        echo $create;
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
}
