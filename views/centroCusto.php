<?php
require_once "../model/classeCentroCusto.php";
require_once "../model/classeCategoria.php";
$classeCentroCusto = new CentroCusto();
$classeCategoria = new Categoria();
$listaCentroCusto = $classeCentroCusto->buscarCentroCusto();
$listaCategoriaGeral = $classeCategoria->buscarCategoriasGeral();
$receitas = $classeCentroCusto->somarCreditosDebitos('Receita');
$despesas = $classeCentroCusto->somarCreditosDebitos('Despesa');
$maioresGastosCategoria = $classeCentroCusto->filtrarGastosCategoria();
$saldo = $receitas - $despesas;

$dialog = '';

if (isset($_GET['idCentroAlterar']) && !empty($_GET['idCentroAlterar'])) {
  $cenId = addslashes($_GET['idCentroAlterar']);
  $resCentroUpdate = $classeCentroCusto->exibirCategoria($cenId);
  $dialog = 'liberar';
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
  <link rel="stylesheet" href="../css/centroCusto.css" />
  <link rel="shortcut icon" href="../assets/images/iconTituloPg.png" />
  <title>Gerencie suas despesas e receitas</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="row g-3 m-0">
    <!-- navbar lateral -->
    <?php require_once '../utils/navbarLateral.php' ?>

    <div class="col-10">
      <!-- user icon, navbar mobile e as notificações -->
      <?php require_once '../utils/header.php' ?>

      <div class="container">
        <div class="row g-5 mt-5">

          <div class="col-12 col-md-8">
            <form class="row g-3 container-estilizado p-3" action="../model/addCentroCusto.php" method="post">
              <h3>Adicionar despesas e receitas</h3>
              <div class="col-12 col-md-6">
                <label>Nome</label>
                <input type="text" name="nome" placeholder="Nome" class="form-control" required>
              </div>

              <div class="col-12 col-md-12">
                <label>Descrição</label>
                <textarea name="descricao" id="" placeholder="Descrição" class="form-control"></textarea>
              </div>

              <div class="col-12 col-md-2">
                <label>Tipo</label>
                <select name="tipo" id="tipo" class="form-control" required>
                  <option value="">Selecione</option>
                  <option value="Receita">Receita</option>
                  <option value="Despesa">Despesa</option>
                </select>
              </div>

              <div class="col-12 col-md-2">
                <label>Situação</label>
                <select name="situacao" id="situacao" class="form-control" required>
                  <option value="">Selecione</option>
                  <option value="Realizado">Realizado</option>
                  <option value="Pendente">Pendente</option>
                </select>
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
                  foreach ($listaCategoriaGeral as $categoria) {
                    echo '<option value="' . $categoria['catId'] . '">' . $categoria['catNome'] . '</option>';
                  }
                  ?>

                </select>
              </div>

              <div class="col-8 col-md-4">
                <label>Forma</label>
                <select name="forma" id="forma" class="form-control" required>
                  <option value="">Selecione</option>
                  <option value="Único">Único</option>
                  <option value="Mensal">Mensal</option>
                  <option value="Anual">Anual</option>

                </select>
              </div>

              <div class="col-8 col-md-4">
                <label>Prazo de vencimento</label>
                <input type="date" name="dataVencimento" class="form-control" required>
              </div>

              <div class="col-12 col-md-12 text-center">
                <button type="submit" class="btn btn-dark">Adicionar</button>
              </div>

            </form>

            <div class="mt-5">
              <?php
              require_once "../utils/filtro.php";
              ?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Tipo</th>
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
                  foreach ($listaCentroCusto as $index => $centroCusto) {
                  ?>
                    <tr>
                      <td><?php echo $centroCusto['cenTipo']; ?></td>
                      <td class="text-center"><?php

                                              if ($centroCusto['lanSituacao'] === 'Realizado') {
                                                echo '<i class="bi bi-check-circle-fill text-success"></i>';
                                              } else if ($centroCusto['lanSituacao'] === 'Pendente') {
                                                echo '<i class="bi bi-hourglass-split text-danger"></i>';
                                              }
                                              ?></td>
                      <td><?php echo $centroCusto['cenNome']; ?></td>
                      <td><?php echo $centroCusto['cenValor']; ?></td>
                      <td><?php echo $centroCusto['catNome']; ?></td>
                      <td class="text-danger"><?php echo DateTime::createFromFormat( 'Y-m-d', $centroCusto['lanVencimento'])->format('d/m/Y') ?></td>
                      <td class="text-success"><?php echo DateTime::createFromFormat('Y-m-d', $centroCusto['hceUltimoRegistro'])->format('d/m/Y');
                          ?></td>
                      <td>
                        <a href="centroCusto.php?idCentroAlterar=<?php echo $listaCentroCusto[$index]['cenId']; ?>">
                          <i class="bi bi-pencil-square m-3 text-black"></i>
                        </a>
                      </td>
                      <td>
                        <a href="../model/deletarCentroCusto.php?cenIdDeletar=<?php echo $listaCentroCusto[$index]['cenId']; ?>" onclick="return confirm('Você realmente deseja excluir?')">
                          <i class="bi bi-trash3 mx-3 text-danger"></i>
                        </a>
                      </td>
                    </tr>
                  <?php
                  } //foreach
                  ?>

                </tbody>
              </table>
            </div>
          </div>


          <div class="col-12 col-md-4 g-3 text-center">
            <div class="card-direita p-3">
              <h5>Saldo<br>
                <?php
                echo $saldo == 0 ? 'R$ 0,00' : ($saldo < 0 ? '-R$' : 'R$') . number_format(abs($saldo), 2, ',', '.');

                ?>
              </h5>
            </div>
            <div class="card-direita p-3">
              <h5>Receitas<br>
                <?php
                if ($receitas == 0) {
                  echo 'R$0,00';
                } else {
                  echo 'R$' . $receitas;
                }
                ?></h5>
            </div>
            <div class="card-direita p-3">
              <h5>Despesas<br>
                <?php
                if ($despesas == 0) {
                  echo 'R$0,00';
                } else {
                  echo 'R$' . $despesas;
                }
                ?></h5>
            </div>
            <div class="card-direita p-3">
              <a href="relatorios.php">
                <h5 class="text-black">Ver relatórios <i class="bi bi-box-arrow-up-right text-black"></i></h5>
              </a>
            </div>
            <div class="card-direita p-3 w-100">
              <h5 class="mb-5">Maiores gastos por categoria</h5>
              <div class="container">
                <div class="row">
                  <?php
                  foreach ($maioresGastosCategoria as $index => $categoriaDespesa) {
                  ?>
                    <i class="bi bi-backpack2 text-black col-4"></i>
                    <p class="col-4"><?php echo $categoriaDespesa['catNome'] ?></p>
                    <p class="col-4"><?php echo $categoriaDespesa['totalValor'] ?></p>
                    <hr>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- DIALOGS AQUI -->
  <!-- dialog alterar -->
  <dialog id="modalAlterar">
    <div class="container">
      <form class="row g-3" action="../model/alterarCentroCusto.php?id_update=<?php echo $resDespesaUpdate['cenId']; ?>" method="post">

        <h4>Alterar despesa</h4>
        <req class="col-12 col-md-8">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome da despesa" class="form-control" value="<?php if (isset($resDespesaUpdate)) {
                                                                                                      echo $resDespesaUpdate['cenNome'];
                                                                                                    } ?>" required>
    </div>

    <div class="col-12 col-md-12">
      <label>Descrição</label>
      <textarea name="descricao" placeholder="Descrição" class="form-control"><?php if (isset($resDespesaUpdate)) {
                                                                                echo $resDespesaUpdate['cenDescricao'];
                                                                              } ?></textarea>
    </div>

    <div class="col-12 col-md-4">
      <label>Situação</label>
      <select name="situacao" id="situacao" class="form-control" required>
        <option value="<?php if (isset($resCentroUpdate)) {
                          echo $resCentroUpdate['cenTipo'];
                        } ?>">
          <?php if (isset($resCentroUpdate)) {
            echo $resCentroUpdate['cenTipo'];
          } ?>
        </option>
        <option value="Pago">Pago</option>
        <option value="Pendente">Pendente</option>
      </select>
    </div>

    <div class="col-6 col-md-4">
      <label>Valor</label>
      <input type="number" name="valor" placeholder="Valor" class="form-control" value="<?php if (isset($resCentroUpdate)) {
                                                                                          echo $resCentroUpdate['cenValor'];
                                                                                        } ?>" required>
    </div>

    <div class="col-8 col-md-6">
      <label>Categoria</label>
      <select name="categoria" id="categoria" class="form-control" required>
        <option value="<?php if (isset($resCentroUpdate)) {
                          echo $resCentroUpdate['catId'];
                        } ?>"><?php if (isset($resCentroUpdate)) {
                                echo $resCentroUpdate['catNome'];
                              } ?></option>
        <?php
        // Obtém todas as categorias
        $categoriasStmt = $conexao->prepare("SELECT * FROM tblCategoria");
        $categoriasStmt->execute();
        $categorias = $categoriasStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categorias as $categoria) {
          echo '<option value="' . $categoria['catId'] . '">' . $categoria['catNome'] . '</option>';
        }
        ?>
      </select>
    </div>

    <div class="col-8 col-md-6">
      <label>Data</label>
      <input type="date" name="data" class="form-control" value="<?php if (isset($resCentroUpdate)) {
                                                                    echo $resCentroUpdate['desData'];
                                                                  } ?>" required>
    </div>

    <div class="col-12 col-md-12 mt-3 text-center">
      <button type="submit" class="btn btn-outline-success">Alterar</button>
    </div>

    </form>
    </div>
    <button class="btn btn-outline-danger mt-3" onclick="fecharModalAlterar()">Fechar</button>
  </dialog>


  <script src="../js/limitaCaractere.js"></script>
    <script src="../js/modal.js"></script>
    <script src="../js/popover.js"></script>
</body>
</html>

<?php
if ($dialog == 'liberar') {
?>
  <script>
    abrirModalAlterar()
  </script>
<?php
}
?>