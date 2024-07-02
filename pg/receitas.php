<?php 
require_once "../php/conexao.php";
$conexao = novaConexao();

    // Consulta SQL
    $stmt = $conexao->prepare("SELECT * FROM tblReceita WHERE recIdUsuario = :idu");
    $stmt-> bindValue(':idu', $_SESSION['idUsuario']);
    $stmt->execute();
    // Armazena os resultados em uma matriz
    $resProduto = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resProduto) > 0) {
        $mensagem = 'true'; // Defina uma variável para a mensagem
    } else {
        $mensagem = 'false'; // Defina uma variável para a mensagem
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
  <link rel="stylesheet" href="../css/receitas_despesas.css" />
  <link rel="shortcut icon" href="../img/icon_title.png" />
  <title>Suas receitas</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div class="row g-3 m-0">
    <!-- ------------------------- volume para dar espaçamento ------------------------- -->
    <div class="col-2 navbar-lateral-fantasma">
      <!-- sem conteúdo -->
    </div>
    <!-- ------------------------- volume para dar espaçamento fim ------------------------- -->

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

    <!------------------------- CABEÇALHO ------------------------->
    <!-- User icon, notificações e logout -->

    <div class="col-10">
      <header>
        <div class="container">
          <div class="row">
            <div class="col-6">
              <div class="titulo-bloco">
                <h2 class="mt-3">Suas receitas</h2>
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
      <!------------------------- CABEÇALHO fim ------------------------->

      <!------------------------- BLOCO RECEITAS ------------------------->
      <div class="container">
        <div class="row g-5 mt-5">
          <div class="col-4 col-md-2">
            <h3>Adicionar receita</h3>
          </div>
          <div class="col-8 col-md-4">
              <i class="bi bi-plus-circle-fill add-icon" onclick="modalAdicionar()"></i>
              <!-- Modal de adicionar -->
                 <dialog id="modalAdicionar">
                   <div class="container">
                     <form class="row g-3" action="../php/add_receitas.php" method="post">

                      <h4>Adicionar receita</h4>
                      <div class="col-12 col-md-6">
                       <label>Nome</label>
                       <input type="text" name="nome" placeholder="Nome da receita" class="form-control" required>
                      </div>

                      <div class="col-12 col-md-12">
                       <label>Descrição</label>
                       <textarea name="descricao" id="" placeholder="Descrição" class="form-control"></textarea>
                      </div>

                      <div class="col-6 col-md-4">
                       <label>Saldo</label>
                       <input type="number" name="saldo" placeholder="Saldo" class="form-control" required>                       
                      </div>

                      <div class="col-8 col-md-4">
                       <label>Categoria</label>
                       <select name="categoria" id="" class="form-control" required>
                         <option value="Salario">Salário</option>
                         <option value="Horas extrad">Horas extras</option>
                         <option value="Bonus e comissoes">Bônus e comissões</option>
                         <option value="Lucro de negocio proprio">Lucro de negócio próprio</option>
                         <option value="Aposentadoria">Aposentadoria</option>
                         <option value="Outros">Outros</option>
                       </select>
                      </div>

                      <div class="col-10 col-md-4">
                       <label>Data</label>
                       <input type="date" name="data" class="form-control" required>
                      </div>

                      <div class="col-6 col-md-4">
                       <label>Situação</label>
                       <select name="situacao" id="" class="form-control" required>
                         <option value="Recebido">Recebida</option>
                         <option value="Pendente">Pendente</option>
                       </select>
                      </div>

                      <div class="text-center">
                        <button class="btn btn-outline-success" type="submit">Adicionar</button>
                      </div>
                     </form>
                   </div>

                   <button class="btn btn-outline-danger" onclick="modalAdicionarFechar()">Fechar</button>
                 </dialog>
              <!-- Modal de adicionar -->
          </div>

          <div class="col-12 col-md-6">
            <form class="d-flex" role="search">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" />
              <button class="btn btn-danger" type="submit">Pesquisar</button>
            </form>
          </div>
        </div>
        <!------------------------- BLOCO RECEITAS fim ------------------------->

      <?php
              if ($mensagem == 'true') {
                //----- LISTA AS LINHAS(REGISTROS) EM UMA TABELA -----
                for ($i = 0; $i < count($resProduto); $i++) {
      ?>
        <!-- ------------------------- LAYOUT PARA PC ------------------------- -->
        <div class="col-12 receita-pc mt-3">
          <div class="card text-center">
            <a href="#">
              <div class="card-body">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Descrição</th>
                      <th scope="col">Situação</th>
                      <th scope="col">Data</th>
                      <th scope="col">Saldo</th>
                      <th scope="col">Categoria</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                        foreach ($resProduto[$i] as $key => $value) {
                          if ($key != 'idReceita' && $key != 'recIdUsuario' && $key != 'recIdCategoria') {
                            echo '<td>' . $value . '</td>';
                          } else if ($key == 'recIdCategoria') {
                            echo '<td>' . 'aaaaaaaaaaaa' . '</td>';
                        }
                        }
                          ?>
                      <td>
                        <a href="#"><i class="bi bi-pencil-square m-3"></i></a>
                      </td>
                      <td>
                        <a href="#"><i class="bi bi-trash3 mx-3"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </a>
          </div>
        </div>
        <!-- ------------------------- LAYOUT PARA PC fim ------------------------- -->

        <!-- ------------------------- LAYOUT PARA MOBILE ------------------------- -->
        <div class="col-12 mt-5 receita-mobile">
          <div class="card">
            <table class="table">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Categoria</th>
                  <th>Saldo</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <?php
                  foreach ($resProduto[$i] as $key => $value) {
                    if ($key != 'proNome' && $key != 'proIdCliente') {
                    echo '<td>' . $value . '</td>';
                  }
                }
                ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- LAYOUT PARA MOBILE MENOR -->
        <div class="col-12 mt-5 receita-little-mobile">
          <div class="card">
            <table class="table">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Categoria</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <?php
                  foreach ($resProduto[$i] as $key => $value) {
                    if ($key != 'proNome' && $key != 'proIdCliente') {
                      echo '<td>' . $value . '</td>';
                    }
                  }
                ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- ------------------------- LAYOUT PARA MOBILE fim ------------------------- -->
         <?php
            }
              } else {
                  ?>
                  <div class="text-center mt-5 mb-5 tela-vazia">
                    <img class="img-fluid w-50" src="../img/tela_vazia.png" alt="tela_vazia">
                    <h3>Nenhuma receita até o momento</h3>
                  </div>
                  <?php
              }
        ?>

        <!-- TELA VAZIA -->
<!--         
        <div class="text-center mt-5 mb-5 tela-vazia">
          <img class="img-fluid w-50" src="../img/tela_vazia.png" alt="tela_vazia">
          <h3>Nenhuma receita até o momento</h3>
        </div>
 -->
        <!-- TELA VAZIA -->

      </div>
    </div>
  </div>
  
  <script src="../js/modals.js"></script>
  <!-- ------------------------- Popover ------------------------- -->
  <script src="../js/popup_notificacoes.js"></script>
  <!-- ------------------------- Popover fim ------------------------- -->
</body>

</html>