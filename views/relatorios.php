<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../css/relatorio.css">
  <link rel="shortcut icon" href="../assets/images/iconTituloPg.png" />
  <title>Seus relatórios</title>
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

      <div class="container p-5">
        <h2 class="mb-5">Resumo do ano</h2>
        <div class="col-6">
          <?php
          require_once "../utils/filtro.php";
          ?>
        </div>

        <div class="row mt-5">

          <div class="col-12 col-md-7">

            <div class="container-estilizado">
              <canvas id="saldoVariacoes"></canvas>
            </div>

            <div class="container-estilizado mt-3">
              <h5>Despesas</h5>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Tipo</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Atualizado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>

                    </td>
                    <td>Mark</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="container-estilizado mt-3">
              <h5>Receitas</h5>
              <?php
              require_once "../utils/filtro.php";
              ?>
              <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">Situação</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Atualizado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <i class="bi bi-check-circle-fill text-success"></i>
                    </td>
                    <td>Recebimento de fevereiro</td>
                    <td>05/02/2024</td>
                    <td>03/01/2024</td>
                  </tr>
                  <tr>
                    <td>
                      <i class="bi bi-check-circle-fill text-success"></i>
                    </td>
                    <td>Recebimento de fevereiro</td>
                    <td>05/02/2024</td>
                    <td>03/01/2024</td>

                  </tr>
                  <tr>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-12 col-md-5 text-center">
            <div class="container-estilizado">
              <h5>Maiores gastos</h5>
              <div class="container mt-5 mb-0">
                <div class="row">
                  <p class="col-6">Escola particular</p>
                  <p class="col-6">R$800,00</p>
                  <hr>
                  <p class="col-6">Compras de janeiro</p>
                  <p class="col-6">R$760,00</p>
                  <hr>
                  <p class="col-6">Passagem de trem</p>
                  <p class="col-6">R$290,00</p>
                  <hr>
                  <p class="col-6">Passagem de ônibus</p>
                  <p class="col-6">R$250,00</p>
                  <hr>
                </div>
              </div>
            </div>

            <div class="container-estilizado mt-3">
              <h5>Maiores recebimentos</h5>
              <div class="container mt-5 mb-0">
                <div class="row">
                  <p class="col-6">Recebimento de janeiro</p>
                  <p class="col-6">R$3800,00</p>
                  <hr>
                  <p class="col-6">Dividendos de FIs</p>
                  <p class="col-6">R$230,00</p>
                  <hr>
                  <p class="col-6">Rendimento dos CDBs, LCIs</p>
                  <p class="col-6">R$240,00</p>
                  <hr>
                  <p class="col-6">Rendimento do tesouro direto</p>
                  <p class="col-6">R$119,00</p>
                  <hr>
                </div>
              </div>
            </div>

            <div class="container-estilizado mt-3">
              <h5>Metas alcançadas</h5>
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
          </div>

        </div>

        <div class="container">
          <h2 class="mt-5 mb-5">Pendências</h2>
          <div class="row g-5 text-center">
            <div class="col-12 col-md-5 container-estilizado mx-3">
              <h5>Dívidas</h5>
              <div class="container mt-5 mb-0">
                <div class="row">
                  <p class="col-6">Recebimento de janeiro</p>
                  <p class="col-6">R$3800,00</p>
                  <hr>
                  <p class="col-6">Dividendos de FIs</p>
                  <p class="col-6">R$230,00</p>
                  <hr>
                  <p class="col-6">Rendimento dos CDBs, LCIs</p>
                  <p class="col-6">R$240,00</p>
                  <hr>
                  <p class="col-6">Rendimento do tesouro direto</p>
                  <p class="col-6">R$119,00</p>
                  <hr>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-5 container-estilizado mx-3">
              <h5>A receber</h5>
              <div class="container mt-5 mb-0 text-center">
                <div class="row">
                  <p class="col-6">Recebimento de janeiro</p>
                  <p class="col-6">R$3800,00</p>
                  <hr>
                  <p class="col-6">Dividendos de FIs</p>
                  <p class="col-6">R$230,00</p>
                  <hr>
                  <p class="col-6">Rendimento dos CDBs, LCIs</p>
                  <p class="col-6">R$240,00</p>
                  <hr>
                  <p class="col-6">Rendimento do tesouro direto</p>
                  <p class="col-6">R$119,00</p>
                  <hr>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-5 container-estilizado mx-3">
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
          </div>
        </div>

      </div>
      <div class="container p-5">
        <h2 class="mb-5">Previsões</h2>

        <div class="row g-5">
          <div class="col-12 col-md-6">

            <div class="row g-3">

              <div class="col-12 container-estilizado">
                <h5>Despesas</h5>
                <div class="container mt-5 mb-0">
                  <div class="row">
                    <p class="col-12">Compras no supermercado</p>
                    <p class="col-6">R$5100,00</p>
                    <p class="col-6 text-success">+0,30%</p>
                    <hr>
                    <p class="col-12">Conta de água e luz</p>
                    <p class="col-6">R$230,00</p>
                    <p class="col-6 text-success">+2,34%</p>
                    <hr>
                    <p class="col-12">Produtos de limpeza</p>
                    <p class="col-6">R$240,00</p>
                    <p class="col-6 text-danger">-0,19%</p>
                    <hr>
                    <p class="col-12">Manutenção da moto</p>
                    <p class="col-6">R$119,00</p>
                    <p class="col-6 text-danger">-12,06%</p>
                    <hr>
                  </div>
                </div>
              </div>

              <div class="col-12 container-estilizado">
                <h5>Possíveis riscos</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea magnam impedit, laborum nulla vero labore magni similique aliquid facilis modi! Amet a inventore doloribus quaerat voluptate eos corporis labore architecto?</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="container-estilizado">
              <h5>Recomendações</h5>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis voluptatibus quos voluptatum, placeat tempora esse assumenda fuga ratione optio ipsa, facilis corrupti eligendi doloremque. Quaerat obcaecati vitae nostrum sapiente. Voluptate.lore. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto incidunt doloribus est, aperiam voluptas vero corrupti in assumenda voluptates exercitationem! Iure, odio. Est, voluptate natus distinctio deserunt nobis saepe ipsam.</p>
            </div>
          </div>
        </div>


      </div>
    </div>



  </div>
  </div>
</body>

</html>

<script>
  const ctxSaldoVariacoes = document.getElementById('saldoVariacoes');

  new Chart(ctxSaldoVariacoes, {
    type: 'line',
    data: {
      labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      datasets: [{
        label: 'Balanço mensal',
        data: [12, 19, 3, 5, 2, 3, -40, -20, 50],
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