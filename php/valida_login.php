<?php
//conecta com o banco de dados
require_once "conexao.php";
$conexao = novaConexao();

//consulta da tabela usuários
$sql = "SELECT * FROM tblUsuario WHERE usuEmail = :e AND usuSenha = :s";
$stmt = $conexao->prepare($sql);
$stmt-> bindValue(':e', $_POST['email']);
$stmt-> bindValue(':s', $_POST['senha']);
$stmt->execute();
//armazena o resultado da consulta no vetor resultado
$resultado = $stmt->fetch();

//caso consulta retorne uma linha
//email e senha estão corretos
if($stmt->rowCount()==1) {
    $usuario = $resultado[1];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['senha'] = $_POST['senha'];
    $_SESSION['idUsuario'] = $resultado[0];
    $_SESSION['telefone'] = $resultado[4];
    $_SESSION['usuario'] = $usuario;
    $_SESSION['logado'] = 'sim';
    header('Location: ../pg/home.php');
}
else
{
    $_SESSION['logado'] = 'nao';

    header('Location: ../pg/entrar.php?login=erro');
}

?>