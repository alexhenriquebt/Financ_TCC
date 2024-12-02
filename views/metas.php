<?php
require_once "../model/validarAcesso.php";
require_once "../model/classeMetas.php";
require_once "../model/classeCategoria.php";
require_once "../model/classeCentroCusto.php";
$classeCentroCusto = new CentroCusto();
$classeMetas = new Metas();
$classeCategoria = new Categoria();
$listaMetas = $classeMetas->buscarMetas();
$listaCategoriaGeral = $classeCategoria->buscarCategoriasGeral();



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
  'Transferências ou pagamentos' => '<i class="bi bi-cash-coin text-success"></i>',
  'Emergências' => '<i class="bi bi-exclamation-triangle-fill text-danger"></i>',
  'Seguros' => '<i class="bi bi-shield-lock-fill text-secondary"></i>',
  'Compras e lazer' => '<i class="bi bi-cart-fill text-info"></i>',
  'Manutenção e reparos' => '<i class="bi bi-wrench-adjustable text-warning"></i>',
  'Assinaturas' => '<i class="bi bi-card-checklist text-primary"></i>',
  'Outros' => '<i class="bi bi-three-dots text-muted"></i>',
];

$dialog = '';

if (isset($_GET['idMetasAlterar']) && !empty($_GET['idMetasAlterar'])) {
  $metaId = addslashes($_GET['idMetasAlterar']);
  $resMetaUpdate = $classeMetas->exibirCategoria($metaId);
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
  <link rel="stylesheet" href="../css/metas.css" />
  <link rel="shortcut icon" href="../assets/images/iconTituloPg.png" />
  <title>Metas</title>
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

          <div class="col-12 col-md-9">
            <form class="row g-3 container-estilizado p-3" action="../model/addMetas.php" method="post">
              <h3>Adicionar metas</h3>
              <div class="col-12 col-md-6">
                <label>Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Nome" class="form-control" required>
              </div>

              <div class="col-12 col-md-12">
                <label>Descrição</label>
                <textarea name="descricao" id="descricao" placeholder="Descrição" class="form-control"></textarea>
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

              <div class="col-6 col-md-4">
                <label>Valor Inicial</label>
                <input type="number" name="valorInicial" placeholder="Valor inicial" class="form-control" required>
              </div>

              <div class="col-6 col-md-4">
                <label>Valor Final</label>
                <input type="number" name="valor" placeholder="Valor final" class="form-control" required>
              </div>

              <div class="col-12 col-md-2">
                <label>Situação</label>
                <select name="situacao" id="situacao" class="form-control" required>
                  <option value="">Selecione</option>
                  <option value="Realizado">Realizado</option>
                  <option value="Pendente">Pendente</option>
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

            <div class="mt-5 mb-5">
              <?php
              require_once "../utils/filtro.php";
              ?>
            </div>

            <div class="row">
              <div class="container-estilizado mb-3 col-12 col-md-4 col-lg-3 p-3 mx-3">
                
              <h5><i class="bi bi-flag"></i> Atingir 50 mil reais</h5>
              
              <div class="progress mt-3" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar w-75"></div>
              </div>
              
              <div class="align-self-end text-end mt-3">
                <p>R$50.000,00</p>
                <i class="bi bi-trash3"></i>
                <i class="bi bi-pencil-square"></i>
                <i class="bi bi-check"></i>
              </div>
              
            </div>

            <div class="container-estilizado mb-3 col-12 col-md-4 col-lg-3 p-3 mx-3">

              <h5><i class="bi bi-flag"></i> Atingir 50 mil reais</h5>

              <div class="progress mt-3" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar w-75"></div>
              </div>

              <div class="align-self-end text-end mt-3">
                <p>R$50.000,00</p>
                <i class="bi bi-trash3"></i>
                <i class="bi bi-pencil-square"></i>
                <i class="bi bi-check"></i>
              </div>

            </div>

            <div class="container-estilizado mb-3 col-12 col-md-4 col-lg-3 p-3 mx-3">

              <h5><i class="bi bi-flag"></i> Atingir 50 mil reais</h5>

              <div class="progress mt-3" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar w-75"></div>
              </div>

              <div class="align-self-end text-end mt-3">
                <p>R$50.000,00</p>
                <i class="bi bi-trash3"></i>
                <i class="bi bi-pencil-square"></i>
                <i class="bi bi-check"></i>
              </div>

            </div>
            
            <div class="container-estilizado mb-3 col-12 col-md-4 col-lg-3 p-3 mx-3">

              <h5><i class="bi bi-flag"></i> Atingir 50 mil reais</h5>

              <div class="progress mt-3" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar w-75"></div>
              </div>

              <div class="align-self-end text-end mt-3">
                <p>R$50.000,00</p>
                <i class="bi bi-trash3"></i>
                <i class="bi bi-pencil-square"></i>
                <i class="bi bi-check"></i>
              </div>

            </div>
          </div>
          </div>
          
          
          <div class="col-12 col-md-3 g-1 text-center">
            
          <div class="col-12 col-md-3 card-direita g-3 p-3 w-100">
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

            <div class=" col-12 col-md-3 g-3 card-direita p-3 w-100">
              <h5>Metas próximas</h5>
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
    </div>
  </div>

  <dialog id="modalAlterar">
    <div class="container">
      <form class="row g-3" action="../model/alterarMetas.php?id_update=<?php echo $resMetasUpdate['metaId']; ?>"
        method="post">
        <h4>Alterar <?php echo $resCentroUpdate['metaNome'] ?></h4>

        <div class="col-12 col-md-8">
          <label>Nome</label>
          <input type="text" name="nome" placeholder="Nome da despesa" class="form-control" value="<?php if (isset($resMetasUpdate)) {
            echo $resMetasUpdate['metaNome'];
          } ?>" required>
        </div>

        <div class="col-12 col-md-12">
          <label>Descrição</label>
          <textarea name="descricao" placeholder="Descrição" class="form-control"><?php if (isset($resMetasUpdate)) {
            echo $resMetasUpdate['metaDescricao'];
          } ?></textarea>
        </div>

        <div class="col-12 col-md-8">
          <label>Prazo de vencimento</label>
          <input type="date" name="data" class="form-control" value="<?php if (isset($resMetasUpdate)) {
            echo $resMetasUpdate['lanVencimento'];
          } ?>" required>
        </div>

        <div class="col-12 col-md-4">
          <label>Situação</label>
          <select name="situacao" id="situacao" class="form-control" required>
            <option value="Pago">Pago</option>
            <option value="Pendente">Pendente</option>
          </select>
        </div>

        <div class="col-6 col-md-4">
          <label>Valor</label>
          <input type="number" name="valor" placeholder="Valor" class="form-control" value="<?php if (isset($resMetasUpdate)) {
            echo $resMetasUpdate['metaValor'];
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
            foreach ($listaCategoriaGeral as $categoria) {
              echo '<option value="' . $categoria['catId'] . '">' . $categoria['catNome'] . '</option>';
            }
            ?>
          </select>
        </div>

        <div class="col-12 col-md-12 mt-3 text-center">
          <button type="submit" class="btn btn-outline-success">Alterar</button>
        </div>
      </form>
      <button class="btn btn-outline-danger mt-3" onclick="fecharModalAlterar()">Fechar</button>
    </div>
  </dialog>


  <script src="../js/limitaCaractere.js"></script>
  <script src="../js/modal.js"></script>
  <script src="../js/popover.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      <?php if ($dialog === 'liberar') { ?>
        abrirModalAlterar();
      <?php } ?>
    });
  </script>
</body>

</html>