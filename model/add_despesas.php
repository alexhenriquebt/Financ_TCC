<?php

require_once "../config/conexao.php";
require_once "classe_categoria.php";
require_once "classe_despesa.php";
$categoria = new Categoria();
$despesa = new Despesa();
$catNome = addslashes($_POST['categoria']);
$nome = addslashes($_POST['nome']);
$descricao = addslashes($_POST['descricao']);
$situacao = addslashes($_POST['situacao']);
$data = addslashes($_POST['data']);
$valor = addslashes($_POST['valor']);
$idUsuario = addslashes($_SESSION['idUsuario']);

$idCategoria = $categoria->buscarCategoriasAlterar($catNome);
$despesa->adicionarDespesa($nome, $descricao, $situacao, $data, $valor, $idUsuario, $idCategoria);

header("Location: ../views/despesas.php");