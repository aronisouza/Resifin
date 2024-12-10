<?php

$Pago= 0.00;   $Pendente = 0.00;

if(isset($this->dados1) && !empty($this->dados1))
{
  $Pago = $this->dados1['Valores Pagos'];
  $Pago = $Pago == ''?0.00:$Pago;
}

if(isset($this->dados2) && !empty($this->dados2))
{
  $Pendente = $this->dados2['Valores Pendentes'];
  $Pendente = $Pendente == ''?0.00:$Pendente;
}

?>
<div class="container mt-3">
  
  <div class="row mb-3">
    <h4>Movimentações financeiras</h4>
  </div>

  <form method="post">
    <div class="row shadow-sm bg-body rounded mb-3">

      <div class="row mt-3">
        <p><strong>Parâmetro de pesquisa</strong></p>
        <p>Informe o Ano e depois escolha o mês de vencimento para pagar. Clique no cartão para pesquisar.</p>
      </div>
      <div class="col-3 mb-3">
      <div class="input-group">
        <span class="input-group-text" id="basic-addon1">Data Base</span>
        <input type="text" class="form-control" id="anopesquisa" name="anopesquisa" placeholder="2000" value="<?= isset($_POST['anopesquisa']) && $_POST['anopesquisa'] != ""?$_POST['anopesquisa']:''?>">
      </div></div>
      
      <div class="btn-group" id="grupoRadio" role="group" aria-label="Basic radio toggle button group">
        
        <input type="radio" class="btn-check" name="data" id="Jan" autocomplete="off" value="Jan" <?php echo isset($_POST['data']) && $_POST['data'] == 'Jan' ? 'checked' : '';?> checked>
        <label class="btn btn-outline-secondary" for="Jan">Jan</label>

        <input type="radio" class="btn-check" name="data" id="Fev" autocomplete="off" value="Fev" <?php echo isset($_POST['data']) && $_POST['data'] == 'Fev' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Fev">Fev</label>

        <input type="radio" class="btn-check" name="data" id="Mar" autocomplete="off" value="Mar" <?php echo isset($_POST['data']) && $_POST['data'] == 'Mar' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Mar">Mar</label>

        <input type="radio" class="btn-check" name="data" id="Abr" autocomplete="off" value="Abr" <?php echo isset($_POST['data']) && $_POST['data'] == 'Abr' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Abr">Abr</label>

        <input type="radio" class="btn-check" name="data" id="Mai" autocomplete="off" value="Mai" <?php echo isset($_POST['data']) && $_POST['data'] == 'Mai' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Mai">Mai</label>

        <input type="radio" class="btn-check" name="data" id="Jun" autocomplete="off" value="Jun" <?php echo isset($_POST['data']) && $_POST['data'] == 'Jun' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Jun">Jun</label>

        <input type="radio" class="btn-check" name="data" id="Jul" autocomplete="off" value="Jul" <?php echo isset($_POST['data']) && $_POST['data'] == 'Jul' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Jul">Jul</label>

        <input type="radio" class="btn-check" name="data" id="Ago" autocomplete="off" value="Ago" <?php echo isset($_POST['data']) && $_POST['data'] == 'Ago' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Ago">Ago</label>

        <input type="radio" class="btn-check" name="data" id="Set" autocomplete="off" value="Set" <?php echo isset($_POST['data']) && $_POST['data'] == 'Set' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Set">Set</label>

        <input type="radio" class="btn-check" name="data" id="Out" autocomplete="off" value="Out" <?php echo isset($_POST['data']) && $_POST['data'] == 'Out' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Out">Out</label>
        
        <input type="radio" class="btn-check" name="data" id="Nov" autocomplete="off" value="Nov" <?php echo isset($_POST['data']) && $_POST['data'] == 'Nov' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Nov">Nov</label>
        
        <input type="radio" class="btn-check" name="data" id="Dez" autocomplete="off" value="Dez" <?php echo isset($_POST['data']) && $_POST['data'] == 'Dez' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Dez">Dez</label>
      </div>

      <div class="form-check mt-3 mx-3">
        <input class="form-check-input" type="checkbox" value="xmes" id="xmes" name="xmes" <?php echo isset($_POST['xmes']) && $_POST['xmes'] == 'xmes' ? 'checked' : '';?> onchange="toggleDivs()">
        <label class="form-check-label" for="xmes" >
          Deixar checado para buscar apenas por Mês. Isso busca em todos os cartões
        </label>
      </div>
    
      <div class="row mb-3 mt-4">
        <p class="text-primary">Escolha o cartão que deseja ver as informações. 
          <br />E caso tenha Atrasado ou Parcelas futuras abertas serão informados em vermelho!</p>
        <div id="botoesCartoes">
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'NUM' ? 'btn-secondary' : 'btn-light';?> btn-sm"     value="NUM"     name="cartao">Cartão Nu Mozão</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'CLICK' ? 'btn-secondary' : 'btn-light';?> btn-sm"   value="CLICK"   name="cartao">Cartão Click Mozão</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'MP' ? 'btn-secondary' : 'btn-light';?> btn-sm"      value="MP"      name="cartao">Cartão Cartão Mercado Pago</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'IT' ? 'btn-secondary' : 'btn-warning';?> btn-sm"      value="IT"      name="cartao">Cartão IT Mozão</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'NUD' ? 'btn-secondary' : 'btn-warning';?> btn-sm"     value="NUD"     name="cartao">Cartão Nu Danéla</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'DIGIO' ? 'btn-secondary' : 'btn-warning';?> btn-sm"   value="DIGIO"   name="cartao">Cartão Digio Danéla</button>
        </div>
        <div id="botaoMesTodosCartoes">
          <button type="submit" class="btn btn-warning btn-sm" value="Aroni" name="cartao">Soma Mensal Todos os Cartões</button>
       </div>
        
      </div>
    </div>
  </form>

  <div class="row d-flex justify-content-start gap-1">

    <div class="col-md-3 card border-info mb-3">
      <div class="card-body text-info">
        <h5 class="card-title">R$ <?= number_format($Pago, 4, ',', '.'); ?></h5>
        <p class="card-text">Pago</p>
      </div>
    </div>
    
    <div class="col-md-3 card border-danger mb-3">
      <div class="card-body text-danger ">
        <h5 class="card-title">R$ <?= number_format($Pendente, 4, ',', '.');?></h5>
        <p class="card-text">Pendente</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="alert alert-light shadow-sm p-3 bg-body rounded" role="alert">
      
      <?php //getPre($this->dados0);
      if(empty($this->dados0[0])):
        echo "
        <h5>
          Não existe movimentações para o Parâmetro selecionado.
        </h5>
        ";
      else:
        echo "
        <div class='row'>
        <div class='col-auto me-auto'>
          <h5>
            Informações do <b> {$this->dados3['teste']} </b>
          </h5>
          </div>
          <div class='col-auto'>
          <form method='post'>
            <input type='hidden' name='DataPagamento' value='{$this->dados0[0]['DataPagamento']}'>
            <input type='hidden' name='Cartao' value='{$this->dados0[0]['Cartao']}'>
            <button type='submit' class='btn btn-dark btn-sm' name='PagarTodasdoMesCartao'>Pagar todas as de uma vez</button>
          </form>
          </div>
        </div>
        ";
        ?>
          <div>
            <!-- cabeçalho antes do acordião -->
            <div class="row p-2 mx-1">
              <div class="col-1"></div>
              <div class="col-3">Nome</div>
              <div class="col-1">CIGLA</div>
              <div class="col-2">Data Pagamento</div>
              <div class="col-2">Data Compra</div>
              <div class="col-2">Valor Total</div>
              <div class="col-1 d-flex justify-content-center">Ações</div>
            </div>
            <?php
            //getPreA($this->dados0);
            foreach($this->dados0 as $key => $cartao):
              $_corLista = 'neutro';
              if($cartao['DataPagamento'] < date('Y-m-d') && $cartao['FaturaPaga']==0) $_corLista = 'aberto';
              if($cartao['FaturaPaga'] == 1) $_corLista = 'pago';
            ?>
            <!-- registros do acordião -->
            <div class="row p-2 mx-1 border-bottom <?= $_corLista;?>" id="heading<?= $key;?>" data-bs-toggle="collapse" data-bs-target="#cartao<?= $key;?>" aria-expanded="true" aria-controls="cartao<?= $key;?>">
              <div class="col-1">
                <a type="button" class="btn btn-link" href="/verdetalhes/index/<?= $cartao['IdContasPagar'];?>">
                  <?php getIco('aspect-ratio','text-dark',26); ?>
                </a>
              </div>
              <div class="col-3"><?= $cartao['Nome'].' '.$cartao['ParcelaAtual'].' de '.$cartao['QuantidadeParcelas'];?></div>
              <div class="col-1"><?= $cartao['CartaoCigla'];?></div>
              <div class="col-2"><?= $cartao['DataPagamento'];?></div>
              <div class="col-2"><?= $cartao['DataEntrada'];?></div>
              <div class="col-2"><?= $cartao['Parcelado'] == 0?getIco('x-circle','text-danger','20'): getIco('check-circle','text-success','20');?><?= 'R$ '.number_format($cartao['Valor'], 4, ',', '.');?></div>
              <div class="col-1 d-flex justify-content-center">
                <?= $cartao['FaturaPaga'] == 1?getIco('cash-coin','text-success','20'):
                  " <button type='button' class='btn btn-warning btn-sm' id-parcela='{$cartao['id']}' IdContasPagar='{$cartao['IdContasPagar']}' data-bs-toggle='modal' data-bs-target='#marcarComoPago'>
                    Pagar
                  </button>"
                ?>
              </div>
             
            </div>
            <?php endforeach; ?>
          </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="row">
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#"><<</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">>></a></li>
      </ul>
    </nav>
  </div>

</div>


<!-- Modal -->
<div class="modal fade" id="marcarComoPago" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="marcarComoPagoLabel" aria-hidden="true">
  <form method="post">  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="marcarComoPagoLabel">Pagamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Realmente deseja Marcar esta <span id="span"></span> Parcela como <b>PAGA</b>?
        <input type="hidden" id="id" name="id" value="">
        <input type="hidden" id="IdContasPagar" name="IdContasPagar" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="Salva-marcarComoPago" value="Sim">SIM</button>
      </div>
    </div>
  </div>
  </form>
</div>

<script type="text/javascript">
  
  function toggleDivs()
  {
    const checkbox = document.getElementById('xmes');
    const botoesCartoes = document.getElementById('botoesCartoes');
    const botaoMesTodosCartoes = document.getElementById('botaoMesTodosCartoes');

    if (checkbox.checked) {
      botoesCartoes.classList.add('hidden');
      botaoMesTodosCartoes.classList.remove('hidden');
    } else {
      botoesCartoes.classList.remove('hidden');
      botaoMesTodosCartoes.classList.add('hidden');
    }
  }

  // Inicializa o estado das divs baseado no checkbox
  document.addEventListener('DOMContentLoaded', (event) => { toggleDivs(); });

  if (document.getElementById('marcarComoPago')) 
  {
    document.getElementById('marcarComoPago').addEventListener('show.bs.modal', event =>
    {
      const button = event.relatedTarget

      const ID = button.getAttribute('id-parcela')
      const IdContasPagar = button.getAttribute('IdContasPagar')

      const id2 = document.getElementById('marcarComoPago').querySelector('#id')
      const IdContasPagar2 = document.getElementById('marcarComoPago').querySelector('#IdContasPagar')
    
      id2.value = ID
      IdContasPagar2.value = IdContasPagar
      
    })
  }
</script>