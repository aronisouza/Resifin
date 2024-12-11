<div class="container-md mt-3">

  <div class="row">
    <h4>Movimentações financeiras</h4>
    <p>Registros de todas as entradas de dinheiro</p>
    <p>Pagamento; Vale; Aluguel; Terapia; Outras Entradas;</p>
  </div>

  <form method="post">
    <div class="row shadow-sm bg-body rounded mb-3">
      
      <div class="row mt-3">
        <p><strong>Parâmetro de pesquisa</strong></p>
        <p>Escolha um Mês para exibir.</p>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-secondary btn-sm" value="Jan"   name="mesdimentrada">Jan</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Feb"   name="mesdimentrada">Fev</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Mar"   name="mesdimentrada">Mar</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Apr"   name="mesdimentrada">Abr</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="May"   name="mesdimentrada">Mai</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Jun"   name="mesdimentrada">Jun</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Jul"   name="mesdimentrada">Jul</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Aug"   name="mesdimentrada">Ago</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Sep"   name="mesdimentrada">Set</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Oct"   name="mesdimentrada">Out</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Nov"   name="mesdimentrada">Nov</button>
        <button type="submit" class="btn btn-secondary btn-sm" value="Dec"   name="mesdimentrada">Dez</button>
      </div>
      
    </div>
  </form>

  <div class="row">
    <div class="alert alert-light shadow-sm p-3 mb-5 bg-body rounded" role="alert">
      <h5>Entradas</h5>
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
            <th scope="col" style="text-align: center;">Tipo de entrada</th>
            <th scope="col" style="text-align: center;">Dia que entrou</th>
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
                      <a type="button" class="btn btn-link" href="/verdetalhes/index/<?php echo $dadoe['id'];?>">
                        <?php getIco('aspect-ratio','text-dark',26); ?>
                      </a>
                    </td>
                    <td>
                      <?php
                      echo $dadoe['Nome']; 
                      ?>
                    </td>
                    <td><?php echo $dadoe['TipoEntrada']; ?></td>
                    <td style="text-align: center;"><?php echo $dadoe['DataEntrada']; ?></td>
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
