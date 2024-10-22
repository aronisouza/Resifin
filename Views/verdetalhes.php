<?php

  //getPreA($this->dados0);
  //getPreA($this->dados1);
  $valoresPermitidos = ['Pagamento', 'Vale', 'Aluguel', 'Terapia', 'Outras Entradas'];
?>
<div class="container-md mt-5">
 DETALHES [ Gasto / Dimdim ]

  <div class="row">
    
    <div class="col-md-8 mt-3">
      <div class="row">

        <ul class="list-group">
          <li class="list-group-item active"><?= in_array($this->dados0['TipoEntrada'], $valoresPermitidos)?'Entrada de Dinheiro':'Pagamento de Conta';?></li>
          <li class="list-group-item"><?= $this->dados0['Nome']?></li>
        </ul>

        <?php 
          if($this->dados0['Status'] !='Dinheiro em Caixa'):
        ?>
        <ul class="list-group my-3">
          <li class="list-group-item bg-secondary">Valores e parcelas a serem pagas</li>
          <li class="list-group-item">
            <div class="row align-items-start">
              <div class="col-4">
                Vencimento
              </div>
              <div class="col-4">
                Parcela
              </div>
              <div class="col-2">
                Valor
              </div>
              <div class="col-2 d-flex justify-content-center">-</div>
            </div>
          </li>

          <?php // CASO TENHA PARCELAMENTOS
            foreach($this->dados1 as $dado):
              $_corLista = 'list-group-item-light';
              if($dado['DataPagamento'] < date('Y-m-d') && $dado['FaturaPaga']==0) $_corLista = 'list-group-item-danger';
              if($dado['FaturaPaga'] == 1) $_corLista = 'list-group-item-success';
          ?>
            <li class="list-group-item list-group-item-action <?= $_corLista;?>">
              <div class="row">
                <div class="col-4">
                  <?= $dado['DataPagamento']; ?>
                </div>
                <div class="col-4">
                <?= $dado['ParcelaAtual'] .'/'.$this->dados0['QuantidadeParcelas'] ?>
                </div>
                <div class="col-2">
                  R$ <?= number_format($dado['Valor'], 3, ',', '.') ?>
                </div>
                <div class="col-2 d-flex justify-content-center">
                <?= $dado['FaturaPaga'] == 0 ? "
                    <button type='button' class='btn btn-outline-secondary btn-sm' tabela='parcelas'  id-parcela='{$dado['id']}' IdContasPagar='{$dado['IdContasPagar']}' data-bs-toggle='modal' data-bs-target='#marcarComoPago'>
                      PAGAR
                    </button>
                  ": getIco('currency-dollar', 'text-success', '20');
                ?>
                </div>
              </div>
            </li>
          <?php
            endforeach;
          ?>

          <?php // Caso não tenha parcelamento
            if(!isset($this->dados1[0])):
              $_corLista = 'list-group-item-light';
              if($this->dados0['DataPrimeiraParcela'] < date('Y-m-d') && $this->dados0['Status'] != 'Pago') $_corLista = 'list-group-item-danger';
              if($this->dados0['Status']=='Pago') $_corLista = 'list-group-item-success';
          ?>
            <li class="list-group-item list-group-item-action <?= $_corLista;?>">
              <div class="row">
                <div class="col-4">
                  <?= $this->dados0['DataPrimeiraParcela']; ?>
                </div>
                <div class="col-4">
                <?= $this->dados0['QuantidadeParcelas'] .'/'.$this->dados0['QuantidadeParcelas'] ?>
                </div>
                <div class="col-2">
                  R$ <?= number_format($this->dados0['Valor'], 3, ',', '.') ?>
                </div>
                <div class="col-2 align-middle">
                  <?= $this->dados0['Status'] != 'Pago' ? "
                    <button type='button' class='btn btn-outline-secondary btn-sm' tabela='entradas' id-parcela='{$this->dados0['id']}' IdContasPagar='{$this->dados0['id']}' data-bs-toggle='modal' data-bs-target='#marcarComoPago'>
                      PAGAR
                    </button>
                    ": getIco('currency-dollar', 'text-success', '20');
                  ?>
                </div>
              </div>
            </li>
          <?php
            endif;
          ?>

        </ul>
        <?php
          endif;
        ?>
      
      </div>
    </div>




    <div class="col-md-4 mt-3">



        <div class="card bg-light bg-gradient">
          <div class="card-body">
            <h5 class="card-title">Valor TOTAL</h5>
            <p class="card-text text-center fs-3">R$ <?= number_format($this->dados0['Valor'], 3, ',', '.');?></p>
            
            <h5 class="card-subtitle mb-2 text-muted">Descrição</h5>
            <p class="card-text p-2"><?= $this->dados0['Descricao']?></p>
            <?php if($this->dados0['CartaoCigla'] !=''): ?>
              <h5 class="card-subtitle text-muted">Cartão</h5>
              <p class="card-text p-1"><?= '[ '.$this->dados0['CartaoCigla'].' ] '.$this->dados0['MetodoPagamento']?></p>
            <?php endif; ?>
            <p><h5 class="card-subtitle text-muted">Tipo de Entrada</h5></p>
            <p class="card-text p-1"><?= $this->dados0['TipoEntrada']?></p>
            <h5 class="card-subtitle text-muted">Status</h5>
            <p class="card-text p-1"><?= $this->dados0['Status']?></p>
            <h5 class="card-subtitle text-muted">Data da Compra</h5>
            <p class="card-text p-1"><?= $this->dados0['DataEntrada']?></p>
          </div>
        </div>


        
    </div>
    
   




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


  var myToastEl = document.getElementById('myToast')
    myToastEl.addEventListener('hidden.bs.toast', function () {
      toast.show()
    })
</script>