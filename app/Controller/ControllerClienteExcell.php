<?php
namespace App\Controller;

use App\Model\ClassCliente;

class ControllerClienteExcell extends ClassCliente{    

    use \Src\Traits\TraitUrlParser;
    
    public function __construct(){ 

        $this->cliente();
        
    }  

    public function cliente(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $hash = time();
        $arquivo = "clientes".$hash.".xls";
        
        $html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Relação de Clientes Cadastrados</td>';
		$html .= '</tr>';
		
		$html .= '<tr>';		
		$html .= '<td><b>ID</b></td>';		
		$html .= '<td><b>Razão Social</b></td>';		
        $html .= '<td><b>Nome Fantasia</b></td>';
        $html .= '<td><b>CNPJ</b></td>';
		$html .= '<td><b>Inscricao Estadual</b></td>';
		$html .= '<td><b>Email</b></td>';
        $html .= '<td><b>Cep</b></td>';
        $html .= '<td><b>Logradouro</b></td>';
        $html .= '<td><b>Bairro</b></td>';
        $html .= '<td><b>Cidade</b></td>';
        $html .= '<td><b>UF</b></td>';
        $html .= '<td><b>Telefone1</b></td>';
        $html .= '<td><b>Telefone2</b></td>';
		$html .= '</tr>';

        $rowClientes = $this->listarClientesAtivosCompleto();
        if ($rowClientes == null) {
            $html .= '<tr>';
            $html .= '<td>NENHUM DADO A SER MOSTRADO</td>';
            $html .= '</tr>';            
        }else{
            foreach ($rowClientes as $key => $cliente) {
                $html .= '<tr>';
                $html .= '<td>'.$cliente['id'].'</td>';
                $html .= '<td>'.$cliente['razao_social'].'</td>';
                $html .= '<td>'.$cliente['nome_fantasia'].'</td>';
                $html .= '<td>'.$cliente['cnpj'].'</td>';
                $html .= '<td>'.$cliente['inscricao_estadual'].'</td>';
                $html .= '<td>'.$cliente['email'].'</td>';
                $html .= '<td>'.$cliente['cep'].'</td>';
                $html .= '<td>'.$cliente['logradouro'].'</td>';
                $html .= '<td>'.$cliente['bairro'].'</td>';
                $html .= '<td>'.$cliente['cidade'].'</td>';
                $html .= '<td>'.$cliente['uf'].'</td>';
                $html .= '<td>'.$cliente['telefone'].'</td>';
                $html .= '<td>'.$cliente['telefone_2'].'</td>';
                $html .= '</tr>';            
            }            
        }

		$html .= '</table>';

        // Configurações header para forçar o download
		header ("Expires: Mon, 07 Jul 2016 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
        
		echo utf8_decode($html);
		exit;
    }     
}
