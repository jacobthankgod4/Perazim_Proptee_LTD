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
            <h2>Dear <?=$fname ?>,</h2>
            <p>Welcome to <strong>PeraVest</strong>, Nigeria's premier real estate investing platform!</p>
            <p>To secure your account, please authenticate your email address by clicking the link below:</p>
            <a href="https://perazimpropteeltd.com/activate-account.php?token=' . $token_hash . '">Authenticate Your Email</a>
            <p>Once verified, you'll gain access to our platform's features and start building wealth through real estate investing.</p>
            <p>Need help? Our team is here to support you.</p>
        </div>
        <div class="email-footer">
            <p>Best regards,</p>
            <p><strong>Enoch Owolabi</strong></p>
            <p>PeraVest Team</p>
            <img src="assets/img/logo/logo_a.png" alt="PeraVest Logo">
        </div>
    </div>
</body>
</html>
