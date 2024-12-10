<?php

class dinheiroentradasController extends Controller
{
  public function index()
  {
    $mes = date('M');
    
    if(isset($_POST["mesdimentrada"])) $mes = $_POST["mesdimentrada"];
    echo $mes;


    $entradas = new Read;
    $entradas->FullRead("SELECT *
      FROM entradas
      WHERE TipoEntrada IN ('Pagamento', 'Aluguel',  'Vale', 'Terapia', 'Outras Entradas')
        ORDER BY DataEntrada DESC");

    $this->carregarTemplate(
      'dinheiroentradas',
      $entradas->getResult()
    );
  }

  public function saidas()
  {
    $entradas = new Read;

    $entradas->FullRead(
        "SELECT p.*, e.Nome, e.Status
        FROM parcelas p
        LEFT JOIN entradas e 
        ON p.IdContasPagar=e.id
        WHERE p.Cartao = 'Dinheiro'
        ORDER BY DataPagamento DESC"
      );

    $this->carregarTemplate(
      'dinheiropagamentos',
      $entradas->getResult()
    );
  }
}
