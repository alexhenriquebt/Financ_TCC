<?php
require_once 'classe_orcamento.php';
$orcamento = new Orcamento();
$id_orcamento = addslashes($_GET['id_update']);
$id_categoria = addslashes($_POST['categoria']);
$saldo = addslashes($_POST['saldo']);
$data = addslashes($_POST['data']);
$descricao = addslashes($_POST['descricao']);
$nome = addslashes($_POST['nome']);

$orcamento->editarOrcamentos($id_orcamento, $id_categoria, $saldo, $data, $descricao, $nome);
header('Location: ../views/orcamentos.php');