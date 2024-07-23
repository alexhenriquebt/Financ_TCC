<?php
require_once "../php/conexao.php";
$conexao = novaConexao();

require_once "../php/classe_despesas.php";
require_once "../php/classe_categoria.php";
$despesa = new Despesa();
$categoria = new Categoria();
$dadosDespesas = $despesa->buscarDespesas();

$nomeCategoria = [];
for ($position = 0; $position < count($dadosDespesas); $position++) {
  foreach ($dadosDespesas[$position] as $chave => $idCategoria) {
    if ($chave == 'desIdCategoria') {
      $idCategoria = $categoria->buscarCategorias($idCategoria);
      $nomeCategoria[$position] = $idCategoria;
    }
  }
}

if (count($dadosDespesas) > 0) {
  $mensagem = 'true';
} else {
  $mensagem = 'false';
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
  <title>Suas despesas</title>
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
                <h2 class="mt-3">Suas despesas</h2>
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

            <div class="container">
        <div class="row g-5 mt-5">
          <div class="col-4 col-md-2">
            <h3>Adicionar Despesa</h3>
          </div>
          <div class="col-8 col-md-4">
            <i class="bi bi-plus-circle-fill add-icon" onclick="abrirModalAdicionar()"></i>
          </div>
        </div>

        <?php
        if (isset($_GET['id_des']) && !empty($_GET['id_des'])) {
          $id_despesa = addslashes($_GET['id_des']);
          $resDespesaUpdate = $despesa->buscarDespesasUpdate($id_despesa);
          $dialog = true;
        }
        ?>

        <div class="row g-3 mt-3 mb-3">
          <?php
          if ($mensagem == 'true') {
            foreach ($dadosDespesas as $index => $despesa) {
          ?>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="content">
                      <h5 class="card-title"><?php echo $despesa['desNome']; ?></h5>
                      <p class="card-text"><?php echo $despesa['desDescricao']; ?></p>
                      <p class="card-text">Valor: <?php echo $despesa['desValorTotal']; ?></p>
                      <p class="card-text">Categoria: <?php echo isset($nomeCategoria[$index]['catNome']) ? $nomeCategoria[$index]['catNome'] : 'Categoria não encontrada'; 
                      $catNome = $nomeCategoria[$index]['catNome'];
                      ?></p>
                      <p class="card-text">Data: <?php echo $despesa['desData']; ?></p>
                    </div>
                    <div class="icon-card">
                      <a href="despesas.php?id_des=<?php echo $dadosDespesas[$index]['idDespesa']; ?>">
                        <i class="bi bi-pencil-square m-3"></i>
                      </a>
                      <a href="../php/deletar_despesas.php?idDespesa=<?php echo $dadosDespesas[$index]['idDespesa']; ?>" onclick="return confirm('Você realmente quer excluir essa despesa?')">
                        <i class="bi bi-trash3 mx-3"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

            <?php
            }
          } else {
            ?>
            <!-- MENSAGEM QUANDO NÃO TEM ORÇAMENTOS -->
            <div class="text-center mt-5 mb-5 tela-vazia">
              <img class="img-fluid w-50" src="../img/tela_vazia.png" alt="tela_vazia">
              <h3>Nenhuma despesa até o momento</h3>
            </div>

          <?php
          }
          ?>

        </div>
      </div>
    </div>
  </div>

  <!-- DIALOGS AQUI -->
  <!-- dialog adicionar -->
  <dialog id="modalAdicionar">
    <div class="container">
      <form class="row g-3" action="../php/add_despesas.php" method="post">

        <h4>Adicionar despesa</h4>
        <div class="col-12 col-md-6">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome da despesa" class="form-control" required>
        </div>

        <div class="col-12 col-md-12">
          <label>Descrição</label>
          <textarea name="descricao" id="" placeholder="Descrição" class="form-control"></textarea>
        </div>

        <div class="col-6 col-md-4">
          <label>Valor</label>
          <input type="number" name="valor" placeholder="Valor" class="form-control" required>
        </div>

        <div class="col-8 col-md-4">
          <label>Categoria</label>
          <select name="categoria" id="categoria" class="form-control" required>
            <option value="">Selecione</option>
            <?php
            // Obtém todas as categorias
            $categoriasStmt = $conexao->prepare("SELECT * FROM tblCategoria");
            $categoriasStmt->execute();
            $categorias = $categoriasStmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categorias as $categoria) {
              echo '<option value="' . $categoria['catNome'] . '">' . $categoria['catNome'] . '</option>';
            }
            ?>
          </select>
        </div>

        <div class="col-8 col-md-4">
          <label>Data</label>
          <input type="date" name="data" class="form-control" required>
        </div>

        <div class="col-12 col-md-12 text-center">
          <button type="submit" class="btn btn-outline-success">Adicionar</button>
        </div>

      </form>
    </div>
    <button class="btn btn-outline-danger mt-3" onclick="fecharModalAdicionar()">Fechar</button>
  </dialog>

  <!-- dialog alterar -->
  <dialog id="modalAlterar">
    <div class="container">
      <form class="row g-3" action="../php/alterar_despesas.php?id_update=<?php echo $resDespesaUpdate['idDespesa']; ?>" method="post">

        <h4>Alterar receita</h4>
        <req class="col-12 col-md-8">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome da despesa" class="form-control" value="<?php if (isset($resDespesaUpdate)) {
                                                                                                      echo $resDespesaUpdate['desNome'];
                                                                                                    } ?>" required>
    </div>

    <div class="col-12 col-md-12">
      <label>Descrição</label>
      <textarea name="descricao" placeholder="Descrição" class="form-control"><?php if (isset($resDespesaUpdate)) {
                                                                                                      echo $resDespesaUpdate['desDescricao'];
                                                                                                    } ?></textarea>
    </div>

    <div class="col-6 col-md-4">
      <label>Valor</label>
      <input type="number" name="valor" placeholder="Valor" class="form-control"value="<?php if (isset($resDespesaUpdate)) {
                                                                                                      echo $resDespesaUpdate['desValorTotal'];
                                                                                                    } ?>" required>
    </div>

    <div class="col-8 col-md-6">
      <label>Categoria</label>
      <select name="categoria" id="categoria" class="form-control" required>
        <option value="<?php if (isset($resDespesaUpdate)) {
                                                                                                      echo $resDespesaUpdate['desIdCategoria'];
                                                                                                    } ?>"><?php if (isset($resDespesaUpdate)) {
                                                                                                      echo $resDespesaUpdate['catNome'];
                                                                                                    } ?></option>
        <?php
        // Obtém todas as categorias
        $categoriasStmt = $conexao->prepare("SELECT * FROM tblCategoria");
        $categoriasStmt->execute();
        $categorias = $categoriasStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categorias as $categoria) {
          echo '<option value="' . $categoria['idCategoria'] . '">' . $categoria['catNome'] . '</option>';
        }
        ?>
      </select>
    </div>

    <div class="col-8 col-md-6">
      <label>Data</label>
      <input type="date" name="data" class="form-control" value="<?php if (isset($resDespesaUpdate)) {
                                                                                                      echo $resDespesaUpdate['desData'];
                                                                                                    } ?>" required>
    </div>

    <div class="col-12 col-md-12 mt-3 text-center">
      <button type="submit" class="btn btn-outline-success">Alterar</button>
    </div>

    </form>
    </div>
    <button class="btn btn-outline-danger mt-3" onclick="fecharModalAlterar()">Fechar</button>
  </dialog>

  <script src="../js/limita_caractere.js"></script>
  <script src="../js/modals.js"></script>
  <script src="../js/popup_notificacoes.js"></script>

        <!-- ------------------------- LAYOUT PARA PC ------------------------- -->
       <!-- <div class="col-12 despesa-pc mt-5">
          <div class="card text-center">
            <a href="#">
              <div class="card-body">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Descrição</th>
                      <th scope="col">Saldo</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Data</th>
                      <th scope="col">Situação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Lorem</td>
                      <td></td>
                      <td>R$0.00</td>
                      <td></td>
                      <td>dd/mm/aaaa</td>
                      <td></td>
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
         ------------------------- LAYOUT PARA PC fim -------------------------

         ------------------------- LAYOUT PARA MOBILE -------------------------
        <div class="col-12 mt-5 despesa-mobile">
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
                  <td>Trabalho</td>
                  <td>empresa</td>
                  <td>1.700,89</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
         LAYOUT PARA MOBILE MENOR 
        <div class="col-12 mt-5 despesa-little-mobile">
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
                  <td>Trabalho</td>
                  <td>empresa</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div> -->

        <!-- ------------------------- LAYOUT PARA MOBILE MENOR fim ------------------------- -->

        <!--
        
        <div class="text-center mt-5 mb-5 tela-vazia">
          <img class="img-fluid w-50" src="../img/tela_vazia.png" alt="tela_vazia">
          <h3>Nenhuma despesa até o momento</h3>
        </div> -->

      </div>
    </div>
  </div>


  <script src="../js/modals.js"></script>
  <!-- ------------------------- Popover ------------------------- -->
  <script src="../js/popup_notificacoes.js"></script>
  <!-- ------------------------- Popover fim ------------------------- -->
</body>
</html>

<?php
if (isset($dialog) && $dialog == true) {
?>
  <script>
    abrirModalAlterar()
  </script>
<?php
}