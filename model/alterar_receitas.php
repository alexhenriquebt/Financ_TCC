<?php
require_once 'classe_receita.php';
$receita = new Receita();
$id_receita = addslashes($_GET['id_update']);
$id_categoria = addslashes($_POST['categoria']);
$valor = addslashes($_POST['valor']);
$data = addslashes($_POST['data']);
$descricao = addslashes($_POST['descricao']);
$situacao = addslashes($_POST['situacao']);
$nome = addslashes($_POST['nome']);

$receita->editarReceitas($id_receita, $id_categoria, $valor, $data, $descricao, $situacao, $nome);
header('Location: ../views/receitas.php');