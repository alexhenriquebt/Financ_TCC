<?php
require_once 'classe_receita.php';
$receita = new Receita();
$id_receita = addslashes($_GET['id_update']);
$id_categoria = addslashes($_POST['categoria']);
$valor = addslashes($_POST['saldo']);
$data = addslashes($_POST['data']);
$descricao = addslashes($_POST['descricao']);
$nome = addslashes($_POST['nome']);

$receita->editarReceitas($id_receita, $id_categoria, $valor, $data, $descricao, $nome);
header('Location: ../pg/receitas.php');