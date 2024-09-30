<?php

require_once "../config/conexao.php";
require_once "classe_centrocusto.php";
require_once "classe_categoria.php";

$centroCusto = new CentroCusto();
$categoria = new Categoria();

$catNome = addslashes($_POST['categoria']);
$nome = addslashes($_POST['nome']);
$descricao = addslashes($_POST['descricao']);
$situacao = addslashes($_POST['situacao']);
$data = addslashes($_POST['data']);


$idCategoria = $categoria->buscarCategoriasAlterar($catNome);
/* $receita->adicionarReceita($nome, $descricao, $situacao, $data, $valor, $idUsuario, $idCategoria); */

header("Location: ../views/centroCusto.php");