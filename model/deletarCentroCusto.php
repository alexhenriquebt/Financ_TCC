<?php

require_once "classeCentroCusto.php";
$centroCusto = new CentroCusto();

if (!isset($_GET['cenIdDeletar'])) {
    die('Parâmetro ID não fornecido.');
}

// Sanitiza a entrada para garantir que é um número inteiro
$cenId = filter_input(INPUT_GET, 'cenIdDeletar', FILTER_SANITIZE_NUMBER_INT);

if ($cenId === null || $cenId === false) {
    die('ID inválido. Por favor, forneça um ID válido para exclusão.');
}
if ($centroCusto->excluirCentroCusto($cenId)) {
    header('Location: ../views/centroCusto.php');
    exit();
} else {
    die('Erro ao excluir o centro de custo. Por favor, tente novamente.');
}
