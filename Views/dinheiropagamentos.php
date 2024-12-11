<div class="container-md mt-3">

  <div class="row">
    <h4>Movimentações financeiras</h4>
    <p>Registros de todos os PAGAMENTOS em dinheiro</p>
  </div>

  <div class="row">
    <div class="alert alert-light shadow-sm p-3 mb-5 bg-body rounded" role="alert">
      <h5>Entradas</h5>
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
            <th scope="col" style="text-align: center;">Status</th>
            <th scope="col" style="text-align: center;">Dia Pagamento</th>
            <th scope="col" style="text-align: center;">Valor</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if($this->dados[0] != 0 && is_array($this->dados[0]))
            {
              foreach($this->dados[0] as $dadoe)
              { ?>
                  <tr class="table">
                    <td style="text-align: center;">
                      <a type="button" class="btn btn-link" href="/verdetalhes/index/<?php echo $dadoe['IdContasPagar'];?>">
                        <?php getIco('aspect-ratio','text-dark',26); ?>
                      </a>
                    </td>
                    <td>
                      <?php
                      echo $dadoe['Nome']; 
                      ?>
                    </td>
                    <td><?php echo $dadoe['Status']; ?></td>
                    <td style="text-align: center;"><?php echo $dadoe['DataPagamento']; ?></td>
                    <td style="text-align: center;">R$ <?= number_format($dadoe['Valor'], 2, ',', '.'); ?></td>
                  </tr>
                <?php 
              }
            }
           } ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
