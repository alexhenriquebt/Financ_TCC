<?php
require_once 'classe_despesa.php';
$despesa = new Despesa();
$id_despesa = addslashes($_GET['id_update']);
$id_categoria = addslashes($_POST['categoria']);
$valor = addslashes($_POST['valor']);
$data = addslashes($_POST['data']);
$descricao = addslashes($_POST['descricao']);
$situacao = addslashes($_POST['situacao']);
$nome = addslashes($_POST['nome']);

$despesa->editarDespesas($id_despesa, $id_categoria, $valor, $data, $descricao, $situacao, $nome);
header('Location: ../views/despesas.php');