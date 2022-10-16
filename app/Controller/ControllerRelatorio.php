<?php

namespace App\Controller;

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;
use App\Model\ClassRelatorio;
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Cpdf;

class ControllerRelatorio extends ClassRender implements InterfaceView
{

    use TraitUrlParser;


    public function __construct()
    {
        session_start();
        if (count($this->parseUrl()) == 1) {
            if (isset($_SESSION['login'])) {
                $this->index();
            }
        }
    }

    public function index()
    {
        //$tecnico = new ClassTecnico();
        //$result = $tecnico->listarTecnicosAtivosCompleto();
        if (count($this->parseUrl()) == 1) {
            $this->setTitle("Painel Administrativo | Técnicos");
            $this->setDescription("Painel de Controle de Técnicos");
            $this->setKeywords("Controle de Técnicos");
            $this->setDir("relatorio");
            //$this->setData($result);
            $this->renderLayout();

            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'undefined_id') {
                    echo '<script>toastr["success"]("O Relatório não foi Informado");                        
                        </script>';
                } else if ($_GET['msg'] == 'account_added') {
                    echo '<script>toastr["success"]("Dados bancários atualizados!");</script>';
                }
            }
        } else {
            $this->setDir("relatorio");
            $this->renderLayout();
        }
    }

    public function gerar()
    {
        if (isset($_POST['relatorio'])) {
            if ($_POST['relatorio'] == 0) {
                echo '<script> window.location.href = "../relatorio?msg=undefined_id" </script>';
            } else if ($_POST['relatorio'] == 1) {
                $this->relatorio1($_POST['data1'], $_POST['data2']);
            } else if ($_POST['relatorio'] == 2) {
                $this->relatorio2($_POST['data1'], $_POST['data2']);
            } else if ($_POST['relatorio'] == 3) {
                echo "Relatório 3 gerado com sucesso";
            } else if ($_POST['relatorio'] == 4) {
                echo "Relatório 4 gerado com sucesso";
            } else if ($_POST['relatorio'] == 5) {
                echo "Relatório 5 gerado com sucesso";
            } else if ($_POST['relatorio'] == 6) {
                echo "Relatório 6 gerado com sucesso";
            } else if ($_POST['relatorio'] == 7) {
                echo "Relatório 7 gerado com sucesso";
            } else {
                echo '<script> window.location.href = "../relatorio?msg=undefined_id" </script>';
            }
        } else {
            echo '<script> window.location.href = "../relatorio?msg=undefined_id" </script>';
        }
    }

    public function relatorio1($inicio, $final)
    {

        $opcoes = new Options();
        $opcoes->setChroot(__DIR__);
        $opcoes->setIsRemoteEnabled(true);

        $html = '<style>
				*{
					margin: 0;
					padding: 0;
					font-family: Arial, Helvetica, sans-serif;
					font-size: 11px;
				}
				#cabecalho{
					padding: 2%;
					border: solid 1px #ccc;
					background-color: #eee;
					display: block;

				}
				#cabecalho h1{
					font-size: 14px;
				}
				#cabecalho h2{
					font-size: 12px;
				}
				#cabecalho h3{
					font-size: 11px;
				}
				#logo{					
					border-radius: 50%;				
					height: 50px;
					width: 50px;
					display:block;
					text-align: left;
				}

				#texto{			
				}

                #conteudo{
                    display: flex;
                    padding: 2%;
                    margin-top: 10px;
                }
                #conteudo table{
                    width: 100%;
                    font-size: 11px;
                }
                #conteudo table td{
                    border: solid 1px #ccc;                   
                    padding: 2px;                    
                }

			
			</style>';


        //INSERÇÃO DO CABEÇALHO//
        $html .= '
            <div id="cabecalho">
                <table>
                    <tr>
                        <td>
                            <img id="logo" src="http://localhost/jmchamados/public/img/logo.jpg">
                        </td>
                        <td>	
                            <p style="width:8px"></p>
                        </td>	
                        <td>			
                            <div id="texto">
                                <h3>JM Chamados</h3>
                                <p>Sistema de Gestão de Chamados e Ordens de Serviço</p>
                                <p>Relatório de Chamados por Técnico</p>
                                <p>período: ' . date("d-m-Y", strtotime($inicio)) . ' a ' . date("d-m-Y", strtotime($final)) . '</p>			
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        <div id="conteudo">
	    ';
        $doc = new ClassRelatorio();
        $rowDados = $doc->consultaRelatorio1($inicio, $final);
        foreach ($rowDados as $key => $chamado) {
            $rowTecnico = $doc->readTecnico($chamado['tecnico_id']);
            $rowDados2 = $doc->consultaChamadoPorTecnico($chamado['tecnico_id']);
            $html .= '<h3>[' . $chamado['tecnico_id'] . '] - ' . $rowTecnico[0]['nome'] . '</h3>';

            $status = null;


            $html .= '<table style="border: solid 1px #ccc;padding: 1%;">
            <thead >
            <tr>
            <th>ID</th>
            <th>CODIGO</th>
            <th>CLIENTE</th>
            <th>DESCRIÇÃO</th>
            <th>STATUS</th>
            </tr>
            </thead>
            
            ';
            $html .= '<tbody>';
            foreach ($rowDados2 as $key => $chamado2) {
                if ($chamado2['status'] == 0) {
                    $status = 'AGENDADO';
                } else if ($chamado2['status'] == 1) {
                    $status = 'EXECUTANDO';
                } else if ($chamado2['status'] == 5) {
                    $status = 'FINALIZADO';
                }

                $rowCliente = $doc->readCliente($chamado['cliente_id']);
                $html .= '                         
                            <tr>
                                <td>' . $chamado2['id'] . '</td>
                                <td>' . $chamado2['codigo'] . '</td>                                
                                <td>[' . $chamado2['cliente_id'] . '] - ' . $doc->readCliente($chamado2['cliente_id'])[0]['nome_fantasia'] . '</td>
                                <td>' . $chamado2['descricao'] . '</td>
                                <td>' . $status . '</td>
                            </tr> 
                            ';
            }

            $html .= '</tbody></table><br>';
        }


        $relatorio = new Dompdf($opcoes);
        $relatorio->loadHtml($html);
        $relatorio->setPaper('A4', 'portrait');
        $relatorio->render();
        header('Content-type: Application/pdf');
        echo $relatorio->output();
    }

    public function relatorio2($inicio, $final)
    {

        $opcoes = new Options();
        $opcoes->setChroot(__DIR__);
        $opcoes->setIsRemoteEnabled(true);

        $html = '<style>
				*{
					margin: 0;
					padding: 0;
					font-family: Arial, Helvetica, sans-serif;
					font-size: 11px;
				}
				#cabecalho{
					padding: 2%;
					border: solid 1px #ccc;
					background-color: #eee;
					display: block;

				}
				#cabecalho h1{
					font-size: 14px;
				}
				#cabecalho h2{
					font-size: 12px;
				}
				#cabecalho h3{
					font-size: 11px;
				}
				#logo{					
					border-radius: 50%;				
					height: 50px;
					width: 50px;
					display:block;
					text-align: left;
				}

				#texto{			
				}

                #conteudo{
                    display: flex;
                    padding: 2%;
                    margin-top: 10px;
                }
                #conteudo table{
                    width: 100%;
                    font-size: 11px;
                }
                #conteudo table td{
                    border: solid 1px #ccc;                   
                    padding: 2px;                    
                }

			
			</style>';


        //INSERÇÃO DO CABEÇALHO//
        $html .= '
            <div id="cabecalho">
                <table>
                    <tr>
                        <td>
                            <img id="logo" src="http://localhost/jmchamados/public/img/logo.jpg">
                        </td>
                        <td>	
                            <p style="width:8px"></p>
                        </td>	
                        <td>			
                            <div id="texto">
                                <h3>JM Chamados</h3>
                                <p>Sistema de Gestão de Chamados e Ordens de Serviço</p>
                                <p>Relatório de Chamados por Cliente</p>
                                <p>período: ' . date("d-m-Y", strtotime($inicio)) . ' a ' . date("d-m-Y", strtotime($final)) . '</p>			
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        <div id="conteudo">
	    ';
        $doc = new ClassRelatorio();
        $rowDados = $doc->consultaRelatorio2($inicio, $final);
        foreach ($rowDados as $key => $chamado) {
            $rowCliente = $doc->readCliente($chamado['cliente_id']);
            $rowDados2 = $doc->consultaChamadoPorCliente($chamado['cliente_id']);
            $html .= '<h3>[' . $chamado['cliente_id'] . '] - ' . $rowCliente[0]['nome_fantasia'] . '</h3>';

            $status = null;


            $html .= '<table style="border: solid 1px #ccc;padding: 1%;">
            <thead >
            <tr>
            <th>ID</th>
            <th>CODIGO</th>
            <th>TECNICO</th>
            <th>DESCRIÇÃO</th>
            <th>STATUS</th>
            </tr>
            </thead>
            
            ';
            $html .= '<tbody>';
            foreach ($rowDados2 as $key => $chamado2) {
                if ($chamado2['status'] == 0) {
                    $status = 'AGENDADO';
                } else if ($chamado2['status'] == 1) {
                    $status = 'EXECUTANDO';
                } else if ($chamado2['status'] == 5) {
                    $status = 'FINALIZADO';
                }

                $rowTecnico = $doc->readTecnico($chamado['tecnico_id']);
                $html .= '                         
                            <tr>
                                <td>' . $chamado2['id'] . '</td>
                                <td>' . $chamado2['codigo'] . '</td>                                
                                <td>[' . $chamado2['tecnico_id'] . '] - ' . $doc->readTecnico($chamado2['tecnico_id'])[0]['nome'] . '</td>
                                <td>' . $chamado2['descricao'] . '</td>
                                <td>' . $status . '</td>
                            </tr> 
                            ';
            }

            $html .= '</tbody></table><br>';
        }


        $relatorio = new Dompdf($opcoes);
        $relatorio->loadHtml($html);
        $relatorio->setPaper('A4', 'portrait');
        $relatorio->render();
        header('Content-type: Application/pdf');
        echo $relatorio->output();
    }

    public function relatorio3($inicio, $final)
    {

        $opcoes = new Options();
        $opcoes->setChroot(__DIR__);
        $opcoes->setIsRemoteEnabled(true);

        $html = '<style>
				*{
					margin: 0;
					padding: 0;
					font-family: Arial, Helvetica, sans-serif;
					font-size: 11px;
				}
				#cabecalho{
					padding: 2%;
					border: solid 1px #ccc;
					background-color: #eee;
					display: block;

				}
				#cabecalho h1{
					font-size: 14px;
				}
				#cabecalho h2{
					font-size: 12px;
				}
				#cabecalho h3{
					font-size: 11px;
				}
				#logo{					
					border-radius: 50%;				
					height: 50px;
					width: 50px;
					display:block;
					text-align: left;
				}

				#texto{			
				}

                #conteudo{
                    display: flex;
                    padding: 2%;
                    margin-top: 10px;
                }
                #conteudo table{
                    width: 100%;
                    font-size: 11px;
                }
                #conteudo table td{
                    border: solid 1px #ccc;                   
                    padding: 2px;                    
                }

			
			</style>';


        //INSERÇÃO DO CABEÇALHO//
        $html .= '
            <div id="cabecalho">
                <table>
                    <tr>
                        <td>
                            <img id="logo" src="http://localhost/jmchamados/public/img/logo.jpg">
                        </td>
                        <td>	
                            <p style="width:8px"></p>
                        </td>	
                        <td>			
                            <div id="texto">
                                <h3>JM Chamados</h3>
                                <p>Sistema de Gestão de Chamados e Ordens de Serviço</p>
                                <p>Relatório de Chamados por Cidade</p>
                                <p>período: ' . date("d-m-Y", strtotime($inicio)) . ' a ' . date("d-m-Y", strtotime($final)) . '</p>			
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        <div id="conteudo">
	    ';
        $doc = new ClassRelatorio();
        $rowDados = $doc->consultaRelatorio2($inicio, $final);
        foreach ($rowDados as $key => $chamado) {
            $rowCliente = $doc->readCliente($chamado['cliente_id']);
            $rowDados2 = $doc->consultaChamadoPorCliente($chamado['cliente_id']);
            $html .= '<h3>[' . $chamado['cliente_id'] . '] - ' . $rowCliente[0]['nome_fantasia'] . '</h3>';

            $status = null;


            $html .= '<table style="border: solid 1px #ccc;padding: 1%;">
            <thead >
            <tr>
            <th>ID</th>
            <th>CODIGO</th>
            <th>TECNICO</th>
            <th>DESCRIÇÃO</th>
            <th>STATUS</th>
            </tr>
            </thead>
            
            ';
            $html .= '<tbody>';
            foreach ($rowDados2 as $key => $chamado2) {
                if ($chamado2['status'] == 0) {
                    $status = 'AGENDADO';
                } else if ($chamado2['status'] == 1) {
                    $status = 'EXECUTANDO';
                } else if ($chamado2['status'] == 5) {
                    $status = 'FINALIZADO';
                }

                $rowTecnico = $doc->readTecnico($chamado['tecnico_id']);
                $html .= '                         
                            <tr>
                                <td>' . $chamado2['id'] . '</td>
                                <td>' . $chamado2['codigo'] . '</td>                                
                                <td>[' . $chamado2['tecnico_id'] . '] - ' . $doc->readTecnico($chamado2['tecnico_id'])[0]['nome'] . '</td>
                                <td>' . $chamado2['descricao'] . '</td>
                                <td>' . $status . '</td>
                            </tr> 
                            ';
            }

            $html .= '</tbody></table><br>';
        }


        $relatorio = new Dompdf($opcoes);
        $relatorio->loadHtml($html);
        $relatorio->setPaper('A4', 'portrait');
        $relatorio->render();
        header('Content-type: Application/pdf');
        echo $relatorio->output();
    }
}
