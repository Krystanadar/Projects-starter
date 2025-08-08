<?php
// sendemail.php (bez Composeru)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(403);
    echo "Nepovolený přístup.";
    exit;
}

// Získání dat
$name    = htmlspecialchars($_POST['name'] ?? '');
$email   = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$people  = htmlspecialchars($_POST['people'] ?? '');
$event   = htmlspecialchars($_POST['eventType'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

// Validace emailu
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Neplatná e-mailová adresa.";
    exit;
}

$subject = "Nový požadavek z webu Amfora Brno";
$body = "Jméno: $name\nEmail: $email\nPočet osob: $people\nProstor: $event\nPoznámka: $message";

$mail = new PHPMailer(true);

try {
    // SMTP konfigurace
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'jsdeveloperbrno@gmail.com';        // Gmail účet
    $mail->Password   = 'bbgf vvfe idsx smrg';         // App Password, ne běžné heslo
    $mail->SMTPSecure = 'tls';                        // nebo PHPMailer::ENCRYPTION_STARTTLS
    $mail->Port       = 587;

    // Nastavení e-mailu
    $mail->setFrom('tvujemail@gmail.com', 'Amfora Brno');
    $mail->addAddress('jsdeveloperbrno@gmail.com');   // Komu se posílá
    $mail->addReplyTo($email, $name);

    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->CharSet = 'UTF-8';

    $mail->send();
    echo "Děkujeme! Požadavek byl odeslán.";
} catch (Exception $e) {
    echo "Chyba při odesílání: {$mail->ErrorInfo}";
}
?>
