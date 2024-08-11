<?php
require_once '../php/classe_despesa.php';
require_once '../php/classe_receita.php';
$despesa = new Despesa();
$receita = new Receita();
$princDespesas = $despesa->principaisDespesas();

if (count($princDespesas) > 0) {
  $mensagem = 'true';
} else {
  $mensagem = 'false';
}

// valida o acesso do usuário!
require_once '../php/validador_acesso.php';
//pega o nome do usuário
$usuario = $_SESSION['usuario'];

// Calcula o total das despesas
$totalDespesas = array_sum(array_column($despesa->buscarDespesas(), 'desValor'));

// Calcula o total das receitas
$totalReceitas = array_sum(array_column($receita->buscarReceitas(), 'recValor'));

$historicoPatrimonio = [];
$patrimonio = $totalReceitas - $totalDespesas;
$historicoPatrimonio[] = $patrimonio;

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="shortcut icon" href="../img/icon_title.png" />
    <title>Home</title>
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>

  <body>
    <div class="row g-3 m-0">
      <!-- ------------------- volume para dar espaçamento ------------------- -->
      <div class="col-2 navbar-lateral-fantasma">
        <!-- sem conteúdo -->
      </div>
      <!-- ------------------- volume para dar espaçamento fim ------------------- -->

      <!-- ------------------- navbar-lateral fixada ------------------- -->
      <div class="navbar-lateral text-center m-0">
        <div class="row g-5">
          <div class="col-12">
            <a
              href="home.php"
              data-bs-toggle="popover"
              data-bs-trigger="hover focus"
              data-bs-content="Home"
            >
              <img src="../img/icon_title.png" alt="" class="img-fluid" />
            </a>
          </div>
          <div class="col-12">
            <a
              href="orcamentos.php"
              data-bs-toggle="popover"
              data-bs-trigger="hover focus"
              data-bs-content="Orçamentos"
            >
              <i class="bi bi-cash-coin"></i>
            </a>
          </div>
          <div class="col-12">
            <a
              href="despesas.php"
              data-bs-toggle="popover"
              data-bs-trigger="hover focus"
              data-bs-content="Despesas"
            >
              <i class="bi bi-graph-down-arrow"></i>
            </a>
          </div>
          <div class="col-12">
            <a
              href="receitas.php"
              data-bs-toggle="popover"
              data-bs-trigger="hover focus"
              data-bs-content="Receitas"
            >
              <i class="bi bi-graph-up-arrow"></i>
            </a>
          </div>
          <div class="col-12">
            <a
              href="relatorios.php"
              data-bs-toggle="popover"
              data-bs-trigger="hover focus"
              data-bs-content="Relatórios"
            >
              <i class="bi bi-graph-up"></i>
            </a>
          </div>
          <div class="col-12">
            <a
              href="configuracoes.php"
              data-bs-toggle="popover"
              data-bs-trigger="hover focus"
              data-bs-content="Configurações"
            >
              <i class="bi bi-gear"></i>
            </a>
          </div>
          <div class="col-12">
            <a
              href="ajuda.php"
              data-bs-toggle="popover"
              data-bs-trigger="hover focus"
              data-bs-content="Ajuda"
            >
              <i class="bi bi-info-circle"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="col-10">
        <!-- ------------------- navbar-lateral fixada fim ------------------- -->
        <!-- ------------------- CABEÇALHO PG ------------------- -->
        <!-- ------------------- User icon, notificações e logout ------------------- -->
        <header>
          <div class="container">
            <div class="user-config">
              <div class="btn-group">
                <button
                  type="button"
                  class="btn-dropdown dropdown-toggle"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="bi bi-person-circle"></i>
                </button>
                <button
                  style="border: none; background-color: white"
                  data-bs-toggle="popover"
                  data-bs-title="Notificações"
                  data-bs-content="Sem notificações"
                  data-bs-placement="bottom"
                >
                  <i class="bi bi-bell-fill"></i>
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a
                      class="dropdown-item dropdown-item-mobile"
                      href="home.php"
                      >Home</a
                    >
                  </li>
                  <li>
                    <a
                      class="dropdown-item dropdown-item-mobile"
                      href="orcamentos.php"
                      >Orçamentos</a
                    >
                  </li>
                  <li>
                    <a
                      class="dropdown-item dropdown-item-mobile"
                      href="despesas.php"
                      >Despesas</a
                    >
                  </li>
                  <li>
                    <a
                      class="dropdown-item dropdown-item-mobile"
                      href="receitas.php"
                      >Receitas</a
                    >
                  </li>
                  <li>
                    <a
                      class="dropdown-item dropdown-item-mobile"
                      href="relatorios.php"
                      >Relatórios</a
                    >
                  </li>
                  <li>
                    <a
                      class="dropdown-item dropdown-item-mobile"
                      href="configuracoes.php"
                      >Configurações</a
                    >
                  </li>
                  <li>
                    <a
                      class="dropdown-item dropdown-item-mobile"
                      href="ajuda.php"
                      >Ajuda</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="../php/logoff.php">Sair</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </header>
        <!-- ------------------- User icon, notificações e logout fim------------------- -->
        <!-- ------------------- CABEÇALHO PG fim ------------------- -->

        <div class="container mt-3 mb-5">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
            <button class="btn btn-danger" type="submit">Pesquisar</button>
          </form>
        </div>
        <div class="container">
          <div class="row bloco-saudacoes text-center">
            <div class="col-6">
              <p>
                Oi,
                <?php echo $usuario ?>
              </p>
            </div>
            <div class="col-6">
              <img
                src="../img/pessoa_acenando_sem_fundo.png"
                alt="pessoa acenando"
                class="img-fluid"
              />
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

        <div class="container p-5">
          <div class="row">
            <div class="col-12 col-md-6">
              <!-- gráfico de linha início-->
              <div class="grafico-barra">
                <canvas id="bar_chart"></canvas>
              </div>
              <!-- gráfico de linha fim -->
              <!-- tela MOBILE -->
              <div class="dados-pratimonio">
                <h5><?php echo 'Patrimônio atual: R$' . number_format($patrimonio,2,",","."); ?></h5>
              </div>
              <!-- tela MOBILE -->
            </div>

            <div class="col-12 col-md-6">
              <h2>Principais Despesas</h2>
              <div class="container h-100">
                <div class="row h-100">

                <?php if($mensagem == 'true') {
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

        <div class="container p-5">
          <!-- ------------------- Despesas e Receitas ------------------- -->
          <h2>Despesas</h2>
          <div class="row">
            <div class="col-6">
              <a href="despesas.php" style="text-decoration: none">
                <div class="card text-center">
                  <div class="card-body card-totais">
                    <!-- Telas maiores -->
                    <i class="bi bi-graph-down-arrow bi-card"></i>
                    <h5 class="card-title card-pc"><?php echo 'R$' . number_format($totalDespesas,2,",","."); ?></h5>
                    <!-- Telas maiores -->
                    <!-- Telas menores -->
                    <h5 class="card-title card-mobile">Total</h5>
                    <p class="card-text card-mobile"><?php echo 'R$' . number_format($totalDespesas,2,",","."); ?></p>
                    <!-- Telas menores -->
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6" style="width: 60px">
              <a
                href="#"
                class="add-icon"
                data-bs-toggle="popover"
                data-bs-trigger="hover focus"
                data-bs-content="Adicionar despesa"
              >
                <i class="bi bi-plus-circle-fill add-icon"></i>
              </a>
            </div>
          </div>

          <h2 class="mt-5">Receitas</h2>
          <div class="row">
            <div class="col-6">
              <a href="#">
                <div class="card text-center">
                  <div class="card-body card-totais">
                    <!-- Telas maiores -->
                    <i class="bi bi-graph-up-arrow bi-card"></i>
                    <h5 class="card-title card-pc"><?php echo 'R$' . number_format($totalReceitas,2,",","."); ?></h5>
                    <!-- Telas maiores -->
                    <h5 class="card-title card-mobile">Total</h5>
                    <p class="card-text card-mobile"><?php echo 'R$' . number_format($totalReceitas,2,",","."); ?></p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6" style="width: 60px">
              <a
                href="#"
                data-bs-toggle="popover"
                data-bs-trigger="hover focus"
                data-bs-content="Adicionar receita"
              >
                <i class="bi bi-plus-circle-fill add-icon"></i>
              </a>
            </div>
          </div>
          <!-- ------------------- Despesas e Receitas fim ------------------- -->

          <!-- ------------------- Orçamentos ------------------- -->
          <h2 class="mt-5">Orçamentos</h2>
          <div class="row g-5">
            <div class="col-12">
              <div class="card text-center">
                <a href="#">
                  <div class="card-body">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Categoria</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Lorem</td>
                          <td>Lorem, ipsum.</td>
                          <td>
                            <a href="#"><i class="bi bi-pencil-square"></i></a>
                          </td>
                          <td>
                            <a href="#"><i class="bi bi-trash3"></i></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </a>
              </div>
            </div>
            <div class="text-center">
              <a
                href="#"
                data-bs-toggle="popover"
                data-bs-trigger="hover focus"
                data-bs-content="Criar um novo orçamento"
              >
                <i class="bi bi-plus-circle-fill add-icon-orcamento"></i>
              </a>
            </div>
          </div>
          <!-- ------------------- Orçamentos fim ------------------- -->
        </div>
      </div>
    </div>
    </div>
    </div>

    
    <script src="../js/popup_notificacoes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const patrimonioData = <?php echo json_encode($historicoPatrimonio); ?>
      
        const ctx = document.getElementById("bar_chart");

          new Chart(ctx, {
            type: "bar",
            data: {
              labels: [
                "Jan",
                "Fev",
                "Mar",
                "Abr",
                "Mai",
                "Jun",
                "Jul",
                "Ago",
                "Set",
                "Out",
                "Nov",
                "Dez",
              ],
              datasets: [
                {
                  label: "Evolução do patrimônio",
                  data: patrimonioData,
                  backgroundColor: "rgb(253, 136, 59)",
                },
              ],
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true,
                },
              },
            },
          });
    </script>
  </body>
</html>
