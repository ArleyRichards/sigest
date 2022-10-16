<?php

namespace App\Controller;

use App\Model\ClassChamado;
use Dompdf\Dompdf;
use Dompdf\Options;

class ControllerImprimir extends ClassChamado
{

    use \Src\Traits\TraitUrlParser;

    public function __construct()
    {
    }

    public function chamado()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $opcoes = new Options();
        $opcoes->setChroot(__DIR__);
        $opcoes->setIsRemoteEnabled(true);

        $html = $this->formataHTML($id);

        $documento = new Dompdf($opcoes);

        $documento->loadHtml($html);

        $documento->setPaper('A4', 'portrait');
        $documento->render();

        Header('Content-type: application/pdf');
        echo $documento->output();
    }

    public function formataHTML($id)
    {

        $rowChamado = $this->readChamadoByID($id);
        foreach ($rowChamado as $key => $chamado) {
        }

        $rowCliente = $this->readClienteByID($chamado['cliente_id']);
        foreach ($rowCliente as $key => $cliente) {
        }

        $rowTecnico = $this->readTecnicoByID($chamado['tecnico_id']);
        foreach ($rowTecnico as $key => $tecnico) {
        }
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
                #conteudo table th{
                    border: solid 1px #ccc;                   
                    padding: 2px;                    
                }
                table th{
                    text-align: left;
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
                                <p>Chamado Nº: #<strong>' . $id . '</strong></p>                                
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        <div id="conteudo">
            
        <h3>Informações do Cliente</h3>
        <div class="container-tabela">
            <table>
                <tr>
                    <td>Razão Social: </td>
                    <th>[' . $cliente['id'] . '] ' . $cliente['nome_fantasia'] . '</th>
                    <td>CNPJ: </td>
                    <th>' . $cliente['cnpj'] . '</th>
                </tr>   
                <tr>
                    <td>Cidade: </td>
                    <th>' . $cliente['cidade'] . '</th>
                    <td>UF: </td>
                    <th>' . $cliente['uf'] . '</th>
                </tr>     
                <tr>
                    <td>Endereço: </td>
                    <th>' . $cliente['logradouro'] . '</th>
                    <td>Bairro: </td>
                    <th>' . $cliente['bairro'] . '</th>
                </tr>       
                <tr>
                    <td>Email: </td>
                    <th>' . $cliente['email'] . '</th>
                    <td>Telefone: </td>
                    <th>' . $cliente['telefone'] . '</th>
                </tr>          
            </table>
        </div>
        <br>

        <h3>Informações do Técnico</h3>
        <div class="container-tabela">
            <table>
                <tr>
                    <td>Nome: </td>
                    <th>[' . $tecnico['id'] . '] ' . $tecnico['nome'] . '</th>
                    <td>CPF: </td>
                    <th>' . $tecnico['cpf'] . '</th>
                </tr>   
                <tr>
                    <td>Cidade: </td>
                    <th>' . $tecnico['cidade'] . '</th>
                    <td>UF: </td>
                    <th>' . $tecnico['uf'] . '</th>
                </tr>     
                <tr>
                    <td>Email: </td>
                    <th>' . $tecnico['email'] . '</th>
                    <td>Telefone: </td>
                    <th>' . $tecnico['telefone'] . '</th>
                </tr>                
            </table>
        </div>
        <br>
        <h3>Informações do Chamado</h3>
        <div class="container-tabela">
            <table>
                <tr>
                    <td>Descrição: </td>
                    <th>[' . $chamado['id'] . '] ' . $chamado['descricao'] . '</th>
                    <td>Data Cadastro: </td>
                    <th>' . date("d-m-Y",strtotime($chamado['data_cadastro'])) . '</th>
                </tr>   
                <tr>
                    <td>Tipo: </td>
                    <th>' . $chamado['tipo'] . '</th>
                    <td>Data Agendamento: </td>
                    <th>' . date("d-m-Y",strtotime($chamado['data_agendamento'])) . '</th>
                </tr>     
                <tr>            
            </table>
        </div>
	    ';

        $html .= '</div>';
        return $html;
    }
}
