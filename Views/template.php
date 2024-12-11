<?php 
if(isset($_POST['SalvaOp']))
{
  $dados = [ $_POST['Coluna']=> $_POST['DataOpcoes']];
  $up = new Update;
  $up->ExeUpdate('ferramenta',$dados,"WHERE id=:id","id=1");
  if($up->getRowCount()) getMessage('success','Foi alterado!'); 
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RESIFIN - Finanças da Casa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  
  <style>
    body {
      background-color: #c3cad591;
      color: #2b6ccb;
    }
    .pago { background-color: #2eff9e2e;}
    .aberto { background-color: #fb00002e;}
    .neutro { background-color: #fff9f92e;}

    .mr-n {
      margin-right: -10px !important;
    }
    .ms-n {
      margin-left: -10px !important;
    }
    .hidden { display: none; }
    @keyframes blink { 0%, 100% { background-color: inherit; } 50% { background-color: #df7b85; } } .blink { animation: blink 0.5s step-end infinite alternate; }
  </style>

</head>

<body>

  <?php
    $this->carregarComponents("navbar");
  ?>

  <div class="container">
    <?php
      $this->carregarView($view, $dados);
    ?>
  </div>


<!-- Modal -->
<div class="modal fade" id="modalshow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalshowLabel" aria-hidden="true">
<form method="post">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span>Opções já cadastradas</span>
        <textarea class="form-control mt-3" aria-label="With textarea" id="DataOpcoes" name="DataOpcoes"></textarea>
        <input type="hidden" id="Coluna" name="Coluna" value="">
        <span>Separar as opções com ' ; '</span>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="SalvaOp">Salvar</button>
      </div>
    </div>
  </div>
</form>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <script type="text/javascript">

    if (document.getElementById('modalshow')) 
    {
      document.getElementById('modalshow').addEventListener('show.bs.modal', event =>
      {
        const button = event.relatedTarget
        const DataTipo = button.getAttribute('data-tipo')
        const DataOpcoes = button.getAttribute('data-dados')
        const DataTipoShow = document.getElementById('modalshow').querySelector('#exampleModalLabel')
        const DataOpcoesShow = document.getElementById('modalshow').querySelector('#DataOpcoes')
        const ColunaShow = document.getElementById('modalshow').querySelector('#Coluna')
        DataTipoShow.textContent = 'Editando as Opções : '+DataTipo
        DataOpcoesShow.textContent = DataOpcoes
        ColunaShow.value = DataTipo
      })
    }

    document.addEventListener("DOMContentLoaded", function()
    {
      var form = document.getElementById("Formulario");

      form.addEventListener("keydown", function(event)
      {
        if (event.key === "Enter" && event.target.type !== "textarea") event.preventDefault();
      });
    });


    function id(elemento) {
      return document.getElementById(elemento);
    }

    function MaskCPF(i,k) {
      let lgSepare = id(i).value.length
      if (lgSepare === 3 || lgSepare === 7 && k != 8) id(i).value += '.';
      else if(lgSepare === 11 && k != 8) id(i).value += '-';
    }

    function MaskTelefone(i,k) {
      let lgSepare = id(i).value.length
      if(lgSepare === 1 && k != 8) id(i).value = '('+id(i).value;
      else if(lgSepare === 3 && k != 8) id(i).value += ') ';
      else if(lgSepare === 10 && k != 8) id(i).value += '-';
    }

  </script>

</body>

</html>