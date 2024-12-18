<?php
require_once "classeCentroCusto.php";
require_once "classeCategoria.php";

// Instanciando as classes necessárias
$centroCusto = new CentroCusto();
$categoria = new Categoria();

// Sanitização dos dados de entrada usando filter_input
$catId = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$situacao = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$vencimento = filter_input(INPUT_POST, 'dataVencimento', FILTER_SANITIZE_STRING);
$forma = filter_input(INPUT_POST, 'forma', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Verificar se os campos obrigatórios foram preenchidos
if (!$catId || !$nome || !$tipo || !$valor || !$vencimento || !$forma) {
    die('Por favor, preencha todos os campos obrigatórios.');
}

$centroCusto->adicionarCentroCusto($nome, $descricao, $tipo, $valor, $catId,$vencimento, $situacao, $forma);

header("Location: ../views/centroCusto.php");
exit();
