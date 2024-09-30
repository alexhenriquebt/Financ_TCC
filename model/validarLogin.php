<?php
//conecta com o banco de dados
require_once "classe_usuario.php";
$usuario = new Usuario();
$cmd = $usuario->loginConsulta();
$dadosUser = $usuario->loginResultado();

if ($cmd->rowCount() == 1) {
    $usuarioInfo = $dadosUser[1];
    $_SESSION['email'] = $dadosUser[2];
    $_SESSION['senha'] = $dadosUser[3];
    $_SESSION['idUsuario'] = $dadosUser[0];
    $_SESSION['telefone'] = $dadosUser[4];
    $_SESSION['usuario'] = $usuarioInfo;
    $_SESSION['logado'] = 'sim';
    header('Location: ../views/home.php');
} else {
    $_SESSION['logado'] = 'nao';

    header('Location: ../views/entrar.php?login=erro');
}