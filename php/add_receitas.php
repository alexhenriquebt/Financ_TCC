<?php

require_once "conexao.php";
$conexao = novaConexao();

//ESCOLHE CATEGORIA
$sqlCat = "SELECT * FROM tblCategoria WHERE catNome = :c ";
$cmdCat = $conexao->prepare($sqlCat);
$cmdCat->bindValue(':c', $_POST['categoria']);
$cmdCat->execute();
$resultado = $cmdCat->fetch();
$idCategoria = $resultado[0];
$_SESSION['catNome'] = $resultado[1];

//iNSERE NA TBLRECEITA
$sql = "INSERT INTO tblReceita(recNome, recDescricao, recSituacao, recData, recValor, recIdUsuario, recIdCategoria) VALUES (:nom, :de, :sit, :dat, :val, :idu, :idc)";
$cmd = $conexao->prepare($sql);
$cmd-> bindValue(':nom', $_POST['nome']);
$cmd-> bindValue(':de', $_POST['descricao']);
$cmd-> bindValue(':sit', $_POST['situacao']);
$cmd-> bindValue(':dat', $_POST['data']);
$cmd-> bindValue(':val', $_POST['saldo']);
$cmd-> bindValue(':idu', $_SESSION['idUsuario']);
$cmd-> bindValue(':idc', $idCategoria);
$cmd->execute();

$consulta = "SELECT * FROM tblReceita WHERE recIdUsuario = :idu";
$cmdConsulta = $conexao->prepare($consulta);
$cmdConsulta-> bindValue(':idu', $_SESSION['idUsuario']);
$cmdConsulta->execute();
$resulConsulta = $cmdConsulta->fetchAll(PDO::FETCH_ASSOC);

header("Location: ../pg/receitas.php");