<?php
require_once "../classeUsuario.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../bibliotecas/phpMailer/src/Exception.php';
require '../../bibliotecas/phpMailer/src/PHPMailer.php';
require '../../bibliotecas/phpMailer/src/SMTP.php';

$usuario = new Usuario();
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$resultadoEmail = $usuario->consultaEmail($email);

if ($resultadoEmail === 'inexistente') {
    if ($_GET['formaRecuperacao'] === 'email') {
        header('Location: ../../views/recuperarSenhaEmail.php?solicitacao=emailInexistente');
        exit;
    }
} else if ($resultadoEmail === 'existe') {
    // Gerar código de verificação
    $codigoVerificacao = rand(100000, 999999); // Gera um código de 6 dígitos
    $_SESSION['codigoVerificacao'] = $codigoVerificacao;

    // Enviar o email com PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Substitua pelo seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'financplus.financas@gmail.com'; // Seu email SMTP
        $mail->Password = 'F!n@n(+#2oXXIV'; // Sua senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Porta SMTP padrão para TLS

        // Configurações de remetente e destinatário
        $mail->setFrom('financplus.financas@gmail.com', 'Financ+ - Serviço de Gestão Financeira');
        $mail->addAddress($email); // Destinatário

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Código de recuperação de senha';
        $mail->Body    = "Olá, <br><br> Seu código de recuperação de senha é: <b>{$codigoVerificacao}</b>.<br><br>Insira esse código na página para redefinir sua senha.";
        $mail->AltBody = "Olá, <br><br> Seu código de recuperação de senha é: <b>{$codigoVerificacao}</b>.<br><br>Insira esse código na página para redefinir sua senha.";

        // Enviar o email
        $mail->send();
        echo 'Código de recuperação enviado com sucesso!';
        
        // Redirecionar para a página de confirmação do código
/*         header('Location: ../../views/confirmarCodigo.php'); */
        exit;
    } catch (Exception $e) {
        echo "Erro ao enviar email: {$mail->ErrorInfo}";
    }
}
