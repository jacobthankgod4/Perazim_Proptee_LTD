<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer library
require '../../vendor/autoload.php';

$mail = new PHPMailer(true);

    $page_title = 'Login Page ';

    include '../../Administration/config.inc.php';

    include "../../Administration/mysql.inc.php";
    

    $fname = escape_data($_POST['fname'], $dbc);

    $account = escape_data($_POST['account'], $dbc);

    $email = escape_data($_POST['mail'], $dbc);

    $pass = escape_data($_POST['pass1'], $dbc);

    $bank = escape_data($_POST['bank'], $dbc);

    $age = escape_data($_POST['age'], $dbc);

    $gender = escape_data($_POST['gender'], $dbc);
    
    $token=bin2hex(random_bytes(16));
    
    $token_hash = hash("sha256", $token);

    $authLink = "https://perazimpropteeltd.com/activate-account.php?token=" . $token_hash;
    
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
            <h1>Welcome to PeraVest!</h1>
        </div>
        <div class="email-body">
            <h2>Dear '.htmlspecialchars($fname).',</h2>
            <p>Welcome to <strong>PeraVest</strong>, Nigeria\'s premier real estate investing platform!</p>
            <p>To secure your account, please authenticate your email address by clicking the link below:</p>
            <a href="'.$authLink.'">Authenticate Your Email</a>
            <p>Once verified, you\'ll gain access to our platform\'s features and start building wealth through real estate investing.</p>
            <p>Need help? Our team is here to support you.</p>
        </div>
        <div class="email-footer">
            <p>Best regards,</p>
            <p><strong>Enoch Owolabi</strong></p>
            <p>PeraVest Team</p>
            <img src="[Insert PeraVest logo URL]" alt="PeraVest Logo">
        </div>
    </div>
</body>
</html>
';

    if ($fname && $email && $pass  && $account) {        
        
            // Check whether email already exists using prepared statement
            require_once __DIR__ . '/../db/pdo_pg.php';
            $pdo = getPdoPostgres();
            
            $stmt = $pdo->prepare('SELECT "Email" FROM public.users WHERE "Email" = :email');
            $stmt->execute([':email' => $email]);
            $rows = $stmt->rowCount();

            if ($rows === 0) {
                // Server-side CSRF validation
                require_once __DIR__ . '/../security/csrf_validate.php';
                if (!validate_csrf()) {
                    $output = 'CSRF validation failed';
                    echo $output;
                    exit;
                }

                // Use prepared statement to avoid SQL injection
                $stmt = $pdo->prepare('INSERT INTO public.users ("User_Type", "Email", "Name", "age", "gender", "bank", "Account", "Password", "account_activation_hash") VALUES (:user_type, :email, :name, :age, :gender, :bank, :account, :password, :token_hash)');
                $user_type = 'user';
                $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
                $r1 = $stmt->execute([
                    ':user_type' => $user_type,
                    ':email' => $email,
                    ':name' => $fname,
                    ':age' => $age,
                    ':gender' => $gender,
                    ':bank' => $bank,
                    ':account' => $account,
                    ':password' => $hashed_password,
                    ':token_hash' => $token_hash
                ]);
                
                try {
    // Server settings
    $mail->isSMTP();                                // Use SMTP
    // Prefer environment variables for SMTP credentials and host; fall back to existing values for local dev only.
    $mail->Host = getenv('SMTP_HOST') ?: 'rbx109.truehost.cloud';
    $mail->SMTPAuth   = true;                       // Enable SMTP authentication
    $mail->Username   = getenv('SMTP_USER') ?: 'validation@perazimpropteeltd.com';
    $mail->Password   = getenv('SMTP_PASS') ?: '#n=N]ouVpbWq';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port       = getenv('SMTP_PORT') ? intval(getenv('SMTP_PORT')) : 587;

    // Sender and recipient settings
    $from = getenv('SMTP_FROM') ?: $mail->Username;
    $from_name = getenv('SMTP_FROM_NAME') ?: 'Peravest';
    $mail->setFrom($from, $from_name);
    $mail->addAddress($email, $fname); // Recipient's email and name
    $mail->addReplyTo($from, $from_name);    // Optional reply-to address

    // Email content
    $mail->isHTML(true);                            // Set email format to HTML
    $mail->Subject = 'Account Activation';   // Email subject
    $mail->Body = $emailBody;
    // $mail->Body = '<p>Click <a href="https://perazimpropteeltd.com/activate-account.php?token=' . $token_hash . '">here</a> to activate your account.</p>';
 // HTML message body
    $mail->AltBody = 'This is the plain text version of the email.'; // Plain-text body for non-HTML clients

    // Optional: Attachments
    // $mail->addAttachment('/path/to/file.pdf', 'File Name'); // Add attachments if needed

    // Send the email
    $mail->send();
               
} catch (Exception $e) {
    // echo "Failed to send email. Error: {$mail->ErrorInfo}";
}

                $output = "hi2";
     

                echo $output;
          
           }else{

            $output = "hello1";

            echo $output;
                
            }
        

    }else{
        $output = "hello0";

        echo $output;
    }
