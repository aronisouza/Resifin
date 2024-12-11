<?php

class cartoesController extends Controller
{
  public function index()
  {
    $up = new Update;
    $sel = new Read;
    if(isset($_POST['PagarTodasdoMesCartao']))
    {
      if (isset($_SESSION['EntradaID']))
      {
        $array = array_filter(explode(",", $_SESSION['EntradaID']));
        $tabelaParcelas = 'parcelas';
        $dadosParcelas = ['FaturaPaga' => 1];
        $termosParcelas = "WHERE DataPagamento = :DataPagamento AND Cartao = :Cartao";
        $parseStringParcelas = "DataPagamento={$_POST['DataPagamento']}&Cartao={$_POST['Cartao']}";
        $up->ExeUpdate($tabelaParcelas, $dadosParcelas, $termosParcelas, $parseStringParcelas);
        if($up->getRowCount())
        {
          foreach($array as $id)
          {
            $sel->FullRead("SELECT QuantidadeParcelas, ParcelasPagas FROM `entradas` WHERE `id` = {$id}");
            $dados = ['ParcelasPagas' => $sel->getResult()[0]['ParcelasPagas']+1];
            $up->ExeUpdate('entradas',$dados,'WHERE id = :id',"id={$id}");
            if($up->getRowCount())
            {
              $sel->FullRead("SELECT * FROM `entradas` WHERE `id` = {$id}");
              if($sel->getResult()[0]['ParcelasPagas'] == $sel->getResult()[0]['QuantidadeParcelas'])
              {
                $dados3 = ['Status'=> 'Pago'];
                $up->ExeUpdate('entradas', $dados3,'WHERE id = :id', "id={$id}");
              }
              else {getMessage('warning', ':: entradas -> ParcelasPagas e QuantidadeParcelas');}
            }
          }
        }
        else {getMessage('danger', 'ERRO: Nenhuma alteração realizada!');}
        $_SESSION = array();
        session_destroy();
      }
    }

    if(isset($_POST['Salva-marcarComoPago']) && $_POST['Salva-marcarComoPago'] == 'Sim')
    {
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

    if(isset($_POST['cartao']) && $_POST['cartao'] != "DIN")
    {
      $cartao ='';
      switch($_POST['cartao'])
      {
        case 'NUM':   $cartao='Cartão Nu Mozão';break;
        case 'IT':    $cartao='Cartão IT Mozão';break;
        case 'CLICK': $cartao='Cartão Click Mozão';break;
        case 'NUD':   $cartao='Cartão Nu Danéla';break;
        case 'DIGIO': $cartao='Cartão Digio Danéla';break;
        case 'MP':    $cartao='Cartão Mercado Pago';break;
        case 'DIN':   $cartao='Dinheiro';break;
        case 'Aroni':   $cartao='Todos os Cartões';break;
      }


      $meses = [
      'Jan' => '01', 'Fev' => '02', 'Mar' => '03', 'Abr' => '04', 
      'Mai' => '05', 'Jun' => '06', 'Jul' => '07', 'Ago' => '08', 
      'Set' => '09', 'Out' => '10', 'Nov' => '11', 'Dez' => '12'
      ];

      $_ano = isset($_POST['anopesquisa']) && $_POST['anopesquisa'] != "" ? $_POST['anopesquisa'] : date('Y');
      $_mes = $meses[$_POST['data']];
      $_mes = str_pad($_mes, 2, '0', STR_PAD_LEFT);
      $xmes = isset($_POST['xmes']) && $_POST['xmes'] == 'xmes' ? '' : "AND p.Cartao='$cartao'";
      $cartao0 = new Read;
    
      $FF = "
      SELECT p.*, e.Nome, e.CartaoCigla, e.TipoEntrada, e.DataEntrada, e.Status, e.Parcelado, e.id as EntradaID 
      FROM parcelas p 
      LEFT JOIN entradas e ON p.IdContasPagar=e.id 
      WHERE YEAR(p.DataPagamento)=$_ano 
      AND MONTH(p.DataPagamento)=$_mes 
      $xmes 
      ORDER BY p.DataPagamento ASC";


      $cartao0->FullRead($FF);
      $lambi='';
      foreach ($cartao0->getResult() as $linha) {
        $lambi = $lambi.','.$linha['EntradaID'];
      }
      $_SESSION['EntradaID'] = $lambi;
      if(!empty($cartao0->getResult())):
        $this->carregarTemplate(
        'cartoes',
        $cartao0->getResult(),
        $this->getSomaDividasPagas($_ano, $_mes, $cartao)[0],
        $this->getSomaDividasAbertas($_ano, $_mes, $cartao)[0],
        ['teste'=>$cartao]
      );
      else:
        $this->carregarTemplate('cartoes',  $cartao0->getResult());
      endif;
    }
    else {$this->carregarTemplate('cartoes');}
  }

  function getSomaDividasAbertas($_ano, $_mes, $cartao)
  {
    $somas = new Read;
    $xmes= isset($_POST['xmes']) && $_POST['xmes'] == 'xmes' ?'':"AND Cartao='$cartao'";
    $somas->FullRead("SELECT SUM(Valor) AS 'Valores Pendentes' FROM parcelas WHERE FaturaPaga=0 AND YEAR(DataPagamento)=$_ano AND MONTH(DataPagamento)=$_mes $xmes");
    return $somas->getResult();
  }

  function getSomaDividasPagas($_ano, $_mes, $cartao)
  {
    $somas = new Read;
    $xmes= isset($_POST['xmes']) && $_POST['xmes'] == 'xmes' ?'':"AND Cartao='$cartao'";
    $somas->FullRead("SELECT SUM(Valor) AS 'Valores Pagos' FROM parcelas WHERE FaturaPaga=1 AND YEAR(DataPagamento)=$_ano AND MONTH(DataPagamento)=$_mes $xmes");
    return $somas->getResult();
  }
}
