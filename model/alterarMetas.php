<?php
require_once 'classeMetas.php';

$Metas = new Metas();

// Usar filter_input para evitar vulnerabilidades de segurança
$metaId = filter_input(INPUT_GET, 'id_update', FILTER_SANITIZE_NUMBER_INT);
$catId = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
$metaValorInicial = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$metaValor = filter_input(INPUT_POST, 'valor2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$vencimento = filter_input(INPUT_POST, 'dataVencimento', FILTER_SANITIZE_STRING);
$metaDescricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$situacao = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$metaNome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Valida se os campos obrigatórios foram preenchidos
if (!$metaId || !$catId || !$metaValorInicial || !$metaValor || !$vencimento || !$metaNome || !$situacao) {
    // Redireciona com erro ou exibe mensagem de erro
    die('Por favor, preencha todos os campos obrigatórios.');
}

// Chamar o método para editar o centro de custo
$result = $Metas->editarMetas(
    $metaId,
    $catId,
    $metaValorInicial,
    $metaValor,
    $vencimento,
    $metaDescricao,
    $metaNome,
    $situacao
);

// Verificar se a edição foi bem-sucedida e redirecionar ou exibir mensagem de erro
if ($result) {
    header('Location: ../views/Metas.php');
    exit(); // Certificar-se de que o script para aqui
} else {
    die('Erro ao atualizar metas.');
}
