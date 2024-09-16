<?php
require_once "../config/conexao.php";
$conexao = novaConexao();

require_once "../model/classe_despesa.php";
require_once "../model/classe_categoria.php";
$classeDespesa = new Despesa();
$classeCategoria = new Categoria();
$dadosDespesas = $classeDespesa->buscarDespesas();

$nomeCategoria = [];
for ($position = 0; $position < count($dadosDespesas); $position++) {
  foreach ($dadosDespesas[$position] as $chave => $idCategoria) {
    if ($chave == 'desIdCategoria') {
      $idCategoria = $classeCategoria->buscarCategorias($idCategoria);
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
    <!-- navbar lateral -->
    <?php require_once '../utils/navbar_lateral.php' ?>

    <div class="col-10">
      <!-- user icon, navbar mobile e as notificações -->
      <?php require_once '../utils/navbar_mobile.php' ?>

      <div class="container">
        <div class="row g-5 mt-5">
          <div class="col-4 col-md-2">
            <h3>Adicionar despesa</h3>
          </div>
          <div class="col-8 col-md-4">
            <i class="bi bi-plus-circle-fill add-icon w-25" onclick="abrirModalAdicionar()"></i>
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
                      <p class="card-text">Valor: <?php echo $despesa['desValor']; ?></p>
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
      <input type="number" name="valor" placeholder="Valor" class="form-control" value="<?php if (isset($resDespesaUpdate)) {
                                                                                          echo $resDespesaUpdate['desValor'];
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
