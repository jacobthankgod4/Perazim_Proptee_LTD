<?php
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen (for development)
ini_set('display_startup_errors', 1); // Display errors that occur during PHP's startup

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer library
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$email = escape_data($_POST['email'], $dbc);

$token=bin2hex(random_bytes(16));
    
$token_hash=hash("sha256", $token);

$expiry=date("Y-m-d H:i:s", time() + 60 * 90);

// Use prepared statement to avoid SQL injection
$q1 = "UPDATE `users` SET `reset_token_hash` = ?, `reset_token_expires_at` = ? WHERE Email = ?";
$stmt = mysqli_prepare($dbc, $q1);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'sss', $token_hash, $expiry, $email);
    mysqli_stmt_execute($stmt);
    $update_ok = (mysqli_stmt_affected_rows($stmt) > 0);
    mysqli_stmt_close($stmt);
} else {
    $update_ok = false;
}

$emailBody = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #0e2e50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-body h2 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #0e2e50;
        }
        .email-body p {
            line-height: 1.6;
            margin: 10px 0;
        }
        .email-body a {
            color: #ffffff;
            background-color: #0e2e50;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 15px;
        }
        .email-footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777777;
            background-color: #f9f9f9;
        }
        .email-footer img {
            max-width: 100px;
            margin-top: 10px;
        }
        @media (max-width: 600px) {
            .email-body a {
                display: block;
                width: fit-content;
                margin: 10px auto;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Reset Your Peravest Password</h1>
        </div>
        <div class="email-body">
            <h2>Dear Customer</h2>
            <p>You requested a password reset for your Peravest account. Click the link below to create a new password.</p>
            
            <a href="https://perazimpropteeltd.com/reset-password.php?token=' . $token_hash . '">Reset Your Password</a>
            <p>If you did not request this reset, please ignore this email.</p>
            
        </div>
        <div class="email-footer">
            <p>Best regards,</p>
            
            <p>PeraVest Team</p>
            
        </div>
    </div>
</body>
</html>
';

 if (!empty($update_ok) && $update_ok) {
        // echo "Update was successful!";
        try {
// Server settings
    $mail->isSMTP();                                // Use SMTP
    // $mail->SMTPDebug = 2; // Debug level: 1 = Client, 2 = Client & Server
// $mail->Debugoutput = 'html'; // Debug output format
    $mail->Host = 'rbx109.truehost.cloud';
        // SMTP server (e.g., smtp.gmail.com for Gmail)
    $mail->SMTPAuth   = true;                       // Enable SMTP authentication
        $mail->Username   = getenv('MAIL_USERNAME') ?: 'validation@perazimpropteeltd.com';
        $mail->Password   = getenv('MAIL_PASSWORD') ?: null;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; use ENCRYPTION_SMTPS for SSL
    $mail->Port       = 587;                       // TCP port for TLS (use 465 for SSL)

    // Sender and recipient settings
    $mail->setFrom('validation@perazimpropteeltd.com', 'Peravest'); // Sender's email and name
    $mail->addAddress($email, $email); // Recipient's email and name
    $mail->addReplyTo('validation@perazimpropteeltd.com', 'Peravest');    // Optional reply-to address

    // Email content
    $mail->isHTML(true);                            // Set email format to HTML
    $mail->Subject = 'Reset Your Peravest Password';   // Email subject
    $mail->Body = $emailBody;
    // $mail->Body = '<p>Click <a href="https://perazimpropteeltd.com/reset-password.php?token=' . $token_hash . '">here</a> to reset your password.</p>';
 // HTML message body
    $mail->AltBody = 'This is the plain text version of the email.'; // Plain-text body for non-HTML clients

    // Optional: Attachments
    // $mail->addAttachment('/path/to/file.pdf', 'File Name'); // Add attachments if needed

    // Send the email
    $mail->send();
               
} catch (Exception $e) {
    // echo "Failed to send email. Error: {$mail->ErrorInfo}";
}
?>
<script>
    Swal.fire({
                                    icon: 'success',
                                    title: 'Hurray',
                                    text: 'A link to reset your password has been sent to your email. NB: please check your Spam folder incase you did not find it in your regular mailbox',  
                                    showClass: {
                                      popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                      popup: 'animate__animated animate__fadeOutUp'
                                    }
                                  })
                                  
</script>

<?php
    } else {
        // Update did not affect any rows or failed
    }



}

?>

<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Forgot Password</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Forgot Password</li>
</ul>
</div>
</div>

<div class="login-area py-120">
<div class="container">
<div class="col-md-5 mx-auto">
<div class="login-form">
<div class="login-header">
<img src="assets/img/logo/logo_a.png" alt>
<p>Reset your Peravest account password</p>
</div>
<form action="" method="post">
<div class="form-group">
<label>Email Address</label>
<input type="email" name="email" class="form-control" placeholder="Your Email">
<i class="far fa-envelope"></i>
</div>
<div class="d-flex align-items-center">
<button type="submit" name="reset" class="theme-btn"><i class="far fa-key"></i> Send Reset
Link</button>
</div>
</form>
</div>
</div>
</div>
</div>

</main>