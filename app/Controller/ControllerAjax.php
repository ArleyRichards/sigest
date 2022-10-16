<?php
namespace App\Controller;

use App\Model\ClassVendedor;
use App\Model\ClassRegiao;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Traits\TraitUrlParser;

class ControllerAjax extends ClassVendedor{

    use TraitUrlParser;

    public function __construct(){
        
    }

    public function listarGerentes(){        
        $vetor = array('Santo André', 'São Bernardo', 'São Caetano');
        return $vetor;
    }

    public function listarVendedores(){
        $id_gerente = $_POST['id_gerente'];   
        $vendedor = $this->listarVendedoresPorGerente($id_gerente);
        echo
        '<table class="table table-sm table-bordered">
        <thead>
          <tr>
            <th scope="col">Vendedor</th>
            <th scope="col">Saldo Anterior</th>
            <th scope="col">Entradas</th>
            <th scope="col">Saídas</th>
            <th scope="col">Créditos</th>
            <th scope="col">Débitos</th>
            <th scope="col">Saldo</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($vendedor as $chave => $v) {
            echo '<tr>
            <td>'.$v['nome'].'</td>
            <td>R$ 0,00</td>
            <td>R$ 0,00</td>
            <td>R$ 0,00</td>
            <td>R$ 0,00</td>
            <td>R$ 0,00</td>
            <td>R$ 0,00</td>
            <td>
                <button class="bg-success text-light rounded">Creditar</button>
                <button class="bg-danger text-light rounded">Debitar</button>
            </td>
          </tr>';
        }
        echo'</tbody>
      </table>

        ';
    }

    public function listarRegioesAtivas(){
      $Regiao = new ClassRegiao();

    }
      
  
}

?>
