<div class="container-md mt-3">
  PAGAR CONTA

  <form method="post">

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
              $parts = explode(';', $this->dados0['Saida']);
              foreach($parts as $dado){
                echo "<option value='{$dado}'>{$dado}</option>";
              }
            ?>
          </select>
          <label for="TipoEntrada">Qual o tipo de Saida?</label>
        </div>
      </div>

      <div class="col-md-2 mb-sm-2">
        <div class="form-floating">
          <input type="date" class="form-control" id="DataEntrada" name="DataEntrada"  required>
          <label for="DataEntrada">Data da Compra</label>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-floating">
          <input type="text" class="form-control" id="Valor" name="Valor"  maxlength="8"  required>
          <label for="Valor">Valor Total</label>
        </div>
      </div>
    </div>


    <div class="row mt-3">
      <div class="col-md-12">
        <div class="form-floating">
          <textarea class="form-control" id="Descricao" name="Descricao" maxlength="1000" style="height: 100px" oninput="contarLetras()" required></textarea>
          <label for="Descricao">Breve descrição da Conta a ser Paga [<span id="contador">0</span>/1000]</label>
        </div>
      </div>
    </div>

    <div class="alert alert-light mt-3" role="alert">
      Essa conta tem mais de uma Parcelada?
      <div class="row px-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="Parcelado" id="Parcelado1" onchange="toggleInputVisibility(false)" value="1">
          <label class="form-check-label" for="Parcelado1">
            SIM
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="Parcelado" id="Parcelado2" value="0" onchange="toggleInputVisibility(true)" checked>
          <label class="form-check-label" for="Parcelado2">
            NÃO
          </label>
        </div>
      </div>
    </div>

    <div class="row" id="DivParcelado">
      <div class="col-md-4">
        <div class="form-floating">
          <select class="form-select" id="MetodoPagamento" name="MetodoPagamento" onchange="blockBotao()" required>
            <?php 
              $parts = explode(';', $this->dados0['Cartao']);
              echo "<option>------</option>";
              foreach($parts as $dado){
                echo "<option value='{$dado}'>{$dado}</option>";
              }
            ?>
          </select>
          <label for="MetodoPagamento">Selecione Metodo Pagamento</label>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-floating">
          <input type="number" class="form-control" id="QuantidadeParcelas" name="QuantidadeParcelas"  min="1" value="1" disabled>
          <label for="QuantidadeParcelas">Quantidade de Parcelas</label>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-floating">
          <input type="text" class="form-control" id="ValorParcela" name="ValorParcela">
          <label for="ValorParcela">Valor de cada Parcela</label>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="Pago" id="sefoipago" name="sefoipago">
          <label class="form-check-label" for="sefoipago">
            MARQUE se já foi pago
          </label>
        </div>
      </div>
   </div>
    <input type="hidden" class="form-control" id="Status" name="Status" value="Pendente">
    <div class="d-flex justify-content-end my-3">
      <button type="submit" class="btn btn-primary" id="Pagar" name="Pagar">Submit</button>
    </div> 

  </form>
  <div class="card" style="width: 18rem;">
    <?php
       
      $NUM = explode(';', NUM);
      $IT = explode(';', IT);
      $CLICK = explode(';', CLICK);
      $NUD = explode(';', NUD);
      $DIGIO = explode(';', DIGIO);
      $MP = explode(';', MP);
        
    ?>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">NUM : <?= $NUM[3]?></li>
      <li class="list-group-item">IT : <?= $IT[3]?></li>
      <li class="list-group-item">CLICK : <?= $CLICK[3]?></li>
      <li class="list-group-item">NUD : <?= $NUD[3]?></li>
      <li class="list-group-item">DIGIO : <?= $DIGIO[3]?></li>
      <li class="list-group-item">MP : <?= $MP[3]?></li>
    </ul>
  </div>

</div>
<script>

  const pagar = document.getElementById('Pagar');
  pagar.disabled = true;

  var inputValorAtual = document.getElementById('Valor');
  var inputQuantidadeParcelas = document.getElementById('QuantidadeParcelas');
  var inputValorParcela = document.getElementById('ValorParcela');

  inputValorAtual.addEventListener('input', calcularValorParcela);
  inputQuantidadeParcelas.addEventListener('input', calcularValorParcela);

  function calcularValorParcela() {
    var valorAtual = parseFloat(inputValorAtual.value.replace(',', '.')); // Obter o valor atual como número
    var quantidadeParcelas = parseInt(inputQuantidadeParcelas.value); // Obter a quantidade de parcelas como número

    if (isNaN(valorAtual) || isNaN(quantidadeParcelas) || quantidadeParcelas === 0) {
      inputValorParcela.value = ''; // Se um dos valores não for válido ou a quantidade de parcelas for zero, limpar o campo da parcela
      return;
    }

    var valorParcela = valorAtual / quantidadeParcelas; // Calcular o valor da parcela
    inputValorParcela.value = valorParcela.toFixed(5).replace('.', ','); // Definir o valor da parcela com duas casas decimais e substituir o ponto por vírgula
  }

  function contarLetras() {
    var texto = document.getElementById("Descricao").value;
    var totalLetras = texto.length;
    document.getElementById("contador").innerText = totalLetras;
  }

  function blockBotao ()
  {
    const metodoPagamento = document.getElementById('MetodoPagamento');
    if(metodoPagamento.value != "------") {pagar.disabled = false}
    else {pagar.disabled = true}
  }

  function toggleInputVisibility(disableInput)
  {
    const inputQuantidadeParcelas = document.getElementById('QuantidadeParcelas');
    const inputHiddenStatus = document.getElementById('Status');

    inputQuantidadeParcelas.disabled = disableInput;

    if(inputQuantidadeParcelas.min == 1)
    {
      inputQuantidadeParcelas.min = 2;
      inputQuantidadeParcelas.value = 2;
      inputHiddenStatus.value = 'Pendente parcelado';
    }
    else {
      inputQuantidadeParcelas.min = 1;
      inputQuantidadeParcelas.value = 1;
      inputHiddenStatus.value = 'Pendente';
    }
    calcularValorParcela();
  }
</script>