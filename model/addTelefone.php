<?php
require_once "classeUsuario.php";
$usuario = new Usuario();
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);

$usuario->adicionarTelefone($telefone);
header("Location: ../views/configuracoes.php");
exit();