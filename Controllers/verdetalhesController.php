<?php

class verdetalhesController extends Controller
{
  public function index($id)
  {
    if(isset($_POST['Salva-marcarComoPago']) && $_POST['Salva-marcarComoPago'] == 'Sim')
    {
      $up = new Update;
      $sel = new Read;
      $dados = ['FaturaPaga'=> 1];
      $up->ExeUpdate('parcelas',$dados,'WHERE id = :id', "id={$_POST['id']}");
      if($up->getRowCount())
      {
        $sel->FullRead("SELECT * FROM `entradas` WHERE `id` = {$_POST['IdContasPagar']}");
        $dados2 = ['ParcelasPagas' => $sel->getResult()[0]['ParcelasPagas']+1];
        $up->ExeUpdate('entradas', $dados2,"WHERE id = :id", "id={$_POST['IdContasPagar']}");
        if($up->getRowCount())
        {
          $sel->FullRead("SELECT * FROM `entradas` WHERE `id` = {$_POST['IdContasPagar']}");
          if($sel->getResult()[0]['ParcelasPagas'] == $sel->getResult()[0]['QuantidadeParcelas'])
          {
            $dados3 = ['Status'=> 'Pago'];
            $up->ExeUpdate('entradas', $dados3,'WHERE id = :id', "id={$_POST['IdContasPagar']}");
          }
        }
      }
    }

    $lerEntradas = new Read;
    $lerEntradas->FullRead("SELECT * FROM entradas WHERE id={$id}");
    $lerParcelas = new Read;
    $lerParcelas->FullRead("SELECT * FROM parcelas WHERE IdContasPagar={$id}");
    $this->carregarTemplate("verdetalhes", $lerEntradas->getResult()[0], $lerParcelas->getResult());
  }
}
