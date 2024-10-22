<?php

class cartoesController extends Controller
{
  public function index()
  {
    //getPre($_POST['cartao']);
    if(isset($_POST['Salva-marcarComoPago']) && $_POST['Salva-marcarComoPago'] == 'Sim')
    {
      $up = new Update;
      $sel = new Read;

      //getPreA($_POST);
      
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

    if(isset($_POST['cartao']) && $_POST['cartao'] != "DIN")
    {
      $cart ='DIN';
      $DiaCart ='01';

      switch($_POST['cartao'])
      {
        case 'NUM':   $cart='Cartão Nu Mozão';      $e = explode(';', NUM);     $DiaCart=$e[0]; break;
        case 'IT':    $cart='Cartão IT Mozão';      $e = explode(';', IT);      $DiaCart=$e[0]; break;
        case 'CLICK': $cart='Cartão Click Mozão';   $e = explode(';', CLICK);   $DiaCart=$e[0]; break;
        case 'NUD':   $cart='Cartão Nu Danéla';     $e = explode(';', NUD);     $DiaCart=$e[0]; break;
        case 'DIGIO': $cart='Cartão Digio Danéla';  $e = explode(';', DIGIO);   $DiaCart=$e[0]; break;
        case 'MP':    $cart='Cartão Mercado Pago';  $e = explode(';', MP);      $DiaCart=$e[0]; break;
        case 'DIN':   $cart='Dinheiro';             $e = explode(';', DIN);     $DiaCart=$e[0]; break;
      }
     
      $dt='F';

      $_DataEntradaa = explode('-', date('Y-m-d'));

      switch($_POST['data'])
      {
        case 'A': 
          $dt=" YEAR(DataPagamento) = YEAR(NOW())";
        break;
        case 'Dez/Jan':
          $ae = $_DataEntradaa[0]-1;
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$ae}-12-{$DiaCart}' AND '$_DataEntradaa[0]-01-{$dd}'";
        break;
        case 'Jan/Fev':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-01-{$DiaCart}' AND '$_DataEntradaa[0]-02-{$dd}'";
        break;
        case 'Fev/Mar':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-02-{$DiaCart}' AND '$_DataEntradaa[0]-03-{$dd}'";
        break;
        case 'Mar/Abr':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-03-{$DiaCart}' AND '$_DataEntradaa[0]-04-{$dd}'";
        break;
        case 'Abr/Mai':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-04-{$DiaCart}' AND '$_DataEntradaa[0]-05-{$dd}'";
        break;
        case 'Mai/Jun':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-05-{$DiaCart}' AND '$_DataEntradaa[0]-06-{$dd}'";
        break;
        case 'Jun/Jul':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-06-{$DiaCart}' AND '$_DataEntradaa[0]-07-{$dd}'";
        break;
        case 'Jul/Ago':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-07-{$DiaCart}' AND '$_DataEntradaa[0]-08-{$dd}'";
        break;
        case 'Ago/Set':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-08-{$DiaCart}' AND '$_DataEntradaa[0]-09-{$dd}'";
        break;
        case 'Set/Out':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-09-{$DiaCart}' AND '$_DataEntradaa[0]-10-{$dd}'";
        break;
        case 'Out/Nov':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-10-{$DiaCart}' AND '$_DataEntradaa[0]-11-{$dd}'";
        break;
        case 'Nov/Dez':
          $dd = $DiaCart-1<=9?'0'.$DiaCart-1:$DiaCart-1;
          $dt="'{$_DataEntradaa[0]}-11-{$DiaCart}' AND '$_DataEntradaa[0]-12-{$dd}'";
        break;
      }

      $anoMes = $_POST['data']=='A'?'':'p.DataPagamento BETWEEN';
      $xmes= isset($_POST['xmes']) && $_POST['xmes'] == 'xmes' ?'':"AND p.Cartao='$cart'";
      
      $cartao0 = new Read;
      $FF="SELECT p.*, e.Nome, e.CartaoCigla, e.TipoEntrada, e.DataEntrada, e.Status, e.Parcelado 
      FROM parcelas p 
      LEFT JOIN entradas e 
      ON p.IdContasPagar=e.id 
      WHERE $anoMes $dt $xmes
      ORDER BY p.DataPagamento ASC";
      $cartao0->FullRead($FF);

      if(!empty($cartao0->getResult())):
          $this->carregarTemplate(
          'cartoes',
          $cartao0->getResult(),
          $this->getSomaDividasPagas($dt, $cart)[0],
          $this->getSomaDividasAbertas($dt, $cart)[0]
        );

      else:
        $this->carregarTemplate('cartoes',  $cartao0->getResult());
      endif;
    }
    else {$this->carregarTemplate('cartoes');}
  }


  function getSomaDividasAbertas($dt, $cart)
  {
    $xmes= isset($_POST['xmes']) && $_POST['xmes'] == 'xmes' ?'':"AND Cartao='$cart'";
    $somas = new Read;
    $anoMes = $_POST['data']=='A'?'':'DataPagamento BETWEEN';
    $somas->FullRead("SELECT SUM(Valor) AS 'Valores Pendentes' FROM parcelas WHERE FaturaPaga=0 AND $anoMes $dt $xmes");
    return $somas->getResult();
  }

  function getSomaDividasPagas($dt, $cart)
  {
    $xmes= isset($_POST['xmes']) && $_POST['xmes'] == 'xmes' ?'':"AND Cartao='$cart'";
    $somas = new Read;
    $anoMes = $_POST['data']=='A'?'':'DataPagamento BETWEEN';
    $somas->FullRead("SELECT SUM(Valor) AS 'Valores Pagos' FROM parcelas WHERE FaturaPaga=1 AND $anoMes $dt $xmes");
    return $somas->getResult();
  }
}
