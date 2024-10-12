<?php
require_once "../classeUsuario.php";
$usuario = new Usuario();
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$resultado = $usuario->consultaEmail($email);

if($resultado === 'existe')
{
    if($_GET['formaRecuperacao'] === 'email')
    {
        header('Location: ../../views/recuperarSenhaEmail.php?solicitacao=emailExistente');
    }
    else if($_GET['formaRecuperacao'] === 'telefone')
    {
        header('Location: ../../views/recuperarSenhaTelefone.php?solicitacao=emailExistente');
    }

}
else {
    header('Location: ../../views/confirmarCodigo.php');
}