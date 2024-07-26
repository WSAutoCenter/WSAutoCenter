<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['xmlData'])) {
    $xml = simplexml_load_string($_POST['xmlData']);
    $sendDate = strtotime((string)$xml->sendDate);
    $currentTime = time();

    if ($sendDate > $currentTime) {
        $waitTime = $sendDate - $currentTime;
        sleep($waitTime);
    }

    foreach ($xml->contact as $contact) {
        $email = (string)$contact->email;
        $message = (string)$contact->message;
        $attachment = $contact->attachment;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.office365.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'seu-email@outlook.com';
            $mail->Password   = 'sua-senha';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('seu-email@outlook.com', 'Seu Nome');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Assunto do E-mail';
            $mail->Body    = $message;
            $mail->AltBody = strip_tags($message);

            if ($attachment) {
                $filename = (string)$attachment['filename'];
                $tempFilePath = sys_get_temp_dir() . '/' . $filename;
                move_uploaded_file($_FILES['attachments']['tmp_name'][0], $tempFilePath);
                $mail->addAttachment($tempFilePath, $filename);
            }

            $mail->send();
        } catch (Exception $e) {
            // Handle error
        }
    }
}
?>
