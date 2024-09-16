<?php

require_once "../config/conexao.php";
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

//envia as informações para o banco de dados somente se todas as informações estejam preenchidas
if($_GET['add_despesa'] == 'true') {
$idCategoria = $categoria->buscarCategoriasAlterar($catNome);
$orcamento->adicionarOrcamento($nome, $descricao, $data, $saldo, $idUsuario, $idCategoria);

header("Location: ../views/orcamentos.php");
}
//se faltar informações o usuário deve ir a página orc_add_despesa.php para adicionar despesas ao orçamento
else {
header("Location: ../views/orc_add_despesa.php");

}