<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
if (isset($_POST['enviar'])) {

    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'wscentroautomotivo960@gmail.com';
        $mail->Password   = 'ecxa xzgl zozp vnoo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('wscentroautomotivo960@gmail.com', 'WS AUTO');
        $mail->addAddress('lucasgoncalvess256@gmail.com', 'Lucas');
        $mail->isHTML(true);
        $mail->Subject = 'Aqui está o assunto';
        $mail->Body    = 'Este é o corpo da mensagem <b>em HTML!</b>';
        $mail->AltBody = 'Este é o corpo da mensagem em texto simples para clientes de e-mail sem suporte a HTML';

        if ($mail->send()) {
            header('location:index.php');
        }
    } catch (Exception $e) {
        echo "Mensagem não pôde ser enviada. Mailer Error: {$mail->ErrorInfo}";
    }
}
