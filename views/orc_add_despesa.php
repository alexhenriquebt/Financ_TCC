<?php
require_once "../php/conexao.php";
$conexao = novaConexao();

require_once "../php/classe_despesa.php";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ------------------------- Framework ------------------------- -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- ------------------------- Framework fim ------------------------- -->

    <link rel="shortcut icon" href="../img/icon_title.png">
    <title>Adicionar despesas no orçamento</title>
    <link rel="stylesheet" href="../css/orc_addDespesa.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <main>
        <h1 class="text-center">Adicionar despesas no orçamento</h1>
        <div class="container">
            <div class="row g-3 mt-5">
                <div class="col-12 item-btn">
                    <button class="btn btn-danger" onclick="abrirModalOrcAddDes()">Despesas existentes</button>

                </div>
                <div class="col-12 item-btn">
                    <button class="btn btn-warning" onclick="abrirModalAdicionar()">Criar nova despesa</button>
                </div>
            </div>
        </div>
    </main>
</body>

<!-- DIALOGS AQUI -->
<!-- -------------- DESPESA EXISTENTE -------------- -->
<dialog id="despesasExistentes" class="w-100">
    <div class="container">
        <h1>Despesas existentes</h1>
        <div class="row g-3 mt-3 mb-3">
            <?php
          if ($mensagem == 'true') {
            foreach ($dadosDespesas as $index => $despesa) {
          ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="content">
                            <h5 class="card-title">
                                <?php echo $despesa['desNome']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $despesa['desDescricao']; ?>
                            </p>
                            <p class="card-text">Valor:
                                <?php echo $despesa['desValor']; ?>
                            </p>
                            <p class="card-text">Categoria:
                                <?php echo isset($nomeCategoria[$index]['catNome']) ? $nomeCategoria[$index]['catNome'] : 'Categoria não encontrada'; 
                      $catNome = $nomeCategoria[$index]['catNome'];
                      ?>
                            </p>
                            <p class="card-text">Data:
                                <?php echo $despesa['desData']; ?>
                            </p>
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

        <div class="col-12 col-md-12 text-center">
            <button type="submit" class="btn btn-outline-success">Selecionar</button>
        </div>
    </div>
    <button class="btn btn-outline-danger mt-3" onclick="fecharModalOrcAddDes()">Fechar</button>
</dialog>



<!-- -------------- DESPESA ADICIONAR -------------- -->
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

<script src="../js/limita_caractere.js"></script>
<script src="../js/modals.js"></script>
<script src="../js/popup_notificacoes.js"></script>

</html>