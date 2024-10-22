<?php

class verdetalhesController extends Controller
{
  public function index($id)
  {
    if(isset($_POST['Salva-marcarComoPago']) && $_POST['Salva-marcarComoPago'] == 'Sim')
    {
      $up = new Update;
      $sel = new Read;
      
      if($_POST['tabela'] == 'entradas')
      {
        $dados2 = [
          'Status'=> 'Pago',
          'ParcelasPagas'=> 1
        ];
        $up->ExeUpdate('entradas', $dados2,'WHERE id = :id', "id={$_POST['IdContasPagar']}");
        if($up->getRowCount())
        {
          //echo " ParcelasPagas atualizadas,";
          //echo " Status atualizado";
        }
      }
      else{
        $dados = [
          'FaturaPaga'=> 1
        ];
        $up->ExeUpdate('parcelas',$dados,'WHERE id = :id', "id={$_POST['id']}");
        if($up->getRowCount())
        {
          //echo "Parcela foi paga,";
          $sel->FullRead("SELECT * FROM `entradas` WHERE `id` = {$_POST['IdContasPagar']}");
          $dados2 = [
            'ParcelasPagas' => $sel->getResult()[0]['ParcelasPagas'] +1
          ];

          $up->ExeUpdate('entradas', $dados2,"WHERE id = :id", "id={$_POST['IdContasPagar']}");
          if($up->getRowCount())
          {
            //echo " ParcelasPagas atualizadas,";
            $sel->FullRead("SELECT * FROM `entradas` WHERE `id` = {$_POST['IdContasPagar']}");
            if($sel->getResult()[0]['ParcelasPagas'] == $sel->getResult()[0]['QuantidadeParcelas'])
            {
              $dados3 = [
                'Status'=> 'Pago'
              ];
              $up->ExeUpdate('entradas', $dados3,'WHERE id = :id', "id={$_POST['IdContasPagar']}");
              //echo " Status atualizado";
            }
          }
        }
      }
    }

    $lerEntradas = new Read;
    $lerEntradas->FullRead("SELECT * FROM entradas WHERE id={$id}");

    if($lerEntradas->getResult()[0]['Parcelado']!=0)
    {
      $lerParcelas = new Read;
      $lerParcelas->FullRead("SELECT * FROM parcelas WHERE IdContasPagar={$id}");
      $this->carregarTemplate("verdetalhes", $lerEntradas->getResult()[0], $lerParcelas->getResult());
    }
    else $this->carregarTemplate("verdetalhes", $lerEntradas->getResult()[0]);
  }

}
