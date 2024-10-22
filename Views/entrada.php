<div class="container-md mt-3">
  ENTRADA DE DIMDIM

  <form  method="post">

    <div class="row mt-3">

      <div class="col-md-4 mb-sm-2">
        <div class="form-floating">
          <input type="text" class="form-control" id="Nome" name="Nome" required>
          <label for="Nome">Nome para Identificação</label>
        </div>
      </div>

      <div class="col-md-4 mb-sm-2">
        <div class="form-floating">
          <select class="form-select" id="TipoEntrada" name="TipoEntrada" required>
            <?php 
              $parts = explode(';', $this->dados0['Entrada']);
              foreach($parts as $dado){
                echo "<option value='{$dado}'>{$dado}</option>";
              }
            ?>
          </select>
          <label for="Entrada">Qual o tipo de entrada?</label>
        </div>
      </div>
  
      <div class="col-md-2 mb-sm-2">
        <div class="form-floating">
          <input type="date" class="form-control" id="DataEntrada" name="DataEntrada" required>
          <label for="DataEntrada">Data da Entrada</label>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-floating">
          <input type="text" class="form-control" id="Valor" name="Valor" maxlength="8" required>
          <label for="ValorAtual">Valor 000,00</label>
        </div>
      </div>

    </div>
  
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="form-floating">
          <textarea class="form-control" id="Descricao" name="Descricao" maxlength="1000" style="height: 100px" oninput="contarLetras()" required></textarea>
          <label for="Descricao">Breve descrição da Entrada de Dimdim [<span id="contador">0</span>/1000]</label>
        </div>
      </div>

      <input type="hidden" class="form-control" id="Status" name="Status" value="Dinheiro em Caixa">

      <div class="d-flex justify-content-end my-3">
        <button type="submit" class="btn btn-primary" name="Dimdim">Submit</button>
      </div>

    </div> 
  </form>
</div>

<script>
  function contarLetras() {
    var texto = document.getElementById("Descricao").value;
    var totalLetras = texto.length;
    document.getElementById("contador").innerText = totalLetras;
  }
</script>