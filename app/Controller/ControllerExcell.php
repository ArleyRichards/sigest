<?php
namespace App\Controller;

use App\Model\ClassChamado;

class ControllerExcell extends ClassChamado{    

    use \Src\Traits\TraitUrlParser;
    
    public function __construct(){ 

        $this->chamado();
        
    }  

    public function chamado(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $hash = time();
        $arquivo = "agendados".$hash.".xls";
        
        $html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Relação de Chamados Agendados por período:</td>';
		$html .= '</tr>';
		
		$html .= '<tr>';
		$html .= '<td><b>COD</b></td>';
		$html .= '<td><b>Cliente</b></td>';
		$html .= '<td><b>Técnico</b></td>';
        $html .= '<td><b>Data_Cadastro</b></td>';
        $html .= '<td><b>Data_Agendamento</b></td>';
		$html .= '<td><b>Hora_Inicio</b></td>';
		$html .= '<td><b>Hora_Fim</b></td>';
        $html .= '<td><b>Tempo_total</b></td>';
        $html .= '<td><b>Tipo</b></td>';
        $html .= '<td><b>Descricao</b></td>';
        $html .= '<td><b>RAT_entregue</b></td>';
        $html .= '<td><b>Numero_RAT</b></td>';
        $html .= '<td><b>Valor_Tecnico</b></td>';
        $html .= '<td><b>Valor_Pecas</b></td>';
        $html .= '<td><b>Custos_Adicionais</b></td>';
        $html .= '<td><b>Valor_Total</b></td>';
		$html .= '</tr>';

        $rowChamados = $this->listarChamadosAgendadosCompleto();
        foreach ($rowChamados as $key => $chamado) {
            $html .= '<tr>';
            $html .= '<td>'.$chamado['id'].'</td>';
            $html .= '<td>'.$chamado['cliente_id'].'</td>';
            $html .= '<td>'.$chamado['tecnico_id'].'</td>';
            $html .= '<td>'.$chamado['data_cadastro'].'</td>';
            $html .= '<td>'.$chamado['data_agendamento'].'</td>';
            $html .= '<td>'.$chamado['hora_inicio'].'</td>';
            $html .= '<td>'.$chamado['hora_final'].'</td>';
            $html .= '<td>'.$chamado['hora_total'].'</td>';
            $html .= '<td>'.$chamado['tipo'].'</td>';
            $html .= '<td>'.$chamado['descricao'].'</td>';
            $html .= '<td>'.$chamado['rat_entregue'].'</td>';
            $html .= '<td>'.$chamado['numero_rat'].'</td>';
            $html .= '<td>'.$chamado['valor_tecnico'].'</td>';
            $html .= '<td>'.$chamado['valor_pecas'].'</td>';
            $html .= '<td>'.$chamado['valor_adicional'].'</td>';
            $html .= '<td>'.$chamado['valor_total'].'</td>';
            $html .= '</tr>';            
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
