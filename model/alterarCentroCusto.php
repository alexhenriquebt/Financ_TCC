<?php
require_once 'classeCentroCusto.php';

$centroCusto = new CentroCusto();

// Usar filter_input para evitar vulnerabilidades de segurança
$cenId = filter_input(INPUT_GET, 'id_update', FILTER_SANITIZE_NUMBER_INT);
$catId = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
$cenTipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cenValor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$vencimento = filter_input(INPUT_POST, 'vencimento', FILTER_SANITIZE_STRING);
$cenDescricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$situacao = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cenNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$forma = filter_input(INPUT_POST, 'forma', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Valida se os campos obrigatórios foram preenchidos
if (!$cenId || !$catId || !$cenTipo || !$cenValor || !$vencimento || !$cenNome || !$situacao || !$forma) {
    // Redireciona com erro ou exibe mensagem de erro
    die('Por favor, preencha todos os campos obrigatórios.');
}

// Chamar o método para editar o centro de custo
$result = $centroCusto->editarCentroCusto(
    $cenId,
    $catId,
    $cenTipo,
    $cenValor,
    $vencimento,
    $cenDescricao,
    $cenNome,
    $situacao,
    $forma
);

// Verificar se a edição foi bem-sucedida e redirecionar ou exibir mensagem de erro
if ($result) {
    header('Location: ../views/centroCusto.php');
    exit(); // Certificar-se de que o script para aqui
} else {
    die('Erro ao atualizar o centro de custo.');
}
