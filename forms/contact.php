<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';

$mail = new PHPMailer(true);

try {
    // SMTP Config
    $mail->isSMTP();
    $mail->Host = 'smtp.zoho.in';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@sai-corporation.in'; // your Zoho email
    $mail->Password = 'XdrCxX71sP94'; // your Zoho password or app password
    $mail->SMTPSecure = 'ssl'; // or 'tls' for port 587
    $mail->Port = 465;

    // Always send from your verified domain
    $mail->setFrom('info@sai-corporation.in', 'Sai Corporation');

    // Set reply-to to the user's email
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $mail->addReplyTo($_POST['email'], $_POST['name']);
    }

    $mail->addAddress('info@sai-corporation.in'); // Destination (your own inbox)
    $mail->Subject = $_POST['subject'];
    $mail->Body = "From: {$_POST['name']}\nEmail: {$_POST['email']}\n\nMessage:\n{$_POST['message']}";

    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
