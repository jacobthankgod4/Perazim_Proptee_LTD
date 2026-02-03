<?php
error_reporting(E_ALL);
ini_set('display_errors', getenv('APP_DEBUG') ? 1 : 0);
ini_set('display_startup_errors', getenv('APP_DEBUG') ? 1 : 0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer library
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                // Use SMTP
    $mail->SMTPDebug = 2; // Debug level: 1 = Client, 2 = Client & Server
$mail->Debugoutput = 'html'; // Debug output format
    $mail->Host = 'rbx109.truehost.cloud';
        // SMTP server (e.g., smtp.gmail.com for Gmail)
    $mail->SMTPAuth   = true;                       // Enable SMTP authentication
    $mail->Username   = getenv('MAIL_USERNAME') ?: 'validation@perazimpropteeltd.com';
    $mail->Password   = getenv('MAIL_PASSWORD') ?: null;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; use ENCRYPTION_SMTPS for SSL
    $mail->Port       = 587;                       // TCP port for TLS (use 465 for SSL)

    // Sender and recipient settings
    $mail->setFrom('validation@perazimpropteeltd.com', 'Peravest'); // Sender's email and name
    $mail->addAddress('laresh1090@gmail.com', 'Larry'); // Recipient's email and name
    $mail->addReplyTo('validation@perazimpropteeltd.com', 'Peravest');    // Optional reply-to address

    // Email content
    $mail->isHTML(true);                            // Set email format to HTML
    $mail->Subject = 'Test Email from PHPMailer';   // Email subject
    $mail->Body    = '<h1>Hello!</h1><p>This is a test email sent using PHPMailer.</p>'; // HTML message body
    $mail->AltBody = 'This is the plain text version of the email.'; // Plain-text body for non-HTML clients

    // Optional: Attachments
    // $mail->addAttachment('/path/to/file.pdf', 'File Name'); // Add attachments if needed

    // Send the email
    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Failed to send email. Error: {$mail->ErrorInfo}";
}
