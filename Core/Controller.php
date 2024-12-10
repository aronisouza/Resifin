<?php

class Controller
{
  public $dados0;
  public $dados1;
  public $dados2;
  public $dados3;
  public $dados4;
  public $dados5;
  public $dados6;
  public $dados7;
  public $dados8;
  public $dados9;

  public function __construct()
  {
    $this->dados0 = array();
    $this->dados1 = array();
    $this->dados2 = array();
    $this->dados3 = array();
    $this->dados4 = array();
    $this->dados5 = array();
    $this->dados6 = array();
    $this->dados7 = array();
    $this->dados8 = array();
    $this->dados9 = array();
  }

  public function carregarComponents($component)
  {
    require 'Components/' . $component . '.php';
  }
  
  public function carregarView($view, $dadosZero = array())
  {
    extract($dadosZero);
    require 'Views/' . $view . '.php';
  }

  public function carregarTemplate($view, 
  $dadosZero = array(), $dadosUm = array(), $dadosDois = array(), $dadosTreis = array(), $dadosQuatro = array(),
  $dadosCinco = array(), $dadosSeis = array(), $dadosSete = array(), $dadosOito = array(), $dadosNove = array()
  
  )
  {
    $this->dados0 = $dadosZero;
    $this->dados1 = $dadosUm;
    $this->dados2 = $dadosDois;
    $this->dados3 = $dadosTreis;
    $this->dados4 = $dadosQuatro;
    $this->dados5 = $dadosCinco;
    $this->dados6 = $dadosSeis;
    $this->dados7 = $dadosSete;
    $this->dados8 = $dadosOito;
    $this->dados9 = $dadosNove;
    require 'Views/template.php';
  }

}
