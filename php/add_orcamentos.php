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


if($_GET['add_despesa'] == 'true') {
$idCategoria = $categoria->buscarCategoriasAlterar($catNome);
$orcamento->adicionarOrcamento($nome, $descricao, $data, $saldo, $idUsuario, $idCategoria);

header("Location: ../pg/orcamentos.php");
}
else {
header("Location: ../pg/orc_add_despesa.php");

}