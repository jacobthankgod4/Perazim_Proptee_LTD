<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function validate_csrf()
{
    $token = null;
    // Prefer header
    if (!empty($_SERVER['HTTP_X_CSRF_TOKEN'])) {
        $token = $_SERVER['HTTP_X_CSRF_TOKEN'];
    } elseif (!empty($_POST['csrf_token'])) {
        $token = $_POST['csrf_token'];
    }

    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }

    return hash_equals($_SESSION['csrf_token'], $token);
}

function require_csrf()
{
    if (!validate_csrf()) {
        http_response_code(403);
        echo 'CSRF validation failed';
        exit;
    }
}

?>
