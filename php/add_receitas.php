<?php

require_once "conexao.php";
require_once "classe_categoria.php";
require_once "classe_receita.php";
$categoria = new Categoria();
$receita = new Receita();
$catNome = addslashes($_POST['categoria']);
$nome = addslashes($_POST['nome']);
$descricao = addslashes($_POST['descricao']);
$situacao = addslashes($_POST['situacao']);
$data = addslashes($_POST['data']);
$saldo = addslashes($_POST['saldo']);
$idUsuario = addslashes($_SESSION['idUsuario']);

$idCategoria = $categoria->buscarCategoriasAlterar($catNome);
$receita->adicionarReceita($nome, $descricao, $situacao, $data, $valor, $idUsuario, $idCategoria);

header("Location: ../pg/receitas.php");