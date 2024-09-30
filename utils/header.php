<?php
$base_url = rtrim(dirname($_SERVER["PHP_SELF"]), '/view');
$page_name = basename($_SERVER["PHP_SELF"], ".php");

$titulos_paginas = [
    "contas" => "Contas",
    "relatorios" => "Relatórios",
    "configuracoes" => "Configurações",
    "ajuda" => "Ajuda"
];

$titulo = $titulos_paginas[$page_name] ?? ucfirst($page_name);

?>
<link rel="stylesheet" href="../css/navbar_mobile.css">
<header>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="">
                    <h2 class="mt-3"><?= $titulo; ?></h2>
                </div>
            </div>
            <div class="col-6">
                <div class="user-config">
                    <div class="btn-group">
                        <button type="button" class="btn-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                        </button>
                        <button style="border: none; background-color: white;" data-bs-toggle="popover" data-bs-title="Notificações" data-bs-content="Sem notificações" data-bs-placement="bottom">
                            <i class="bi bi-bell-fill"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item item-mobile" href="<?= $base_url; ?>/home.php">Home</a></li>
                            <li><a class="dropdown-item item-mobile" href="<?= $base_url; ?>/contas.php">Contas</a></li>
                            <li><a class="dropdown-item item-mobile" href="<?= $base_url; ?>/relatorios.php">Relatórios</a></li>
                            <li><a class="dropdown-item item-mobile" href="<?= $base_url; ?>/configuracoes.php">Configurações</a></li>
                            <li><a class="dropdown-item item-mobile" href="<?= $base_url; ?>/ajuda.php">Ajuda</a></li>
                            <li><a class="dropdown-item" href="<?= $base_url; ?>/../model/logoff.php">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>