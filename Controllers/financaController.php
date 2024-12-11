<?php

class financaController extends Controller
{
  public function index()
  {
    $this->carregarTemplate('financa');
  }

  public function saida()
  {
    $Status = filter_input(INPUT_POST, 'Status', FILTER_DEFAULT);
    $ParcelasPagas = 0;
    if(isset($_POST['sefoipago'])) { $Status = "Pago"; $ParcelasPagas=1;}
    
    if(isset($_POST['Pagar']))
    {
      $dt=[];
      $cigla = 'FLD';
      switch($_POST['MetodoPagamento'])
      {
        case 'Cartão Nu Mozão': $dt = explode(';', NUM); $cigla = 'NUM'; break;
        case 'Cartão IT Mozão': $dt = explode(';', IT); $cigla = 'IT'; break;
        case 'Cartão Click Mozão': $dt = explode(';', CLICK); $cigla = 'CLICK'; break;
        case 'Cartão Nu Danéla': $dt = explode(';', NUD); $cigla = 'NUD'; break;
        case 'Cartão Digio Danéla': $dt = explode(';', DIGIO); $cigla = 'DIGIO'; break;
        case 'Cartão Mercado Pago': $dt = explode(';', MP); $cigla = 'MP'; break;
        default;
      }

      $dados = [
        'Nome'                => filter_input(INPUT_POST, 'Nome', FILTER_DEFAULT),
        'Descricao'           => filter_input(INPUT_POST, 'Descricao', FILTER_DEFAULT),
        'TipoEntrada'         => filter_input(INPUT_POST, 'TipoEntrada', FILTER_DEFAULT),
        'DataPrimeiraParcela' => '',
        'DataEntrada'         => filter_input(INPUT_POST, 'DataEntrada', FILTER_DEFAULT),
        'Valor'               => str_replace(',', '.', filter_input(INPUT_POST, 'Valor', FILTER_DEFAULT)),
        'MetodoPagamento'     => filter_input(INPUT_POST, 'MetodoPagamento', FILTER_DEFAULT),
        'CartaoCigla'         => $cigla,
        'Status'              => $Status,
        'Parcelado'           => filter_input(INPUT_POST, 'Parcelado', FILTER_DEFAULT),
        'QuantidadeParcelas'  => filter_input(INPUT_POST, 'QuantidadeParcelas', FILTER_DEFAULT) == 0 ? 1: $_POST['QuantidadeParcelas'],
        'ParcelasPagas'       => $ParcelasPagas,
        'ValorParcela'        => str_replace(',', '.', filter_input(INPUT_POST, 'ValorParcela', FILTER_DEFAULT)),
      ];
      
      if($_POST['MetodoPagamento'] == 'Dinheiro')
      {
        $dados['DataPrimeiraParcela'] = filter_input(INPUT_POST, 'DataEntrada', FILTER_DEFAULT);
      }
      else
      {
        $_DataEntrada = explode('-', $dados['DataEntrada']);
        $m = $_DataEntrada[1]+($dados['QuantidadeParcelas']);
        if($m>12 && $_DataEntrada[1]==12) $dados['DataPrimeiraParcela'] = $_DataEntrada[0]+1 .'-01-'.$dt[1];
        else 
        {
          $fff = $_DataEntrada[2] >= $dt[0]?$_DataEntrada[1]+1:$_DataEntrada[1];
          $dados['DataPrimeiraParcela'] = $_DataEntrada[0] .'-'.$fff.'-'.$dt[1];
        }
      }
      $cr = new Create;
      $cr->ExeCreate('entradas', $dados);
      if( isset($cr->getResult()[0]) && $dados['QuantidadeParcelas'] >=0 )
      {
        $IdContasPagar = $cr->getResult();
        $FaturaPaga = 0;
        $crx = new Create;
        for($i=1; $i<= $dados['QuantidadeParcelas']; $i++)
        {
          $a = date('Y', strtotime($dados['DataPrimeiraParcela']));
          $m = date('m', strtotime($dados['DataPrimeiraParcela']))+($i-1);
          $d = date('d', strtotime($dados['DataPrimeiraParcela']));
          if($m>12)
          {
            $a = date('Y', strtotime($dados['DataPrimeiraParcela']))+1;
            $m = date('m', strtotime($dados['DataPrimeiraParcela']))+($i-1)-12;
          }
          if(isset($_POST['sefoipago'])) $FaturaPaga = 1;
          $dado = [
            'IdContasPagar'=> $IdContasPagar,
            'DataPagamento' =>  $a.'-'.$m.'-'.$d,
            'Cartao'=> $dados['MetodoPagamento'],
            'Valor'=> $dados['ValorParcela'],
            'FaturaPaga'=> $FaturaPaga,
            'ParcelaAtual'=> $i,
            'QuantidadeParcelas'=> $dados['QuantidadeParcelas']
          ];
          $crx->ExeCreate('parcelas', $dado);
        }
      }
    }
    
    $r = new Read;
    $r->FullRead("SELECT * FROM ferramenta");
    $this->carregarTemplate('pagar', $r->getResult()[0]);
  }

  public function entrada()
  {
    if(isset($_POST['Dimdim']))
    {
      $dados = [
        'Nome'        => filter_input(INPUT_POST, 'Nome', FILTER_DEFAULT),
        'Descricao'   => filter_input(INPUT_POST, 'Descricao', FILTER_DEFAULT),
        'TipoEntrada' => filter_input(INPUT_POST, 'TipoEntrada', FILTER_DEFAULT),
        'DataEntrada' => filter_input(INPUT_POST, 'DataEntrada', FILTER_DEFAULT),
        'Valor'       => str_replace(',', '.', filter_input(INPUT_POST, 'Valor', FILTER_DEFAULT)),
        'Status'      => filter_input(INPUT_POST, 'Status', FILTER_DEFAULT),
      ];

      $cr = new Create;
      $cr->ExeCreate('entradas', $dados);
      if($cr->getResult()[0]!="") getMessage('success', 'Cadastrado com sucesso.');
      else getMessage('danger', 'Algo deu errado na hora de cadastar.');
    }

    $r = new Read;
    $r->FullRead("SELECT * FROM ferramenta");
    $this->carregarTemplate('entrada', $r->getResult()[0]);
  }
}
