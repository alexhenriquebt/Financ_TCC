<?php

require_once "conexao.php";
require_once "classe_categoria.php";
require_once "classe_despesa.php";
$categoria = new Categoria();
$despesa = new Despesa();
$catNome = addslashes($_POST['categoria']);
$nome = addslashes($_POST['nome']);
$descricao = addslashes($_POST['descricao']);
$data = addslashes($_POST['data']);
$valor = addslashes($_POST['valor']);
$idUsuario = addslashes($_SESSION['idUsuario']);

$idCategoria = $categoria->buscarCategoriasAlterar($catNome);
$despesa->adicionarDespesa($nome, $descricao, $data, $valor, $idUsuario, $idCategoria);

header("Location: ../pg/despesas.php");