<?php
require_once "../model/classeCentroCusto.php";
require_once "../model/classeCategoria.php";
$classeCentroCusto = new CentroCusto();
$classeCategoria = new Categoria();
$listaCentroCusto = $classeCentroCusto->buscarCentroCusto();
$listaCategoriaGeral = $classeCategoria->buscarCategoriasGeral();
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

            <?php
            if (isset($_GET['idcentroAlterar']) && !empty($_GET['idcentroAlterar'])) {
              $cenId = addslashes($_GET['idcentroAlterar']);
              $resCentroUpdate = $classeCentroCusto->exibirCategoria($cenId);
              $dialog = true;
            }
            ?>

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
                      <td><?php echo $centroCusto['lanSituacao']; ?></td>
                      <td><?php echo $centroCusto['cenNome']; ?></td>
                      <td><?php echo $centroCusto['lanVencimento']; ?></td>
                      <td><?php echo $centroCusto['hceUltimoRegistro']; ?></td>
                      <td>
                        <a href="centroCusto.php?idcentroAlterar=<?php echo $listaCentroCusto[$index]['cenId']; ?>">
                          <i class="bi bi-pencil-square m-3"></i>
                        </a>
                      </td>
                      <td>
                        <a href="../model/deletarCentroCusto.php?cenIdDeletar=<?php echo $listaCentroCusto[$index]['cenId']; ?>" onclick="return confirm('Você realmente deseja excluir?')">
                          <i class="bi bi-trash3 mx-3"></i>
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
              <h5>Saldo</h5>
            </div>
            <div class="card-direita p-3">
              <h5>Receitas<br>
              <?php $receitas = $classeCentroCusto->somarCreditosDebitos('Crédito');
              if($receitas == '')
              {
                echo 'R$0,00';
              }
              else
              {
                echo 'R$' . $receitas;
              }
                  ?></h5>
            </div>
            <div class="card-direita p-3">
              <h5>Despesas<br>
              <?php $despesas = $classeCentroCusto->somarCreditosDebitos('Débito');
              if($despesas == '')
              {
                echo 'R$0,00';
              }
              else
              {
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
                  <i class="bi bi-backpack2 text-black col-4"></i>
                  <p class="col-4">Educação</p>
                  <p class="col-4">R$400,00</p>
                  <hr>
                  <i class="bi bi-egg text-black col-4"></i>
                  <p class="col-4">Alimentação</p>
                  <p class="col-4">R$700,00</p>
                  <hr>
                  <i class="bi bi-bus-front text-black col-4"></i>
                  <p class="col-4">Transportes</p>
                  <p class="col-4">R$200,00</p>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-3 mt-3 mb-3">
        <?php
        /*           if ($mensagem == 'true') {
            foreach ($dadosDespesas as $index => $despesa) { */
        ?>

        <!--               <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="content">
                      <h5 class="card-title"><?php /*echo $despesa['desNome'];*/ ?></h5>
                      <p class="card-text"><?php /* echo $despesa['desDescricao']; */ ?></p>
                      <p class="card-text">Situação: <?php /* echo $despesa['desSituacao'];*/ ?></p>
                      <p class="card-text">Valor: <?php /* echo $despesa['desValor']; */ ?></p>
                      <p class="card-text">Categoria: <?php /* echo isset($nomeCategoria[$index]['catNome']) ? $nomeCategoria[$index]['catNome'] : 'Categoria não encontrada';
                                                      $catNome = $nomeCategoria[$index]['catNome'];*/
                                                      ?></p>
                      <p class="card-text">Data: <?php /*echo $despesa['desData'];*/ ?></p>
                    </div>
                    <div class="icon-card">
                      <a href="despesas.php?id_des=<?php /* echo $dadosDespesas[$index]['desId']; */ ?>">
                        <i class="bi bi-pencil-square m-3"></i>
                      </a>
                      <a href="../model/deletar_despesas.php?idDespesa=<?php /*echo $dadosDespesas[$index]['desId']; */ ?>" onclick="return confirm('Você realmente quer excluir essa despesa?')">
                        <i class="bi bi-trash3 mx-3"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div> -->

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
/* if (isset($dialog) && $dialog == true) { */
?>
<!--   <script>
    abrirModalAlterar()
  </script> -->
<?php
/* } */
?>