<?php

require_once "classeMetas.php";
$Metas = new Metas();

if (!isset($_GET['metaIdDeletar'])) {
    die('Parâmetro ID não fornecido.');
}

// Sanitiza a entrada para garantir que é um número inteiro
$metaId = filter_input(INPUT_GET, 'metaIdDeletar', FILTER_SANITIZE_NUMBER_INT);

if ($metaId === null || $metaId === false) {
    die('ID inválido. Por favor, forneça um ID válido para exclusão.');
}
if ($Metas->excluirMetas($metaId)) {
    header('Location: ../views/metas.php');
    exit();
} else {
    die('Erro ao excluir a meta. Por favor, tente novamente.');
}
