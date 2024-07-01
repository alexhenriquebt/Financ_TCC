<?php

require_once "conexao.php";
$conexao = novaConexao();

$sql = "DELETE FROM tblUsuario WHERE idUsuario = :i";
$cmd = $conexao->prepare($sql);
$cmd-> bindValue(':i', $_SESSION['idUsuario']);
$cmd->execute();
session_destroy();

header("Location: ../index.html");