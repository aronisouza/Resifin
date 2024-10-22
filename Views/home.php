<?php 

  $valoresPermitidos = ['Pagamento', 'Vale', 'Aluguel', 'Terapia', 'Outras Entradas'];
  $DimCaixa=$this->dados1[0]['Valores Entrada'] != ""?$this->dados1[0]['Valores Entrada']:0.00;
  $Pendente=$this->dados2[0]['Valores Pendentes'] != ""?$this->dados2[0]['Valores Pendentes']:0.00;
  $Pago=$this->dados3[0]['Valores Pagos'] != ""?$this->dados3[0]['Valores Pagos']:0.00;

?>
<div class="container-md mt-3">

  <div class="row">
    <h4>Movimentações financeiras</h4>
    <p>Registros <?= $this->dados4['dado']; ?></p>
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
    if($this->dados4['showPag'] == 1):
    ?>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <?php
          if(isset($this->dados5) && $this->dados5>0 && $this->dados4['showPag'] == 1):
            ?>
            <li class="page-item"><a class="page-link" href="<?= URL.'home/index/'.$this->dados5?>">&laquo;</a></li>
            <?php
          endif;

          for($i=1;$i <= $this->dados8;$i++):
            ?>
              <li class="page-item">
                <a class="page-link <?= $this->dados5+1 == $i? 'active':''?>" href="<?= URL.'home/index/'.$i?>"><?= $i?></a>
              </li>
            <?php 
          endfor;

          if($this->dados7 < $this->dados8 && $this->dados4['showPag'] == 1):
            ?>
            <li class="page-item"><a class="page-link" href="<?= URL.'home/index/'.$this->dados6?>">&raquo;</a></li>
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
        if(empty($this->dados0)) echo '<div class="shadow-sm p-3 mb-5 bg-body rounded mt-4">Nenhum dados retornado pelo sistema!</div>';
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
            //  exibe as entras de dinheiro
            
            if($this->dados5 != 0 && is_array($this->dados5))
            {
              foreach($this->dados5 as $dadoe)
              { ?>
                  <tr class="table-success">
                    <td style="text-align: center;">
                      <a type="button" class="btn btn-link" href="/verdetalhes/index/<?php echo $dadoe['id'];?>">
                        <?php getIco('aspect-ratio','text-dark',26); ?>
                      </a>
                    </td>
                    <td>
                      <?php
                      echo in_array($dadoe['TipoEntrada'], $valoresPermitidos)? getIco('arrow-up-short','text-success', 26): getIco('arrow-down-short','text-danger', 26);
                      echo $dadoe['Nome']; 
                      ?>
                    </td>
                    <td><?php echo $dadoe['DataEntrada']; ?></td>
                    <td style="text-align: center;">Não tem</td>
                    <td style="text-align: center;">R$ <?= number_format($dadoe['Valor'], 2, ',', '.'); ?></td>
                  </tr>
                <?php 
              }
            }
            //  exibe as contas para pagar
            foreach($this->dados0 as $dado):
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
