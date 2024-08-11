<?php
require_once '../php/classe_despesa.php';
require_once '../php/classe_receita.php';
$despesa = new Despesa();
$receita = new Receita();
$princDespesas = $despesa->principaisDespesas();
$princReceitas = $receita->principaisReceitas();

if (count($princDespesas) > 0) {
  $mensagemDespesa = 'true';
} else {
  $mensagemDespesa = 'false';
}

if (count($princReceitas) > 0) {
  $mensagemReceita = 'true';
} else {
  $mensagemReceita = 'false';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../css/relatorio.css">
  <link rel="shortcut icon" href="../img/icon_title.png" />
  <title>Seus relatórios</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div class="row g-3 m-0">
    <!-- volume para dar espaçamento -->
    <div class="col-2 navbar-lateral-fantasma">
      <!-- sem conteúdo aqui dentro -->
    </div>

    <!-- ------------------------- navbar-lateral fixada ------------------------- -->
    <div class="navbar-lateral text-center m-0">
      <div class="row g-5">
        <div class="col-12">
          <a href="home.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Home">
            <img src="../img/icon_title.png" alt="" class="img-fluid" />
          </a>
        </div>
        <div class="col-12">
          <a href="orcamentos.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Orçamentos">
            <i class="bi bi-cash-coin"></i>
          </a>
        </div>
        <div class="col-12">
          <a href="despesas.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Despesas">
            <i class="bi bi-graph-down-arrow"></i>
          </a>
        </div>
        <div class="col-12">
          <a href="receitas.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Receitas">
            <i class="bi bi-graph-up-arrow"></i>
          </a>
        </div>
        <div class="col-12">
          <a href="relatorios.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Relatórios">
            <i class="bi bi-graph-up"></i>
          </a>
        </div>
        <div class="col-12">
          <a href="configuracoes.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Configurações">
            <i class="bi bi-gear"></i>
          </a>
        </div>
        <div class="col-12">
          <a href="ajuda.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Ajuda">
            <i class="bi bi-info-circle"></i>
          </a>
        </div>
      </div>
    </div>
    <!-- ------------------------- navbar-lateral fixada fim ------------------------- -->

    <div class="col-10">
      <!-- ------------------------- CABEÇALHO DA PG ------------------------- -->
      <header>
        <div class="container">
          <div class="row">
            <div class="col-6">
              <div class="titulo-bloco">
                <h2 class="mt-3">Seus relatórios</h2>
              </div>
            </div>
            <div class="col-6">
              <div class="user-config">
                <div class="btn-group">
                  <button type="button" class="btn-dropdown dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                  </button>
                  <button style="border: none; background-color: white" data-bs-toggle="popover"
                    data-bs-title="Notificações" data-bs-content="Sem notificações" data-bs-placement="bottom">
                    <i class="bi bi-bell-fill"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item dropdown-item-mobile" href="home.php">Home</a>
                    </li>
                    <li>
                      <a class="dropdown-item dropdown-item-mobile" href="orcamentos.php">Orçamentos</a>
                    </li>
                    <li>
                      <a class="dropdown-item dropdown-item-mobile" href="despesas.php">Despesas</a>
                    </li>
                    <li>
                      <a class="dropdown-item dropdown-item-mobile" href="receitas.php">Receitas</a>
                    </li>
                    <li>
                      <a class="dropdown-item dropdown-item-mobile" href="relatorios.php">Relatórios</a>
                    </li>
                    <li>
                      <a class="dropdown-item dropdown-item-mobile" href="configuracoes.php">Configurações</a>
                    </li>
                    <li>
                      <a class="dropdown-item dropdown-item-mobile" href="ajuda.php">Ajuda</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../php/logoff.php">Sair</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ------------------------- CABEÇALHO DA PG fim ------------------------- -->

      <!-- ------------------------- PARTE DAS DESPESAS ------------------------- -->
      <div class="container p-5">
        <h2>Despesas</h2>
        <div class="row">
          <div class="col-12 col-md-6">
            <!-- gráfico de linha início-->
            <canvas id="princDespesa_chart"></canvas>
            <!-- gráfico de linha fim -->
          </div>
          <div class="col-12 col-md-6">
            <h2>Principais despesas</h2>
            <div class="container h-100">
              <div class="row h-100">
              <?php if($mensagemDespesa == 'true') {
                        foreach ($princDespesas as $index => $resultado) {
                ?>

                  <div class="col-12 col-md-6 col-lg-4">
                    <a href="">
                      <div class="card text-center card-despesa">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $resultado['desNome'] ?></h5>
                          <p class="card-text"><?php echo $resultado['desValor'] ?></p>
                        </div>
                      </div>
                    </a>
                  </div>

                <?php
                        } //terrmina o foreach
                  } //termina o if($mensagem)
                  else {
                ?>
              <div><h5 class="text-secondary mt-3">Nenhuma despesa adicionada</h5></div>
              <?php
                }
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ver mais despesas -->
      <div class="text-center">
        <a href="#">
          <h2>ver mais</h2>
          <i class="bi bi-caret-down-fill"></i>
        </a>
      </div>
      <!-- ------------------------- PARTE DAS DESPESAS fim ------------------------- -->

      <!-- ------------------------- PARTE DAS RECEITAS ------------------------- -->
      <div class="container p-5">
        <h2>Receitas</h2>
        <div class="row">
          <div class="col-12 col-md-6">
            <!-- gráfico de linha início-->
            <canvas id="princReceita_chart"></canvas>
            <!-- gráfico de linha fim -->
          </div>
          <div class="col-12 col-md-6">
            <h2>Principais receitas</h2>
            <div class="container h-100">
              <div class="row h-100">
              <?php if($mensagemReceita == 'true') {
                        foreach ($princReceitas as $index => $resultado) {
                ?>

                  <div class="col-12 col-md-6 col-lg-4">
                    <a href="">
                      <div class="card text-center card-receita">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $resultado['recNome'] ?></h5>
                          <p class="card-text"><?php echo $resultado['recValor'] ?></p>
                        </div>
                      </div>
                    </a>
                  </div>

                <?php
                        } //terrmina o foreach
                  } //termina o if($mensagem)
                  else {
                ?>
              <div><h5 class="text-secondary mt-3">Nenhuma receita adicionada</h5></div>
              <?php
                }
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ver mais receitas -->
      <div class="text-center">
        <a href="#">
          <h2>ver mais</h2>
          <i class="bi bi-caret-down-fill"></i>
        </a>
      </div>
      <!-- ------------------------- PARTE DAS RECEITAS fim ------------------------- -->
      
      <!-- ------------------------ PARTE ORÇAMENTOS ----------------------------------- -->

      <div class="container p-5">
        <h2>Orçamentos</h2>
        <div class="card text-center">
          <div class="card-body">
              <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Valor Planejado</th>
                      <th scope="col">Valor Gasto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Lorem</td>
                      <td>R$0.00</td>
                      <td>R$0.00</td>
                      <td>
                        <button type="button" id="abrir1">abrir</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
        </div>
        <!-- conteúdo oculto -->
        <dialog>
          <div class="container p-3">
            <div class="row g-3">
              <div class="col-12 col-md-6 mb-5">
                <!-- gráfico de linha início-->
                <canvas id="orcamento_chart"></canvas>
                <!-- gráfico de linha fim -->
              </div>
              <div class="col-12 col-md-6">
                <h2>Saldo</h2>
                <p>R$200.534,57</p>
                <h2>Despesas</h2>
                <p>Despesa 1</p>
                <p>Despesa 2</p>
                <p>Despesa 3</p>
              </div>
            </div>
          </div>
          <button>Fechar</button>
        </div>
      </dialog>


      <!-- ------------------------ PARTE ORÇAMENTOS fim ----------------------------------- -->

      <div class="text-center">
        <img src="../img/homem_segurando_grafico.png" class="img-fluid w-50" alt="">
        <h3>Parece que você chegou no fim</h3>
      </div>



    </div>
  </div>
</body>

<!-- ------------------------- Popover actions ------------------------- -->
<script>
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
<!-- ------------------------- Popover actions fim ------------------------- -->

<!-- ------------------------- script do gráfico ------------------------- -->
<script>
  const ctxPrincDesp = document.getElementById("princDespesa_chart");
  const ctxPrincRec = document.getElementById("princReceita_chart");

  /* DESPESAS */
  new Chart(ctxPrincDesp, {
    type: "pie",
    data: {
      labels: [
        "Despesa 1",
        "Despesa 2",
        "Despesa 3",
      ],
      /* Dados do gráfico */
      datasets: [
        {
          label: "Valor",
          data: [12, 10, 40],
        },

      ],
    },
  });

  /* RECEITAS */
  new Chart(princReceita_chart, {
    type: "pie",
    data: {
      labels: [
        "Despesa 1",
        "Despesa 2",
        "Despesa 3",
        "Despesa 4",
      ],
      /* Dados do gráfico */
      datasets: [
        {
          label: "Valor",
          data: [12, 10, 40, 56],
        },

      ],
    },
  });

  /* ORÇAMENTOS */
  new Chart(orcamento_chart, {
    type: "doughnut",
    data: {
      labels: [
        "Receita 1",
        "Receita 2",
        "Receita 3",
      ],
      /* Dados do gráfico */
      datasets: [
        {
          label: "Valor",
          data: [12, 10, 40],
        },

      ],
    },
  });
  console.log(labels);
</script>
<!-- ------------------------- script do gráfico fim ------------------------- -->

<script src="../js/relatorios.js"></script>
<script src="../js/popup_notificacoes.js"></script>
</html>