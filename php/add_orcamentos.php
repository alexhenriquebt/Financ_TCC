<?php

require_once "conexao.php";
require_once "classe_categoria.php";
require_once "classe_orcamento.php";
$categoria = new Categoria();
$orcamento = new Orcamento();
$catNome = addslashes($_POST['categoria']);
$nome = addslashes($_POST['nome']);
$descricao = addslashes($_POST['descricao']);
$data = addslashes($_POST['data']);
$saldo = addslashes($_POST['saldo']);
$idUsuario = addslashes($_SESSION['idUsuario']);

$idCategoria = $categoria->buscarCategoriasAlterar($catNome);
$orcamento->adicionarOrcamento($nome, $descricao, $data, $saldo, $idUsuario, $idCategoria);

header("Location: ../pg/orcamentos.php");