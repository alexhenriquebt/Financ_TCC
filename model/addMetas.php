<?php
require_once "classeMetas.php";
require_once "classeCategoria.php";

// Instanciando as classes necessárias
$Metas = new Metas();
$categoria = new Categoria();

// Sanitização dos dados de entrada usando filter_input
$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$valorInicial = filter_input(INPUT_POST, 'valorInicial', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$situacao = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$vencimento = filter_input(INPUT_POST, 'dataVencimento', FILTER_SANITIZE_STRING);


// Verificar se os campos obrigatórios foram preenchidos
if (!$categoria || !$nome || !$valorInicial || !$valor || !$descricao || !$situacao || !$vencimento ) {
    die('Por favor, preencha todos os campos obrigatórios.');
}

$Metas->adicionarMetas($nome, $descricao, $valorInicial, $valor, $categoria ,$vencimento, $situacao);

header("Location: ../views/metas.php");
exit();
