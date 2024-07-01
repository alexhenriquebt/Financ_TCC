<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/config.css">
    <link rel="shortcut icon" href="../img/icon_title.png">
    <title>Configurações</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row g-3 m-0">
        <!-- volume para dar espaçamento -->
        <div class="col-2 navbar-lateral-fantasma">
            <!-- sem conteúdo -->
        </div>

        <!-- ------------------------- navbar-lateral fixada ------------------------- -->
        <div class="navbar-lateral text-center m-0">
            <div class="row g-5">
                <div class="col-12">
                    <a href="home.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Home">
                        <img src="../img/icon_title.png" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="col-12">
                    <a href="orcamentos.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Orçamentos">
                        <i class="bi bi-cash-coin"></i>
                    </a>
                </div>
                <div class="col-12">
                    <a href="despesas.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Despesas">
                        <i class="bi bi-graph-down-arrow"></i>
                    </a>
                </div>
                <div class="col-12">
                    <a href="receitas.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Receitas">
                        <i class="bi bi-graph-up-arrow"></i>
                    </a>
                </div>
                <div class="col-12">
                    <a href="relatorios.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Relatórios">
                        <i class="bi bi-graph-up"></i>
                    </a>
                </div>
                <div class="col-12">
                    <a href="configuracoes.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Configurações">
                        <i class="bi bi-gear"></i>
                    </a>
                </div>
                <div class="col-12">
                    <a href="ajuda.php" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Ajuda">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
            </div>

        </div>
        <!-- ------------------------- navbar-lateral fixada fim ------------------------- -->
        <!-- ------------------------- User icon, notificações e logout ------------------------- -->

        <div class="col-10">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="titulo-bloco">
                                <h2 class="mt-3">Configurações</h2>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="user-config">
                                <div class="btn-group">
                                    <button type="button" class="btn-dropdown dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle"></i>
                                    </button>
                                    <button style="border: none; background-color: white;" data-bs-toggle="popover" data-bs-title="Notificações" data-bs-content="Sem notificações" data-bs-placement="bottom">
                                        <i class="bi bi-bell-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item dropdown-item-mobile" href="home.php">Home</a></li>
                                        <li><a class="dropdown-item dropdown-item-mobile" href="orcamentos.php">Orçamentos</a></li>
                                        <li><a class="dropdown-item dropdown-item-mobile" href="despesas.php">Despesas</a></li>
                                        <li><a class="dropdown-item dropdown-item-mobile" href="receitas.php">Receitas</a></li>
                                        <li><a class="dropdown-item dropdown-item-mobile" href="relatorios.php">Relatórios</a></li>
                                        <li><a class="dropdown-item dropdown-item-mobile" href="configuracoes.php">Configurações</a>
                                        </li>
                                        <li><a class="dropdown-item dropdown-item-mobile" href="ajuda.php">Ajuda</a>
                                        </li>
                                        <li><a class="dropdown-item" href="../php/logoff.php">Sair</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ------------------------- User icon, notificações e logout fim ------------------------- -->

            <!-- ------------------------- configurações ------------------------- -->
            <main>
                <div class="info-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <a class="" href="#">
                                    <i class="bi icone bi-pencil-square"></i>
                                </a>
                                <img class="img img-fluid w-75" src="../img/garoto.png" alt="">
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="p-3">
                                    <div class="input-group mb-3">
                                        <p class="input-group-text w-100">Nome: <?php echo $_SESSION['usuario'] ?></p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <p class="input-group-text w-100">Email: <?php echo $_SESSION['email'] ?></p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <p class="input-group-text w-100">Telefone: <?php echo $_SESSION['telefone'] ?></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <a href="../pg/alterarconfiguracoes.php">
                                                <button type="button" class="btn btn-warning">Alterar informações</button>
                                            </a>
                                        </div>
                                        <form action="../php/deletar_conta.php" class="col-12 col-md-6">
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Você realmente quer excluir sua conta?')">Deletar conta</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- ------------------------- Popover ------------------------- -->
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
    <!-- ------------------------- Popover fim ------------------------- -->
</body>

</html>