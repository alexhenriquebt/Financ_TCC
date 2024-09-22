<?php
require_once "../config/conexao.php";
$conexao = novaConexao();

require_once "../model/classe_receita.php";
require_once "../model/classe_categoria.php";
$receita = new Receita();
$categoria = new Categoria();
$dadosReceitas = $receita->buscarReceitas();

$nomeCategoria = [];
for ($position = 0; $position < count($dadosReceitas); $position++) {
  foreach ($dadosReceitas[$position] as $chave => $idCategoria) {
    if ($chave == 'catId') {
      // PEGA NOME DA CATEGORIA
      $idCategoria = $categoria->buscarCategorias($idCategoria);
      $nomeCategoria[$position] = $idCategoria;
    }
  }
}

if (count($dadosReceitas) > 0) {
  $mensagem = 'true'; // Defina uma variável para a mensagem
} else {
  $mensagem = 'false'; // Defina uma variável para a mensagem
}

require_once '../model/validador_acesso.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../css/receitas_despesas.css" />
  <link rel="shortcut icon" href="../img/icon_title.png" />
  <title>Suas receitas</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div class="row g-3 m-0">
    <!-- navbar lateral -->
    <?php require_once '../utils/navbar_lateral.php' ?>

    <div class="col-10">
      <!-- user icon, navbar mobile e as notificações -->
      <?php require_once '../utils/navbar_mobile.php' ?>

      <!------------------------- BLOCO RECEITAS ------------------------->
      <div class="container">
        <div class="row g-5 mt-5">
          <div class="col-4 col-md-2">
            <h3>Adicionar receita</h3>
          </div>
          <div class="col-8 col-md-4">
            <i class="bi bi-plus-circle-fill add-icon w-25" onclick="abrirModalAdicionar()"></i>
          </div>
        </div>

        <?php
        if (isset($_GET['id_rec']) && !empty($_GET['id_rec'])) {
          $id_receita = addslashes($_GET['id_rec']);
          $resReceitaUpdate = $receita->buscarReceitasUpdate($id_receita);
          $dialog = true;
        }
        ?>

        <div class="row g-3 mt-3 mb-3">
          <?php
          if ($mensagem == 'true') {
            foreach ($dadosReceitas as $index => $receita) {
          ?>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="content">
                      <h5 class="card-title"><?php echo $receita['recNome']; ?></h5>
                      <p class="card-text"><?php echo $receita['recDescricao']; ?></p>
                      <p class="card-text">Situação: <?php echo $receita['recSituacao']; ?></p>
                      <p class="card-text">Valor: <?php echo $receita['recValor']; ?></p>
                      <p class="card-text">Categoria: <?php echo isset($nomeCategoria[$index]['catNome']) ? $nomeCategoria[$index]['catNome'] : 'Categoria não encontrada';
                                                      $catNome = $nomeCategoria[$index]['catNome'];
                                                      ?></p>
                      <p class="card-text">Data: <?php echo $receita['recData']; ?></p>
                    </div>
                    <div class="icon-card">
                      <a href="receitas.php?id_rec=<?php echo $dadosReceitas[$index]['recId']; ?>">
                        <i class="bi bi-pencil-square m-3"></i>
                      </a>
                      <a href="../model/deletar_receita.php?idReceita=<?php echo $dadosReceitas[$index]['recId']; ?>" onclick="return confirm('Você realmente quer excluir essa receita?')">
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
            <!-- MENSAGEM QUANDO NÃO TEM RECEITAS -->
            <div class="text-center mt-5 mb-5 tela-vazia">
              <img class="img-fluid w-50" src="../img/tela_vazia.png" alt="tela_vazia">
              <h3>Nenhuma receita até o momento</h3>
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
      <form class="row g-3" action="../model/add_receitas.php" method="post">

        <h4>Adicionar receita</h4>
        <div class="col-12 col-md-6">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome da receita" class="form-control" required>
        </div>

        <div class="col-12 col-md-12">
          <label>Descrição</label>
          <textarea name="descricao" id="" placeholder="Descrição" class="form-control"></textarea>
        </div>

        
        <div class="col-12 col-md-2">
          <label>Situação</label>
          <select name="situacao" id="situacao" class="form-control" required>
            <option value="">Selecione</option>
            <option value="Recebido">Recebido</option>
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
      <form class="row g-3" action="../model/alterar_receitas.php?id_update=<?php echo $resReceitaUpdate['recId']; ?>" method="post">

        <h4>Alterar receita</h4>
        <req class="col-12 col-md-8">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome da receita" class="form-control" value="<?php if (isset($resReceitaUpdate)) {
                                                                                                      echo $resReceitaUpdate['recNome'];
                                                                                                    } ?>" required>
    </div>

    <div class="col-12 col-md-12">
      <label>Descrição</label>
      <textarea name="descricao" placeholder="Descrição" class="form-control"><?php if (isset($resReceitaUpdate)) {
                                                                                echo $resReceitaUpdate['recDescricao'];
                                                                              } ?></textarea>
    </div>

    <div class="col-12 col-md-4">
          <label>Situação</label>
          <select name="situacao" id="situacao" class="form-control" required>
            <option value="<?php if (isset($resReceitaUpdate)) {
                                                                                          echo $resReceitaUpdate['recSituacao'];
                                                                                        } ?>">
                                                                                        <?php if (isset($resReceitaUpdate)) {
                                                                                          echo $resReceitaUpdate['recSituacao'];
                                                                                        } ?>
                                                                                        </option>
            <option value="Recebido">Recebido</option>
            <option value="Pendente">Pendente</option>
          </select>
        </div>

    <div class="col-6 col-md-4">
      <label>Valor</label>
      <input type="number" name="valor" placeholder="Valor" class="form-control" value="<?php if (isset($resReceitaUpdate)) {
                                                                                          echo $resReceitaUpdate['recValor'];
                                                                                        } ?>" required>
    </div>

    <div class="col-8 col-md-6">
      <label>Categoria</label>
      <select name="categoria" id="categoria" class="form-control" required>
        <option value="<?php if (isset($resReceitaUpdate)) {
                          echo $resReceitaUpdate['catId'];
                        } ?>"><?php if (isset($resReceitaUpdate)) {
                                                                                                            echo $resReceitaUpdate['catNome'];
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
      <input type="date" name="data" class="form-control" value="<?php if (isset($resReceitaUpdate)) {
                                                                    echo $resReceitaUpdate['recData'];
                                                                  } ?>" required>
    </div>

    <div class="col-12 col-md-12 mt-3 text-center">
      <button type="submit" class="btn btn-outline-success">Alterar</button>
    </div>

    </form>
    </div>
    <button class="btn btn-outline-danger mt-3" onclick="fecharModalAlterar()">Fechar</button>
  </dialog>

  <!-- Scripts para funcionalidade -->
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
