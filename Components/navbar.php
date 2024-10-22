<?php
  if(DBSA == 'bk_resifin')
  {
    echo '<div class="text-center p-3" style="background-color: #e58844;">
    <p>USANDO BANCO DE TESTE</p>
    </div>';
  }
  echo '
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #4b85a5;">

  <div class="container-md">
    <a class="navbar-brand" href="/home/index">';getIco('RESIFIN','text-light','40'); echo'</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mês
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item"><a class="nav-link" href="/home/Mes/a">Mês passado</a></li>
            <li class="nav-item"><a class="nav-link" href="/home/Mes/m">Este mês</a></li>
            <li class="nav-item"><a class="nav-link" href="/home/Mes/p">Próximo Mês</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dinheiro
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item"><a class="nav-link" href="/dinheiroentradas">Entradas</a></li>
            <li class="nav-item"><a class="nav-link" href="/dinheiroentradas/saidas">Pagamentos</a></li>
          </ul>
        </li>
      
        <!--li class="nav-item">
          <a class="nav-link" href="/home/Personalizado">Personalizado</a>
        </li-->

        <li class="nav-item">
          <a class="nav-link" href="/cartoes">Cartões</a>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Lançar
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/financa/entrada">Lançar Entrada Dimdim</a></li>
            <li><a class="dropdown-item" href="/financa/saida">Lançar Conta a Pagar</a></li>
          </ul>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ferramentas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
          $ler = new Read;
          $ler->FullRead("SELECT * FROM ferramenta");
          echo "
            <li><button class='dropdown-item' data-bs-toggle='modal' data-bs-target='#modalshow' data-tipo='Cartao' data-dados='{$ler->getResult()[0]['Cartao']}'>Cadastro Cartão</button></li>
            <li><button class='dropdown-item' data-bs-toggle='modal' data-bs-target='#modalshow' data-tipo='Entrada' data-dados='{$ler->getResult()[0]['Entrada']}'>Cadastro Entradas</button></li>
            <li><button class='dropdown-item' data-bs-toggle='modal' data-bs-target='#modalshow' data-tipo='Saida' data-dados='{$ler->getResult()[0]['Saida']}'>Cadastro Saidas</button></li>
          ";
          echo '
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="Pesquisar" placeholder="Pesquisar" aria-label="Pesquisar">
        <button class="btn btn-primary" type="submit">Pesquisar</button>
      </form>
    </div>
  </div>
</nav>
  ';
  
