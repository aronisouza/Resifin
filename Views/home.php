<?php

  $valoresPermitidos = ['Pagamento', 'Vale', 'Aluguel', 'Terapia', 'Outras Entradas'];
  $DimCaixa=$this->dados[1][0]['Valores Entrada'] != ""?$this->dados[1][0]['Valores Entrada']:0.00;
  $Pendente=$this->dados[2][0]['Valores Pendentes'] != ""?$this->dados[2][0]['Valores Pendentes']:0.00;
  $Pago=$this->dados[3][0]['Valores Pagos'] != ""?$this->dados[3][0]['Valores Pagos']:0.00;

?>
<div class="container-md mt-3">

  <div class="row">
    <h4>Movimentações financeiras</h4>
    <p>Registros <?= $this->dados[4]['dado']; ?></p>
  </div>

  <div class="row-12 d-flex justify-content-between">

    <div class="col-md-3 card border-dark mb-3">
      <div class="card-body text-dark">
        <h5 class="card-title">R$ <?= number_format($DimCaixa, 2, ',', '.'); ?></h5>
        <p class="card-text">Valores de entrada</p>
      </div>
    </div>


    <div class="col-md-3 card border-success mb-3 mx-1">
      <div class="card-body text-success">
        <h5 class="card-title <?php if($DimCaixa-$Pago < 0) echo 'text-danger'; ?>">R$ <?= number_format($DimCaixa-$Pago, 2, ',', '.'); ?></h5>
        <p class="card-text">Dinheiro em Caixa</p>
      </div>
    </div>

    <div class="col-md-3 card border-primary mb-3 me-1">
      <div class="card-body text-primary">
        <h5 class="card-title">R$ <?= number_format($Pago, 2, ',', '.'); ?></h5>
        <p class="card-text">Valores Pagos</p>
      </div>
    </div>


    <div class="col-md-3 card border-danger mb-3">
      <div class="card-body text-danger ">
        <h5 class="card-title">R$ <?= number_format($Pendente, 2, ',', '.'); ?></h5>
        <p class="card-text">Pendente</p>
      </div>
    </div>
  </div>

  <?php
    if($this->dados[4]['showPag'] == 1):
    ?>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <?php
          if(isset($this->dados[5]) && $this->dados[5]>0 && $this->dados[4]['showPag'] == 1):
            ?>
            <li class="page-item"><a class="page-link" href="<?= URL.'home/index/'.$this->dados[5]?>">&laquo;</a></li>
            <?php
          endif;

          for($i=1;$i <= $this->dados[8];$i++):
            ?>
              <li class="page-item">
                <a class="page-link <?= $this->dados[5]+1 == $i? 'active':''?>" href="<?= URL.'home/index/'.$i?>"><?= $i?></a>
              </li>
            <?php 
          endfor;

          if($this->dados[7] < $this->dados[8] && $this->dados[4]['showPag'] == 1):
            ?>
            <li class="page-item"><a class="page-link" href="<?= URL.'home/index/'.$this->dados[6]?>">&raquo;</a></li>
            <?php 
          endif;
        ?>
      </ul>
    </nav>
    <?php 
    endif;
  ?>

  <div class="row">
    <div class="alert alert-light shadow-sm p-3 mb-5 bg-body rounded" role="alert">
      <h5>Entradas e Saidas</h5>

      <?php 
        if(empty($this->dados[0])) echo '<div class="shadow-sm p-3 mb-5 bg-body rounded mt-4">Nenhum dados retornado pelo sistema!</div>';
        else
        {
      ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col" style="text-align: center;">#</th>
            <th scope="col">Nome Transação</th>
            <th scope="col" style="text-align: center;">Data Pagamento</th>
            <th scope="col" style="text-align: center;">Quantidade de Parcelas</th>
            <th scope="col" style="text-align: center;">Valor</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($this->dados[0] as $dado):
          ?>
              <tr>
                <td style="text-align: center;">
                  <a type="button" class="btn btn-link" href="/verdetalhes/index/<?php echo $dado['IdContasPagar'];?>">
                    <?php getIco('aspect-ratio','text-dark',26); ?>
                  </a>
                </td>
                <td>
                  <?php
                  echo in_array($dado['TipoEntrada'], $valoresPermitidos)? getIco('arrow-up-short','text-success', 26): getIco('arrow-down-short','text-danger', 26);
                  echo $dado['Nome']; 
                  ?>
                </td>
                <td><?php echo $dado['DataPagamento']; ?></td>
                <td style="text-align: center;"><?php echo $dado['QuantidadeParcelas'] == 0 ? '': ' '.$dado['ParcelaAtual'] .'/'. $dado['QuantidadeParcelas']; ?></td>
                <td style="text-align: center;"><?php if($dado['Status'] =='Pago') echo getIco('currency-dollar','text-success', 16);  ?> R$ <?= number_format($dado['Valor'], 4, ',', '.'); ?></td>
              </tr>
            <?php 
            endforeach;
           } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
