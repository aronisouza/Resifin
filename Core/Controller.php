<?php
class Controller
{
  public $dados;

  public function __construct()
  {
    $this->dados = array_fill(0, 10, array());
  }

  public function carregarComponents($component)
  {
    $component = preg_replace('/[^a-zA-Z0-9_]/', '', $component);
    require 'Components/' . $component . '.php';
  }
  
  public function carregarView($view, $dadosZero = array())
  {
    extract($dadosZero);
    require 'Views/' . $view . '.php';
  }

  public function carregarTemplate($view, ...$dados)
  {
    // Verifique se a variável view foi passada corretamente
    if (!empty($view)) {
      // Carregar os dados
      foreach ($dados as $index => $data)
        if (is_array($data) && !empty($data)) $this->dados[$index] = $data;
      
      // Remove arrays vazios
      $this->dados = array_filter($this->dados);

      // Verifique se o arquivo template existe
      if (file_exists('Views/template.php')) require 'Views/template.php';
      else echo "Erro: O arquivo de template não foi encontrado.";
    }
    else echo "Erro: O parâmetro 'view' está vazio.";
  }

}
