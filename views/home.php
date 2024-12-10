<?php
 require_once '../model/validarAcesso.php';
 require_once '../model/classeCentroCusto.php';
 $classeCentroCusto = new CentroCusto();
//pega o nome do usuário
 $usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../css/home.css" />
  <link rel="shortcut icon" href="../assets/images/iconTituloPg.png" />
  <title>Home</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div class="row g-3 m-0">
    <!-- navbar lateral -->
    <?php require_once '../utils/navbarLateral.php' ?>

    <div class="col-10">
      <!-- user icon, navbar mobile e as notificações -->
      <?php require_once '../utils/header.php' ?>

      <div class="container mt-3 mb-5">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
          <button class="btn btn-danger" type="submit">Pesquisar</button>
        </form>
      </div>
      <div class="container mb-3">
        <div class="row bloco-saudacoes text-center">
          <div class="col-6">
            <p>
              Oi,
               <?php echo $usuario ?>
            </p>
          </div>
          <div class="col-6">
            <img src="../assets/images/pessoaAcenandoSemFundo.png" alt="pessoa acenando" class="img-fluid" />
          </div>
        </div>

        <!-- -------- Bloco de saudações para mobile --------- -->
        <div class="bloco-saudacoes-mobile">
          <p class="display-6">
            Oi,
            <?php
            echo $usuario
            ?>
          </p>
        </div>
        <!-- -------- Bloco de saudações para mobile --------- -->
      </div>

      <div class="container mt-3 mb-5">
        <div class="row g-3">

          <div class="col-12 col-lg-6">
            <div class="container-estilizado">
              <h5>Despesas do mês</h5>
              <div class="container mt-5 mb-0">
                <div class="row">
                  <div class="col-12 col-md-6 p-3">
                    <canvas id="despesas"></canvas>
                  </div>
                  <div class="col-12 col-md-6">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid quae quasi minima autem est ipsa repellat veritatis repellendus debitis accusantium.</p>
                  </div>
                </div>
              </div>
            </div>


            <div class="container-estilizado mt-3">
              <h5>Receitas do mês</h5>
              <div class="container mt-5 mb-0">
                <div class="row">
                  <div class="col-12 col-lg-6 p-3">
                    <canvas id="receitas"></canvas>
                  </div>
                  <div class="col-12 col-lg-6">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid quae quasi minima autem est ipsa repellat veritatis repellendus debitis accusantium.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6">
            
            <div class="container-estilizado">
              <h5>Metas</h5>
              <div class="container mt-5 mb-0">
                <div class="row">
                  <i class="bi bi-check2-circle col-2 text-black"></i>
                  <p class="col-8">Comprar um carro</p>
                  <hr>
                  <i class="bi bi-check2-circle col-2 text-black"></i>
                  <p class="col-8">1.000 reais investidos</p>
                  <hr>
                  <i class="bi bi-check2-circle col-2 text-black"></i>
                  <p class="col-8">20.000 de reserva de emergência</p>
                  <hr>
                  <i class="bi bi-check2-circle col-2 text-black"></i>
                  <p class="col-8">Reforma da casa</p>
                  <hr>
                </div>
              </div>
            </div>

            <div class="container-estilizado mt-3">
              <a href="centroCusto.php">
                <h5>Ir para contas <i class="bi bi-box-arrow-up-right text-black"></i></h5>
              </a>
            </div>

          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <script src="../js/popover.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // const patrimonioData = <?php echo json_encode($historicoPatrimonio); ?>

    const ctxDespesas = document.getElementById("despesas");

    new Chart(ctxDespesas, {
    type: 'doughnut',
    data: {
      labels: ['Compras do mês', 'Manutenção da moto', 'Viagem para Londres'],
      datasets: [{
        label: 'Valor(em R$)',
        data: [450, 190, 800],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });



  const ctxReceitas = document.getElementById('receitas');

  new Chart(ctxReceitas, {
    type: 'doughnut',
    data: {
      labels: ['Salário', 'Investimentos', 'Meu comércio'],
      datasets: [{
        label: 'Valor(em R$)',
        data: [2400, 400, 7000],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  </script>
</body>

</html>