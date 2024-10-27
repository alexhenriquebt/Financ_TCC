<?php
require_once '../model/validarAcesso.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../css/ajuda.css" />
  <link rel="shortcut icon" href="../assets/images/iconTituloPg.png" />
  <title>Central de ajuda</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="row g-3 m-0">
    <!-- navbar lateral -->
    <?php require_once '../utils/navbarLateral.php'?>

    <div class="col-10">
      <!-- user icon, navbar mobile e as notificações -->
    <?php require_once '../utils/header.php'?>
      <!-- ------------------- Conteúdo da pg ------------------- -->
        <form class="d-flex mt-5" role="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" />
          <button class="btn btn-danger" type="submit">Pesquisar</button>
        </form>

      <div class="text-center">
        <img class="img-fluid w-50 img-ajuda-principal" src="../assets/images/centralAjuda.png" alt="tela vazia" />
        <h3 class="mt-5">Responda todas suas dúvidas aqui</h3>
      </div>

      <div class="container">
        <div class="row g-3 cards-ajuda">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
              <img src="../assets/images/ajuda1.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title text-center">Meus dados</h5>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
              <img src="../assets/images/ajuda2.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title text-center">Conta</h5>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
              <img src="../assets/images/ajuda3.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title text-center">Como usar o site?</h5>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
              <img src="../assets/images/ajuda4.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title text-center">Problemas com receitas</h5>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
              <img src="../assets/images/ajuda5.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title text-center">Problemas com despesas</h5>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
              <img src="../assets/images/ajuda6.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title text-center">Problemas com orçamentos</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ------------------- Conteúdo da pg fim ------------------- -->
    </div>
  </div>

  <!-- ------------------- popover ------------------- -->
  <script src="../js/popup_notificacoes.js"></script>
  <!-- ------------------- popover fim ------------------- -->
</body>

</html>