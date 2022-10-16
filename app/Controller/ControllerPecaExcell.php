<?php
namespace App\Controller;

use App\Model\ClassPecas;
use App\Model\ClassTecnico;

class ControllerPecaExcell extends ClassPecas{    

    use \Src\Traits\TraitUrlParser;
    
    public function __construct(){ 

        $this->peca();
        
    }  

    public function peca(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $hash = time();
        $arquivo = "pecas".$hash.".xls";
        
        $html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Relação de Peças Cadastradas</td>';
		$html .= '</tr>';
		
		$html .= '<tr>';		
		$html .= '<td><b>ID</b></td>';		
		$html .= '<td><b>CODIGO</b></td>';		
        $html .= '<td><b>DESCRICAO</b></td>';
        $html .= '<td><b>VALOR UNITARIO</b></td>';
        $html .= '<td><b>QUANTIDADE</b></td>';
		$html .= '</tr>';

        $rowTecnicos = $this->listarPecasCompleto();
        if ($rowTecnicos == null) {
            $html .= '<tr>';
            $html .= '<td>NENHUM DADO A SER MOSTRADO</td>';
            $html .= '</tr>';            
        }else{
            foreach ($rowTecnicos as $key => $tecnico) {
                $html .= '<tr>';
                $html .= '<td>'.$tecnico['id'].'</td>';
                $html .= '<td>'.$tecnico['codigo'].'</td>';
                $html .= '<td>'.$tecnico['descricao'].'</td>';
                $html .= '<td>'.$tecnico['valor_unitario'].'</td>';
                $html .= '<td>'.$tecnico['quantidade'].'</td>';                
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
