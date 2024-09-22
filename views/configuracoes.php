<?php

session_start();

if (isset($_GET['email']) && ($_GET['email'] == 'erro')) {
    ?>

<script>
    window.alert('Email já está em uso!')
    </script>

<?php
}

require_once '../model/validador_acesso.php';
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
        <!-- navbar lateral -->
        <?php require_once '../utils/navbar_lateral.php' ?>

        <div class="col-10">
            <!-- user icon, navbar mobile e as notificações -->
            <?php require_once '../utils/navbar_mobile.php' ?>
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
                                        <p class="input-group-text w-100">
                                            Telefone:
                                            <?php
                                            if ($_SESSION['telefone'] == null) {
                                            ?>
                                                <button class="m-2" onclick="abrirModalAdicionar()">Adicionar</button>
                                            <?php
                                            } else {
                                                echo $_SESSION['telefone'];
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <a href="../views/alterarconfiguracoes.php">
                                                <button type="button" class="btn btn-warning">Alterar informações</button>
                                            </a>
                                        </div>
                                        <form action="../model/deletar_conta.php" method="post" class="col-12 col-md-6">
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

    <!--modal de add do telefone -->
    <dialog id="modalAdicionar">
        <div class="container">
            <form action="../model/add_telefone.php" method="post" class="row g-5">
                <h3 class="col-12">Adicionar telefone</h3>
                <div class="col-12">
                    <label for="">Celular:</label>
                    <input type="tel" name="telefone" id="telefone" placeholder="Ex.:(xx) xxxxx-xxxx" class="form-control w-75" pattern=".{15,}" title="15 caracteres no mínimo" required>
                    <button type="submit" class="btn btn-warning w-50 mt-3">Adicionar</button>
                </div>
            </form>
        </div>
        <button class="btn btn-outline-danger mt-5" onclick="fecharModalAdicionar()">Fechar</button>
    </dialog>

    <script src="../js/mascara_telefone.js"></script>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
    <script src="../js/modals.js"></script>
</body>

</html>