<?php
require_once "classeUsuario.php";
$usuario = new Usuario();

// Sanitização e validação dos dados de entrada
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

// Validação: Verificar se os campos obrigatórios foram preenchidos corretamente
if (!$nome || !$email || !$senha) {
    header('Location: ../views/cadastrar.php?cadastro=dadosIncorretos');
    exit();
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$usuario->registrarUsuario($nome, $email, $senhaHash);

header('Location: ../views/home.php');
exit();
