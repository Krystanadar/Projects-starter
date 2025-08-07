<?php
// filepath: .\Amfora Brno\sendemail.php

// Set your email address here
$to = "jsdeveloperbrno@gmail.com";

// Get form data and sanitize
$name    = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email   = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$people  = isset($_POST['people']) ? htmlspecialchars($_POST['people']) : '';
$event   = isset($_POST['eventType']) ? htmlspecialchars($_POST['eventType']) : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

$subject = "Nový požádavek z webu Amfora Brno";
$body = "Jméno: $name\nEmail: $email\nPočet osob: $people\nProstor: $event\nPoznámka: $message";

// Additional headers
$headers = "From: $email\r\nReply-To: $email\r\n";

// Send the email
if (mail($to, $subject, $body, $headers)) {
    echo "Děkujeme! Požádavek byl odeslán.";
} else {
    echo "Chyba při odesílání. Zkuste to prosím znovu.";
}
?>