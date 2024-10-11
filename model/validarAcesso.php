<?php
session_start();

if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== 'sim') {
    // Gera um novo ID de sessão para prevenir ataques de fixação de sessão
    session_regenerate_id(true); // true para excluir o antigo ID da sessão

    // Redireciona o usuário para a página de login com um código de erro
    header("Location: ../views/entrar.php?login=erro2");
    exit(); // Importante para garantir que o código pare após o redirecionamento
}


// Caso precise de redirecionamento para páginas protegidas, verifique parâmetros permitidos
if (isset($_GET['path'])) {
    // Lista de caminhos permitidos para evitar acesso indevido
    $allowedPaths = [
        "../views/pagina1.php",
        "../views/pagina2.php"
        // Adicione mais páginas permitidas conforme necessário
    ];

    // Verifica se o caminho solicitado é permitido
    $originalPath = $_GET['path'];
    if (in_array($originalPath, $allowedPaths)) {
        header("Location: $originalPath");
        exit();
    } else {
        // Redireciona para página de acesso negado caso o caminho não seja permitido
        header("Location: ../views/acesso_negado.php");
        exit();
    }
}

