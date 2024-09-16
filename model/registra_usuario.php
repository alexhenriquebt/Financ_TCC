<?php
//conecta com o banco de dados
require_once "../config/conexao.php";
$conexao = novaConexao();

$consulta = "SELECT * FROM tblUsuario WHERE usuEmail = :e ";
$cmd = $conexao->prepare($consulta);
$cmd->bindValue(':e', $_POST['email']);
$cmd->execute();


//verifica se email ja existe na tblUsuario
if ($cmd->rowCount() == 1) {
    header('Location: ../views/cadastrar.php?cadastro=erro');
    
} else {
    //registra usuário no banco de dados
    $sql = "INSERT INTO tblUsuario(usuNome, usuEmail, usuSenha) VALUES (:n, :e, :s)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':n', $_POST['nome']);
    $stmt->bindValue(':e', $_POST['email']);
    $stmt->bindValue(':s', $_POST['senha']);
    $stmt->execute();

    //consultar o nome do usuário
    $sqlConsulta = "SELECT * FROM tblUsuario WHERE usuEmail = :e AND usuSenha = :s";
    $consultaNome = $conexao->prepare($sqlConsulta);
    $consultaNome->bindValue(':e', $_POST['email']);
    $consultaNome->bindValue(':s', $_POST['senha']);
    $consultaNome->execute();
    $dados = $consultaNome->fetch();

    $usuario = $dados[1];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['senha'] = $_POST['senha'];
    $_SESSION['idUsuario'] = $dados[0];
    $_SESSION['telefone'] = $dados[4];
    $_SESSION['usuario'] = $usuario;
    $_SESSION['logado'] = 'sim';
    header('Location: ../views/home.php');
}
