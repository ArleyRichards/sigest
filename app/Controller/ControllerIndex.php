<?php
namespace App\Controller;

use Src\Classes\ClassRender;
use App\Model\ClassCliente;
use Src\Interfaces\InterfaceView;
use Src\Classes\ClassPagination;
use Src\Traits\TraitUrlParser;

class ControllerIndex extends ClassRender implements InterfaceView {

    use TraitUrlParser;

    public function __construct()
    {
        
        $this->index();
           
    }

    public function index()
    {        
        if (count($this->parseUrl()) == 1) {
            $this->setTitle("Painel Administrativo | Clientes");
            $this->setDescription("Painel de Controle de Clientes");
            $this->setKeywords("Controle de Clientes");
            $this->setDir("home");             
            $this->renderLayout();

            if(isset($_GET['msg'])){
                if($_GET['msg'] == 'create_success'){
                    echo '<script>toastr["success"]("Cliente Cadastrado com Sucesso!");</script>';
                }else if($_GET['msg'] == 'account_added'){
                    echo '<script>toastr["success"]("Dados bancários atualizados!");</script>';
                }else if($_GET['msg'] == 'update_success'){
                    echo '<script>toastr["success"]("Dados atualizados!");</script>';
                }
            }
        }else{  
            $this->setDir("home");            
            $this->renderLayout();          
        }
    }

    public function cadastro()
    {
        $cliente = new ClassCliente();
        if (count($this->parseUrl()) == 2) {
            $this->setTitle("Painel Administrativo | Clientes");
            $this->setDescription("Painel de Controle de Clientes");
            $this->setKeywords("Controle de Clientes");
            $this->setDir("form-cliente");

            //$Render->setDados($dados);
            $this->renderLayout();
        }
        $this->setDir("cliente");
        $this->renderLayout();
    }

    public function editar()
    {
        
        $tecnico = new ClassCliente();
        if (count($this->parseUrl()) == 2) {
            if (isset($_GET['id'])) {
                $dados = $this->detalhes($_GET['id']);
                $this->setData($dados);

                $this->setTitle("Painel Administrativo | Clientes");
                $this->setDescription("Painel de Controle de Clientes");
                $this->setKeywords("Controle de Clientes");
                $this->setDir("form-cliente-edit");
                $this->renderLayout();
            } else {
                $this->setDir("cliente");
                $this->renderLayout();
            }
        }
        $this->setDir("cliente");
        $this->renderLayout();
    }

    public function salvar()
    {
        $razao = $_POST['razao'];
        $fantasia = $_POST['fantasia'];
        $cnpj = $_POST['cnpj'];      
        $inscricao = $_POST['inscricao'];
        $email = $_POST['email'];  
        $telefone1 = $_POST['telefone1'];
        $telefone2 = $_POST['telefone2'];        
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $logradouro = $_POST['logradouro'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];

        $cliente = new ClassCliente();
        $result = $cliente->createCliente($razao, $fantasia, $cnpj, $inscricao, $email, $telefone1, $telefone2, $cidade, $uf, $logradouro, $bairro, $cep);
        if($result != null){
            //var_dump($result);
            header('Location: ../cliente?msg=create_success');
        }

    }

    public function detalhes($id)
    {
        $cliente = new ClassCliente();
        $rowCliente = $cliente->readCliente($id);
        return $rowCliente;
    }

    public function atualizar()
    {
        $id = $_POST['id'];
        $razao = $_POST['razao'];
        $fantasia = $_POST['fantasia'];
        $cnpj = $_POST['cnpj'];      
        $inscricao = $_POST['inscricao'];
        $email = $_POST['email'];  
        $telefone1 = $_POST['telefone1'];
        $telefone2 = $_POST['telefone2'];        
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $logradouro = $_POST['logradouro'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];

        $cliente = new ClassCliente();
        $result = $cliente->updateCliente($id, $razao, $fantasia, $cnpj, $inscricao, $email, $telefone1, $telefone2, $cidade, $uf, $logradouro, $bairro, $cep);
        if($result != null){
            //var_dump($result);
            header('Location: ../cliente?msg=update_success');
        }
    }  
}
?>