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
        <p>Escolha um intervalo de Mês para exibir.</p>
      </div>

      <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="data" id="ano" autocomplete="off" value="A" <?php echo isset($_POST['data']) && $_POST['data'] == 'A' ? 'checked' : ''; echo !isset($_POST['data'])?'checked':''?>>
        <label class="btn btn-outline-secondary" for="ano">ANO</label>

        <input type="radio" class="btn-check" name="data" id="Dez/Jan" autocomplete="off" value="Dez/Jan" <?php echo isset($_POST['data']) && $_POST['data'] == 'Dez/Jan' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Dez/Jan">Dez/Jan</label>

        <input type="radio" class="btn-check" name="data" id="Jan/Fev" autocomplete="off" value="Jan/Fev" <?php echo isset($_POST['data']) && $_POST['data'] == 'Jan/Fev' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Jan/Fev">Jan/Fev</label>

        <input type="radio" class="btn-check" name="data" id="Fev/Mar" autocomplete="off" value="Fev/Mar" <?php echo isset($_POST['data']) && $_POST['data'] == 'Fev/Mar' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Fev/Mar">Fev/Mar</label>

        <input type="radio" class="btn-check" name="data" id="Mar/Abr" autocomplete="off" value="Mar/Abr" <?php echo isset($_POST['data']) && $_POST['data'] == 'Mar/Abr' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Mar/Abr">Mar/Abr</label>

        <input type="radio" class="btn-check" name="data" id="Abr/Mai" autocomplete="off" value="Abr/Mai" <?php echo isset($_POST['data']) && $_POST['data'] == 'Abr/Mai' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Abr/Mai">Abr/Mai</label>

        <input type="radio" class="btn-check" name="data" id="Mai/Jun" autocomplete="off" value="Mai/Jun" <?php echo isset($_POST['data']) && $_POST['data'] == 'Mai/Jun' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Mai/Jun">Mai/Jun</label>

        <input type="radio" class="btn-check" name="data" id="Jun/Jul" autocomplete="off" value="Jun/Jul" <?php echo isset($_POST['data']) && $_POST['data'] == 'Jun/Jul' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Jun/Jul">Jun/Jul</label>

        <input type="radio" class="btn-check" name="data" id="Jul/Ago" autocomplete="off" value="Jul/Ago" <?php echo isset($_POST['data']) && $_POST['data'] == 'Jul/Ago' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Jul/Ago">Jul/Ago</label>

        <input type="radio" class="btn-check" name="data" id="Ago/Set" autocomplete="off" value="Ago/Set" <?php echo isset($_POST['data']) && $_POST['data'] == 'Ago/Set' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Ago/Set">Ago/Set</label>

        <input type="radio" class="btn-check" name="data" id="Set/Out" autocomplete="off" value="Set/Out" <?php echo isset($_POST['data']) && $_POST['data'] == 'Set/Out' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Set/Out">Set/Out</label>
        
        <input type="radio" class="btn-check" name="data" id="Out/Nov" autocomplete="off" value="Out/Nov" <?php echo isset($_POST['data']) && $_POST['data'] == 'Out/Nov' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Out/Nov">Out/Nov</label>
        
        <input type="radio" class="btn-check" name="data" id="Nov/Dez" autocomplete="off" value="Nov/Dez" <?php echo isset($_POST['data']) && $_POST['data'] == 'Nov/Dez' ? 'checked' : '';?>>
        <label class="btn btn-outline-secondary" for="Nov/Dez">Nov/Dez</label>
      </div>
      <div class="form-check mt-3 mx-3">
        <input class="form-check-input" type="checkbox" value="xmes" id="xmes" name="xmes" <?php echo isset($_POST['xmes']) && $_POST['xmes'] == 'xmes' ? 'checked' : '';?>>
        <label class="form-check-label" for="xmes" >
          Deixar checado para buscar por Mês
        </label>
      </div>
    
      <div class="row mb-3 mt-4">
        <p class="text-primary">Escolha o cartão que deseja ver as informações. 
          <br />E caso tenha Atrasado ou Parcelas futuras abertas serão informados em vermelho!</p>
        <div>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'NUM' ? 'btn-secondary' : 'btn-light';?> btn-sm"     value="NUM"     name="cartao">Cartão Nu Mozão</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'CLICK' ? 'btn-secondary' : 'btn-light';?> btn-sm"   value="CLICK"   name="cartao">Cartão Click Mozão</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'MP' ? 'btn-secondary' : 'btn-light';?> btn-sm"      value="MP"      name="cartao">Cartão Cartão Mercado Pago</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'IT' ? 'btn-secondary' : 'btn-warning';?> btn-sm"      value="IT"      name="cartao">Cartão IT Mozão</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'NUD' ? 'btn-secondary' : 'btn-warning';?> btn-sm"     value="NUD"     name="cartao">Cartão Nu Danéla</button>
          <button type="submit" class="btn <?php echo isset($_POST['data']) && $_POST['cartao'] == 'DIGIO' ? 'btn-secondary' : 'btn-warning';?> btn-sm"   value="DIGIO"   name="cartao">Cartão Digio Danéla</button>
        </div>
        <!--div class="form-check mt-3 mx-3">
          <input class="form-check-input" type="checkbox" value="xCartao" name="xCartao" id="xCartao" <?php echo isset($_POST['xCartao']) && $_POST['xCartao'] == 'xCartao' ? 'checked' : '';?>>
          <label class="form-check-label" for="xCartao">
            Deixar checado para buscar por cartão
          </label>
        </div-->
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
      
      <?php
      if(empty($this->dados0[0])):
        echo "
        <h5>
          Não existe movimentações para o Parâmetro selecionado.
        </h5>
        ";
      else:
        echo "
        <h5>
          Informações do <b> {$this->dados0[0]['Cartao']} </b>
        </h5>
        ";
        ?>
          <div>
            <!-- cabeçalho antes do acordião -->
            <div class="row p-2 mx-1">
              <div class="col-1"></div>
              <div class="col-3">Nome</div>
              <div class="col-1">CIGLA</div>
              <div class="col-2">Data Pag</div>
              <div class="col-2">Data Compra</div>
              <div class="col-2">Valor Total</div>
              <div class="col-1 d-flex justify-content-center">Ações</div>
            </div>
            <?php
            
            foreach($this->dados0 as $key => $cartao):
            ?>
            <!-- registros do acordião -->
            <div class="row p-2 mx-1 border-bottom aberto" id="heading<?= $key;?>" data-bs-toggle="collapse" data-bs-target="#cartao<?= $key;?>" aria-expanded="true" aria-controls="cartao<?= $key;?>">
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
                  " <button type='button' class='btn btn-warning btn-sm' tabela='parcelas' id-parcela='{$cartao['id']}' IdContasPagar='{$cartao['IdContasPagar']}' data-bs-toggle='modal' data-bs-target='#marcarComoPago'>
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
        <input type="hidden" id="tabela" name="tabela" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="Salva-marcarComoPago" value="Sim">SIM</button>
      </div>
    </div>
  </div>
  </form>
</div>

<script type="text/javascript">
  if (document.getElementById('marcarComoPago')) 
  {
    document.getElementById('marcarComoPago').addEventListener('show.bs.modal', event =>
    {
      const button = event.relatedTarget

      const ID = button.getAttribute('id-parcela')
      const IdContasPagar = button.getAttribute('IdContasPagar')
      const tabela = button.getAttribute('tabela')

      const id2 = document.getElementById('marcarComoPago').querySelector('#id')
      const IdContasPagar2 = document.getElementById('marcarComoPago').querySelector('#IdContasPagar')
      const tabela2 = document.getElementById('marcarComoPago').querySelector('#tabela')
      
      id2.value = ID
      IdContasPagar2.value = IdContasPagar
      tabela2.value = tabela
      
    })
  }
</script>