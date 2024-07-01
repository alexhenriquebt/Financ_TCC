<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/alterarconfig.css">
    <link rel="shortcut icon" href="../img/icon_title.png" />
    <title>Alterar informações</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>
<body>
        
        <div class="container">      
            <form method="post" action="" class="row g-3"> 
              <h2>Informações pessoais</h2> 
              <div class="col-12 col-md-10"> 
                <label>Nome</label>
                <input class="form-control" type="text" placeholder="Nome completo"/>
              </div>
              
              <div class="col-12 col-md-6"> 
                <label>Email</label>
                <input class="form-control" type="email" placeholder="Email"/> 
              </div>
              
              <div class="col-10 col-md-4"> 
                <label>Telefone</label>
                <input class="form-control" type="tel" placeholder="Ex.:(xx) xxxxx-xxxx"/> 
              </div>
              
              <div class="col-12 col-md-6"> 
                <label>Senha</label>
                <input class="form-control" type="password" placeholder="Senha"/>
              </div>
              
              <div class="mt-3 w-100 text-center"> 
                <button type="submit" class="btn btn-outline-danger w-50">Alterar</button> 
              </div>
            </form>
            <a href="configuracoes.php">
              <button class="btn btn-warning mt-3">Voltar</button>
            </a>
        </div>

      
      <!-- ------------------------- Popover ------------------------- -->
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
    <!-- ------------------------- Popover fim ------------------------- -->
</body>
</html>