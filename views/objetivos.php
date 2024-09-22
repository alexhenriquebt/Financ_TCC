<!-- <?php
 /* 
require_once "../config/conexao.php";
$conexao = novaConexao();

require_once "../model/classe_objetivo.php";
require_once "../model/classe_categoria.php";
$classeObjetivos = new Objetivo();
$classeCategoria = new Categoria();
$dadosObjetivos = $classeObjetivos->buscarObjetivos();

$nomeCategoria = [];
for ($position = 0; $position < count($dadosObjetivos); $position++) {
  foreach ($dadosObjetivos[$position] as $chave => $idCategoria) {
    if ($chave == 'catId') {
      // PEGA NOME DA CATEGORIA
      $idCategoria = $classeCategoria->buscarCategorias($idCategoria);
      $nomeCategoria[$position] = $idCategoria;
    }
  }
}

if (count($dadosObjetivos) > 0) {
  $mensagem = 'true'; // Defina uma variável para a mensagem
} else {
  $mensagem = 'false'; // Defina uma variável para a mensagem
}

require_once '../model/validador_acesso.php';
*/

?> -->


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- ------------------------- Framework ------------------------- -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- ------------------------- Framework fim ------------------------- -->

  <link rel="stylesheet" href="../css/orcamento.css">
  <link rel="shortcut icon" href="../img/icon_title.png">
  <title>Seus objetivos</title>
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

      <div class="container">
        <div class="row g-5 mt-5">
          <div class="col-4 col-md-2">
            <h3>Adicionar objetivo</h3>
          </div>
          <div class="col-8 col-md-4">
            <i class="bi bi-plus-circle-fill add-icon w-25" onclick="abrirModalAdicionar()"></i>
          </div>
        </div>

        <?php
        if (isset($_GET['objIdAlter']) && !empty($_GET['objIdAlter'])) {
          $objIdAlter = addslashes($_GET['objIdAlter']);
          $resObjetivoUpdate = $objetivo->buscarObjetivosUpdate($objIdAlter);
          $dialog = true;
        }
        ?>

        <div class="row g-3 mt-3 mb-3">
          <?php
          if ($mensagem == 'true') {
            foreach ($dadosObjetivos as $index => $objetivo) {
          ?>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="content">
                      <h5 class="card-title"><?php echo $objetivo['objNome']; ?></h5>
                      <p class="card-text">Valor: <?php echo $objetivo['objValorInicial']; ?></p>
                      <p class="card-text">Valor: <?php echo $objetivo['objValor']; ?></p>
                      <p class="card-text">Categoria: <?php echo isset($nomeCategoria[$index]['catNome']) ? $nomeCategoria[$index]['catNome'] : 'Categoria não encontrada';
                                                      $catNome = $nomeCategoria[$index]['catNome'];
                                                      ?></p>
                      <p class="card-text">Data: <?php echo $objetivo['objData']; ?></p>
                    </div>
                    <div class="icon-card">
                      <a href="orcamentos.php?objIdConcluir=<?php echo $dadosOrcamentos[$index]['idOrcamento']; ?>">
                        <i class="bi bi-pencil-square m-3"></i>
                      </a>
                      <a href="orcamentos.php?objIdAlter=<?php echo $dadosObjetivos[$index]['idOrcamento']; ?>">
                        <i class="bi bi-pencil-square m-3"></i>
                      </a>
                      <a href="../php/deletar_objetivo
                      .php?objIdDelete=<?php echo $dadosObjetivos[$index]['objId']; ?>" onclick="return confirm('Você realmente quer excluir esse orçamento?')">
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
              <h3>Nenhum objetivo até o momento</h3>
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
      <form class="row g-3" action="../model/add_objetivos.php" method="post">

        <h4>Adicionar orçamento</h4>
        <div class="col-12 col-md-6">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome do objetivo" class="form-control" required>
        </div>

        <div class="col-6 col-md-4">
          <label>O quanto você quer ter?</label>
          <input type="number" name="valor" placeholder="Valor final" class="form-control" required>
        </div>

        <div class="col-6 col-md-4">
          <label>Valor inicial</label>
          <input type="number" name="valorInicial" placeholder="Valor inicial" class="form-control" required>
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

        <div class="col-12 col-md-12 mt-3 text-center">
      <button type="submit" class="btn btn-outline-success">Adicionar</button>
    </div>
      </form>
    </div>
    <button class="btn btn-outline-danger mt-3" onclick="fecharModalAdicionar()">Fechar</button>
  </dialog>

  <!-- dialog alterar -->
  <dialog id="modalAlterar">
    <div class="container">
      <form class="row g-3" action="../php/alterar_orcamentos.php?id_update=<?php echo $resOrcamentoUpdate['idOrcamento']; ?>" method="post">

        <h4>Alterar receita</h4>
        <req class="col-12 col-md-8">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome do orçamento" class="form-control" value="<?php if (isset($resOrcamentoUpdate)) {
                                                                                                        echo $resOrcamentoUpdate['orcNome'];
                                                                                                      } ?>" required>
    </div>

    <div class="col-12 col-md-12">
      <label>Descrição</label>
      <textarea name="descricao" placeholder="Descrição" class="form-control"><?php if (isset($resOrcamentoUpdate)) {
                                                                                echo $resOrcamentoUpdate['orcDescricao'];
                                                                              } ?></textarea>
    </div>

    <div class="col-6 col-md-4">
      <label>Saldo</label>
      <input type="number" name="saldo" placeholder="Saldo" class="form-control" value="<?php if (isset($resOrcamentoUpdate)) {
                                                                                          echo $resOrcamentoUpdate['orcSaldo'];
                                                                                        } ?>" required>
    </div>

    <div class="col-8 col-md-6">
      <label>Categoria</label>
      <select name="categoria" id="categoria" class="form-control" required>
        <option value="<?php if (isset($resOrcamentoUpdate)) {
                          echo $resOrcamentoUpdate['orcIdCategoria'];
                        } ?>"><?php if (isset($resOrcamentoUpdate)) {
                                                                                                            echo $resOrcamentoUpdate['catNome'];
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
      <input type="date" name="data" class="form-control" value="<?php if (isset($resOrcamentoUpdate)) {
                                                                    echo $resOrcamentoUpdate['orcData'];
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
