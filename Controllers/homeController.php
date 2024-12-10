<?php

class homeController extends Controller
{
  public function index($p=0)
  {
    //Paginação
    
    $pg = $p?$p:1;
    $r = new Read;
    $r->FullRead("SELECT id FROM parcelas WHERE YEAR(DataPagamento) = YEAR(NOW())");
    $reg = 20;
    $tp = ceil($r->getRowCount()/$reg);
    $i = ($reg*$pg)-$reg;

    // botoes paginação
    $anterior = $pg-1;
    $proximo = $pg+1;

    // consulta todos os registros do ano atual
    $tudo = new Read;
    $tudo->FullRead("SELECT p.*, e.Nome, e.TipoEntrada, e.Status FROM parcelas p LEFT JOIN entradas e ON p.IdContasPagar=e.id WHERE YEAR(p.DataPagamento) = YEAR(NOW())  ORDER BY p.created_date DESC LIMIT {$i}, {$reg}");

    // carrega as informções na página
    $this->carregarTemplate(
      'home',
      $tudo->getResult(), // 0
      $this->getSomaDinheiroCaixa("YEAR(DataEntrada) = YEAR(CURRENT_DATE())"), // 1
      $this->getSomaDividasAbertas("YEAR(DataPagamento) = YEAR(CURRENT_DATE())"),// 2
      $this->getSomaDividasPagas("YEAR(DataPagamento) = YEAR(CURRENT_DATE())"),// 3
      ['dado'=> 'do Ano : '.date('Y'), 'showPag'=> true], // 4
      $anterior, // 5
      $proximo, // 6
      $pg, // 7
      $tp // 8
    );
  }

  public function Mes($mes)
  { 
    $mesp='';
    switch($mes)
    {
      case 'a': $mamp = "DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m')"; $mesp= date('m-Y', strtotime('-1 month'));break;
      case 'm': $mamp = "DATE_FORMAT(NOW(), '%Y-%m')";$mesp= date('m-Y'); break;
      case 'p': $mamp = "DATE_FORMAT(NOW() + INTERVAL 1 MONTH, '%Y-%m')";$mesp= date('m-Y', strtotime('+1 month')); break;
    }
    $tudo = new Read;
    $entradas = new Read;
    $g="SELECT p.*, e.Nome, e.TipoEntrada, e.Status FROM parcelas p LEFT JOIN entradas e ON p.IdContasPagar=e.id WHERE DATE_FORMAT(p.DataPagamento, '%Y-%m') = $mamp AND YEAR(p.DataPagamento) = YEAR(CURRENT_DATE()) ORDER BY p.DataPagamento ASC";
    $tudo->FullRead($g);

    $entradas->FullRead("SELECT *
    FROM entradas
    WHERE DATE_FORMAT(DataEntrada, '%Y-%m') = $mamp
      AND TipoEntrada IN ('Pagamento', 'Vale', 'Terapia', 'Outras Entradas')
    ORDER BY DataEntrada ASC");

    $this->carregarTemplate(
      'home',
      $tudo->getResult(), // 0
      $this->getSomaDinheiroCaixa("DATE_FORMAT(DataEntrada, '%Y-%m') = $mamp"), // 1
      $this->getSomaDividasAbertas("DATE_FORMAT(DataPagamento, '%Y-%m') = $mamp"), // 2
      $this->getSomaDividasPagas("DATE_FORMAT(DataPagamento, '%Y-%m') = $mamp"), // 3
      ['dado'=> 'do Mês : '.$mesp, 'showPag'=> false], // 4
      $entradas->getResult(), // 5
    );
  }

  function getSomaDinheiroCaixa($dt)
  {
    $somas = new Read;
    $somas->FullRead("SELECT SUM(Valor) AS 'Valores Entrada' FROM entradas WHERE Status = 'Dinheiro em Caixa' AND $dt AND YEAR(DataEntrada) = YEAR(CURRENT_DATE())");
    return $somas->getResult();
  }

  function getSomaDividasAbertas($dt)
  {
    $somas = new Read;
    $somas->FullRead("SELECT SUM(Valor) AS 'Valores Pendentes' FROM parcelas WHERE FaturaPaga=0 AND $dt AND YEAR(DataPagamento) = YEAR(CURRENT_DATE())");
    return $somas->getResult();
  }

  function getSomaDividasPagas($dt)
  {
    $somas = new Read;
    $somas->FullRead("SELECT SUM(Valor) AS 'Valores Pagos' FROM parcelas WHERE FaturaPaga=1 AND $dt AND YEAR(DataPagamento) = YEAR(CURRENT_DATE())");
    return $somas->getResult();
  }

}
