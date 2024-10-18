<?php
require '../vendor/autoload.php'; // Inclua o autoload do Composer
require_once "classeUsuario.php";

use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Symfony\Component\Mime\Email;


$usuario = new Usuario();
$emailUser = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$resultadoEmail = $usuario->consultaEmail($emailUser);

if ($resultadoEmail === 'inexistente') {
    if ($_GET['formaRecuperacao'] === 'email') {
        header('Location: ../views/recuperarSenhaEmail.php?solicitacao=emailInexistente');
        exit;
    }
} else if ($resultadoEmail === 'existe') {
    // Gerar código de verificação
    $codigoVerificacao = rand(100000, 999999); // Gera um código de 6 dígitos
    $_SESSION['codigoVerificacao'] = $codigoVerificacao;

  // Configurar o cliente do Google
$client = new Client();
$client->setAuthConfig(__DIR__ . '/../credentials.json'); // Ajuste o caminho conforme necessário
$client->addScope(Gmail::GMAIL_SEND);
$client->setAccessType('offline');


    // Criar instância do serviço Gmail
    $service = new Gmail($client);

    // Criar o e-mail
    $email = new Email();
    $email->from('financplus.financas@gmail.com')
        ->to($emailUser)
        ->subject('Código de recuperação de senha')
        ->html("<p>Olá, <br><br> Seu código de recuperação de senha é: <b>{$codigoVerificacao}</b>.<br><br>Insira esse código na página para redefinir sua senha.</p>")
        ->text("Seu código de recuperação de senha é: {$codigoVerificacao}");

    // Codificar a mensagem em base64
    $message = new Message();
    $message->setRaw(base64_encode($email->toString())); // Use base64_encode diretamente

    // Enviar o e-mail
    try {
        $service->users_messages->send('me', $message);
        echo 'Código de recuperação enviado com sucesso!';
        header('Location: ../views/confirmarCodigo.php');
        exit;
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: " . $e->getMessage();
    }
}