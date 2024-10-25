<?php
require_once "../model/classeCentroCusto.php";
require_once "../model/classeCategoria.php";
$classeCentroCusto = new CentroCusto();
$classeCategoria = new Categoria();
$maioresGastosCategoria = $classeCentroCusto->filtrarDespesasReceitasCategoria('Despesa');
$maioresRecebimentosCategoria = $classeCentroCusto->filtrarDespesasReceitasCategoria('Receita');
$listaDespesa = $classeCentroCusto->filtrarTipo('Despesa');
$listaReceita = $classeCentroCusto->filtrarTipo('Receita');
$receitas = $classeCentroCusto->somarCreditosDebitos('Receita');
$despesas = $classeCentroCusto->somarCreditosDebitos('Despesa');
$balançoMensal[] = $receitas - $despesas;

$iconesCategorias = [
  'Renda' => '<i class="bi bi-coin text-warning"></i>',
  'Investimento' => '<i class="bi bi-graph-up-arrow text-success"></i>',
  'Empréstimos' => '<i class="bi bi-bank2 text-danger"></i>',
  'Impostos e taxas' => '<i class="bi bi-file-earmark-text text-secondary"></i>',
  'Moradia' => '<i class="bi bi-house-door-fill text-primary"></i>',
  'Alimentação' => '<i class="bi bi-basket-fill text-success"></i>',
  'Transporte' => '<i class="bi bi-truck-front-fill text-primary"></i>',
  'Educação' => '<i class="bi bi-book text-primary"></i>',
  'Animais' => '<i class="bi bi-paw text-warning"></i>',
  'Viagem' => '<i class="bi bi-airplane-fill text-info"></i>',
  'Transferências e pagamentos' => '<i class="bi bi-cash-stack text-success"></i>',
  'Emergências' => '<i class="bi bi-exclamation-triangle-fill text-danger"></i>',
  'Seguros' => '<i class="bi bi-shield-lock-fill text-secondary"></i>',
  'Compras e lazer' => '<i class="bi bi-cart-fill text-info"></i>',
  'Manutenção e reparos' => '<i class="bi bi-wrench-adjustable text-warning"></i>',
  'Assinaturas' => '<i class="bi bi-card-checklist text-primary"></i>',
  'Outros' => '<i class="bi bi-three-dots text-muted"></i>',
];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../css/relatorios.css">
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
                    <th scope="col">Situação</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Atualizado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($listaDespesa as $index => $despesa) {
                  ?>
                    <tr>
                      <td class="text-center">
                        <?php

                        if ($despesa['lanSituacao'] === 'Realizado') {
                          echo '<i class="bi bi-check-circle-fill text-success"></i>';
                        } else if ($despesa['lanSituacao'] === 'Pendente') {
                          echo '<i class="bi bi-hourglass-split text-danger"></i>';
                        }
                        ?></td>
                      <td><?php echo $despesa['cenNome']; ?></td>
                      <td><?php echo $despesa['cenValor']; ?></td>
                      <td class="text-center"><?php echo $iconesCategorias[$despesa['catNome']] ?? ''; ?></td>
                      <td class="text-danger">
                        <?php echo DateTime::createFromFormat('Y-m-d', $despesa['lanVencimento'])->format('d/m/Y') ?>
                      </td>
                      <td class="text-success">
                        <?php echo DateTime::createFromFormat('Y-m-d', $despesa['hceUltimoRegistro'])->format('d/m/Y');
                        ?>
                      </td>
                    </tr>
                  <?php
                  } //foreach
                  ?>
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
                    <th scope="col">Valor</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Atualizado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($listaReceita as $index => $receita) {
                  ?>
                    <tr>
                      <td class="text-center">
                        <?php

                        if ($receita['lanSituacao'] === 'Realizado') {
                          echo '<i class="bi bi-check-circle-fill text-success"></i>';
                        } else if ($receita['lanSituacao'] === 'Pendente') {
                          echo '<i class="bi bi-hourglass-split text-danger"></i>';
                        }
                        ?></td>
                      <td><?php echo $receita['cenNome']; ?></td>
                      <td><?php echo $receita['cenValor']; ?></td>
                      <td>
                        <?php
                        echo $iconesCategorias[$receita['catNome']] ?? '';
                        ?>
                      </td>
                      <td class="text-danger">
                        <?php echo DateTime::createFromFormat('Y-m-d', $receita['lanVencimento'])->format('d/m/Y') ?>
                      </td>
                      <td class="text-success">
                        <?php echo DateTime::createFromFormat('Y-m-d', $receita['hceUltimoRegistro'])->format('d/m/Y');
                        ?>
                      </td>
                    </tr>
                  <?php
                  } //foreach
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-12 col-md-5 text-center">
            <div class="container-estilizado">
              <h5>Maiores gastos</h5>
              <div class="container mt-5 mb-0">
                <div class="row">
                  <?php
                  foreach ($maioresGastosCategoria as $index => $categoriaDespesa) {
                    echo '<p class="col-4">';
                    echo $iconesCategorias[$categoriaDespesa['catNome']] ?? '';
                    echo  '</p>';

                  ?>
                    <p class="col-4"><?php echo $categoriaDespesa['catNome'] ?></p>
                    <p class="col-4"><?php echo $categoriaDespesa['totalValor'] ?></p>
                    <hr>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>

            <div class="container-estilizado mt-3">
              <h5>Maiores recebimentos</h5>
              <div class="container mt-5 mb-0">
                <div class="row">
                  <?php
                  foreach ($maioresRecebimentosCategoria as $index => $categoriaReceita) {
                    echo '<p class="col-4">';
                    echo $iconesCategorias[$categoriaReceita['catNome']] ?? '';
                    echo  '</p>';

                  ?>
                    <p class="col-4"><?php echo $categoriaReceita['catNome'] ?></p>
                    <p class="col-4"><?php echo $categoriaReceita['totalValor'] ?></p>
                    <hr>
                  <?php
                  }
                  ?>
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

  const balancoMensal = <?php echo json_encode($balançoMensal); ?>;

  new Chart(ctxSaldoVariacoes, {
    type: 'line',
    data: {
      labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      datasets: [{
        label: 'Balanço mensal',
        data: balancoMensal,
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