<?php
session_start();

// Conecta com a classeUsuario.php
require_once "classeUsuario.php";
$usuario = new Usuario();

// Sanitiza e valida os dados do formulário
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

// Verifica se os campos de e-mail e senha foram preenchidos corretamente
if ($email && $senha) 
{
    $dadosUser = $usuario->loginResultado($email, $senha);

    if ($dadosUser) 
    {
        $_SESSION['email'] = $dadosUser['usuEmail'];
        $_SESSION['idUsuario'] = $dadosUser['usuId'];
        $_SESSION['telefone'] = $dadosUser['usuTelefone'];
        $_SESSION['usuario'] = $dadosUser['usuNome'];
        $_SESSION['logado'] = 'sim';
        header('Location: ../views/home.php');
        exit();
    } 
    else 
    {
        // Senha ou email incorretos
        $_SESSION['logado'] = 'nao';
        header('Location: ../views/entrar.php?login=erro');
        exit();
    }
    
} 
else 
{
    // Campos não preenchidos corretamente
    $_SESSION['logado'] = 'nao';
    header('Location: ../views/entrar.php?login=erro');
    exit();
}
