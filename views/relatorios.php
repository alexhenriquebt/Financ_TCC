<?php
require_once '../model/classe_despesa.php';
require_once '../model/classe_receita.php';
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


$desNome = array_column($despesa->buscarDespesas(), 'desNome');
$desValor = array_column($despesa->buscarDespesas(), 'desValor');

$recNome = array_column($receita->buscarReceitas(), 'recNome');
$recValor = array_column($receita->buscarReceitas(), 'recValor');

require_once '../model/validador_acesso.php';
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
    <!-- navbar lateral -->
    <?php require_once '../utils/navbar_lateral.php' ?>

    <div class="col-10">
      <!-- user icon, navbar mobile e as notificações -->
      <?php require_once '../utils/navbar_mobile.php' ?>

      <!-- ------------------------- PARTE DAS DESPESAS ------------------------- -->
      <div class="container p-5">
        <h2>Despesas</h2>
        <div class="row">
          <div class="col-12 col-md-6">
            <!-- gráfico de linha início-->
            <div class="w-75">
              <canvas id="princDespesa_chart"></canvas>
            </div>
            <!-- gráfico de linha fim -->
          </div>
          <div class="col-12 col-md-6">
            <h2>Principais despesas</h2>
            <div class="container h-100">
              <div class="row h-100">
                <?php if ($mensagemDespesa == 'true') {
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
                  <div>
                    <h5 class="text-secondary mt-3">Nenhuma despesa adicionada</h5>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
          <div class="col-12 mt-5">
            <h3>Por categoria:</h3>
          </div>
        </div>
      </div>

      <!-- ver mais despesas -->
      <div class="text-center fs-3 mb-5">
        <a href="orcamentos.php">
          Ver minhas despesas
        </a>
      </div>
      <!-- ------------------------- PARTE DAS DESPESAS fim ------------------------- -->

      <!-- ------------------------- PARTE DAS RECEITAS ------------------------- -->
      <div class="container p-5">
        <h2>Receitas</h2>
        <div class="row">
          <div class="col-12 col-md-6">
            <!-- gráfico de linha início-->
            <div class="w-75">
              <canvas id="princReceita_chart"></canvas>
            </div>
            <!-- gráfico de linha fim -->
          </div>
          <div class="col-12 col-md-6">
            <h2>Principais receitas</h2>
            <div class="container h-100">
              <div class="row h-100">
                <?php if ($mensagemReceita == 'true') {
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
                  <div>
                    <h5 class="text-secondary mt-3">Nenhuma receita adicionada</h5>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
          
          <div class="col-12 mt-5">
            <h3>Por categoria:</h3>
          </div>
        </div>
      </div>


      <!-- ver mais receitas -->
      <div class="text-center fs-3 mb-5">
        <a href="receitas.php" class="">Ver minhas receitas
        </a>
      </div>
      <!-- ------------------------- PARTE DAS RECEITAS fim ------------------------- -->

      <div class="text-center tela-final">
        <img src="../img/homem_segurando_grafico.png" class="img-fluid w-25" alt="">
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
  const ctxPrincDesp = document.getElementById("princDespesa_chart").getContext('2d');
  const ctxPrincRec = document.getElementById("princReceita_chart").getContext('2d');

  // Dados para gráficos
  const desNomeData = <?php echo json_encode($desNome); ?>;
  const desValorData = <?php echo json_encode($desValor); ?>;

  const recNomeData = <?php echo json_encode($recNome); ?>;
  const recValorData = <?php echo json_encode($recValor); ?>;

  /* Gráfico de Despesas */
  new Chart(ctxPrincDesp, {
    type: "pie",
    data: {
      labels: desNomeData,
      datasets: [{
        label: "Valor",
        data: desValorData,
      }],
    },
  });

  /* Gráfico de Receitas */
  new Chart(ctxPrincRec, {
    type: "pie",
    data: {
      labels: recNomeData, // Corrigido para usar os nomes das receitas
      datasets: [{
        label: "Valor",
        data: recValorData,
      }],
    },
  });

</script>
<!-- ------------------------- script do gráfico fim ------------------------- -->

<script src="../js/relatorios.js"></script>
<script src="../js/popup_notificacoes.js"></script>

</html>