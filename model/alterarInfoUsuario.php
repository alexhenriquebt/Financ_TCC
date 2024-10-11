<?php

require_once "classeUsuario.php";
$usuario = new Usuario();

// Usar filter_input para evitar vulnerabilidades de segurança
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);
$senha = filter_input(INPUT_POST, 'senha');

// Validar se os campos obrigatórios foram preenchidos
if (empty($nome) || empty($email) || empty($telefone) || empty($senha)) {
    die('Por favor, preencha todos os campos obrigatórios.');
}
// Hash da senha antes de armazenar
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$result = $usuario->alterarInformacoes($nome, $email, $telefone, $senhaHash);

if ($result) {
    header("Location: ../views/configuracoes.php");
    exit();
} else {
    die('Erro ao alterar as informações do usuário. Por favor, tente novamente.');
}
