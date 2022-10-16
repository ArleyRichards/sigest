<?php
namespace App\Controller;

use App\Model\ClassTecnico;

class ControllerTecnicoExcell extends ClassTecnico{    

    use \Src\Traits\TraitUrlParser;
    
    public function __construct(){ 

        $this->tecnico();
        
    }  

    public function tecnico(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $hash = time();
        $arquivo = "clientes".$hash.".xls";
        
        $html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Relação de Técnicos Cadastrados</td>';
		$html .= '</tr>';
		
		$html .= '<tr>';		
		$html .= '<td><b>ID</b></td>';		
		$html .= '<td><b>Nome</b></td>';		
        $html .= '<td><b>CPF</b></td>';
        $html .= '<td><b>RG</b></td>';
        $html .= '<td><b>Nascimento</b></td>';
		$html .= '<td><b>Telefone</b></td>';
		$html .= '<td><b>Email</b></td>';
        $html .= '<td><b>Cidade</b></td>';
        $html .= '<td><b>Bairro</b></td>';
        $html .= '<td><b>Logradouro</b></td>';
        $html .= '<td><b>UF</b></td>';
        $html .= '<td><b>Cep</b></td>';
		$html .= '</tr>';

        $rowTecnicos = $this->listarTecnicosAtivosCompleto();
        if ($rowTecnicos == null) {
            $html .= '<tr>';
            $html .= '<td>NENHUM DADO A SER MOSTRADO</td>';
            $html .= '</tr>';            
        }else{
            foreach ($rowTecnicos as $key => $tecnico) {
                $html .= '<tr>';
                $html .= '<td>'.$tecnico['id'].'</td>';
                $html .= '<td>'.$tecnico['nome'].'</td>';
                $html .= '<td>'.$tecnico['cpf'].'</td>';
                $html .= '<td>'.$tecnico['rg'].'</td>';
                $html .= '<td>'.$tecnico['nascimento'].'</td>';
                $html .= '<td>'.$tecnico['telefone'].'</td>';
                $html .= '<td>'.$tecnico['email'].'</td>';
                $html .= '<td>'.$tecnico['cidade'].'</td>';
                $html .= '<td>'.$tecnico['bairro'].'</td>';
                $html .= '<td>'.$tecnico['logradouro'].'</td>';
                $html .= '<td>'.$tecnico['uf'].'</td>';
                $html .= '<td>'.$tecnico['cep'].'</td>';                
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
