<?php
// Host = Endereço do servidor SMTP do hotmail: smtp-mail.outlook.com
// Username = hotmail SMTP username: Seu endereço completo do hotmail (ex.: nome@hotmail.com)
// Password = Senha hotmail SMTP: A senha que você usa para fazer login no hotmail
// Port = Porta hotmail SMTP (TLS): 587

use PHPMailer\PHPMailer\PHPMailer;

function enviar_email($destinatario, $assunto, $mensagemHTML)
{

    require '../vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'batata_jonesrodrigues@hotmail.com';
    $mail->Password = 'batata2023';

    $mail->SMTPSecure = false;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('batata_jonesrodrigues@hotmail.com', "Seu site");
    $mail->addAddress($destinatario);
    $mail->Subject = $assunto;

    $mail->Body = $mensagemHTML;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }

}
?>