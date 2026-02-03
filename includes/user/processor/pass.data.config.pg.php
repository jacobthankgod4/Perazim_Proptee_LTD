<?php
// Password reset request & update handler (Postgres + PDO)
require_once __DIR__ . '/../../db/pdo_pg.php';
$pdo = require __DIR__ . '/../../db/pdo_pg.php';

header('Content-Type: application/json; charset=utf-8');

$action = $_POST['action'] ?? 'request'; // 'request' or 'reset'
$email = trim($_POST['email'] ?? '');

if ($action === 'request') {
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['error' => 'invalid_email']);
        exit;
    }

    try {
        $token = bin2hex(random_bytes(24));
        $token_hash = hash('sha256', $token);
        $expires = (new DateTime('+1 hour'))->format('Y-m-d H:i:s');

        $sql = 'UPDATE public.users SET "reset_token_hash" = :hash, "reset_token_expires_at" = :expires WHERE "Email" = :email RETURNING "Id"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':hash' => $token_hash, ':expires' => $expires, ':email' => $email]);
        $row = $stmt->fetchColumn();

        if (!$row) {
            // Do not reveal whether an email exists
            echo json_encode(['success' => true]);
            exit;
        }

        // In production: send reset email. For now return token (tester).
        $reset_url = getenv('APP_URL') . '/reset-password.php?token=' . $token;
        echo json_encode(['success' => true, 'reset_url' => $reset_url]);
        exit;

    } catch (PDOException $e) {
        error_log('Password request error: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'server_error']);
        exit;
    }

} elseif ($action === 'reset') {
    $token = $_POST['token'] ?? '';
    $new_password = $_POST['new_password'] ?? '';

    if (!$token || !$new_password) {
        http_response_code(400);
        echo json_encode(['error' => 'invalid_input']);
        exit;
    }

    $token_hash = hash('sha256', $token);

    try {
        $sql = 'SELECT "Id", "reset_token_expires_at" FROM public.users WHERE "reset_token_hash" = :hash LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':hash' => $token_hash]);
        $row = $stmt->fetch();

        if (!$row) {
            http_response_code(400);
            echo json_encode(['error' => 'invalid_token']);
            exit;
        }

        $expires = $row['reset_token_expires_at'];
        if ($expires && (new DateTime($expires)) < new DateTime()) {
            http_response_code(400);
            echo json_encode(['error' => 'token_expired']);
            exit;
        }

        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $update = 'UPDATE public.users SET "Password" = :pwd, "reset_token_hash" = NULL, "reset_token_expires_at" = NULL WHERE "Id" = :id';
        $ustmt = $pdo->prepare($update);
        $ustmt->execute([':pwd' => $password_hash, ':id' => $row['Id']]);

        echo json_encode(['success' => true]);
        exit;

    } catch (PDOException $e) {
        error_log('Password reset error: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'server_error']);
        exit;
    }

} else {
    http_response_code(400);
    echo json_encode(['error' => 'unknown_action']);
    exit;
}
