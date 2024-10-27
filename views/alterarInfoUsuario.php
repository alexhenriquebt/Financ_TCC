<?php
require_once '../model/validarAcesso.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/alterarConfiguracoes.css">
    <link rel="shortcut icon" href="../assets/images/iconTituloPg.png" />
    <title>Alterar informações</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>
<body>
        
        <div class="container">      
            <form method="post" action="../model/alterarInfoUsuario.php" class="row g-3"> 
              <h2>Informações pessoais</h2> 
              <div class="col-12 col-md-10"> 
                <label>Nome</label>
                <input class="form-control" type="text" name="nome" placeholder="Nome" required/>
              </div>
              
              <div class="col-12 col-md-6"> 
                <label>Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" required/> 
              </div>
              
              <?php
              if(!empty($_SESSION['telefone']))
              {
              ?>
              <div class="col-10 col-md-4"> 
                <label>Telefone</label>
                <input class="form-control" type="tel" name="telefone" id="telefone" placeholder="Ex.:(xx) xxxxx-xxxx" pattern=".{15,}" title="15 caracteres no mínimo" required/> 
              </div>
              <?php
              }
              ?>
              
              <div class="mt-3 w-100 text-center"> 
                <button type="submit" class="btn btn-outline-danger w-50">Alterar</button> 
              </div>
            </form>
            <a href="configuracoes.php">
              <button class="btn btn-warning mt-3">Voltar</button>
            </a>
        </div>

    <script src="../js/mascaraTelefone.js"></script>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
</body>
</html>
