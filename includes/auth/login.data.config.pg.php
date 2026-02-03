<?php
// Login processor (Postgres + PDO) — production-ready
require_once __DIR__ . '/../db/pdo_pg.php';
$pdo = require __DIR__ . '/../db/pdo_pg.php';

header('Content-Type: application/json; charset=utf-8');

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'invalid_input']);
    exit;
}

try {
    $sql = 'SELECT "Id", "Password", "status" FROM public.users WHERE "Email" = :email LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        http_response_code(401);
        echo json_encode(['error' => 'invalid_credentials']);
        exit;
    }

    if (!password_verify($password, $user['Password'])) {
        http_response_code(401);
        echo json_encode(['error' => 'invalid_credentials']);
        exit;
    }

    if (isset($user['status']) && $user['status'] !== 'active') {
        http_response_code(403);
        echo json_encode(['error' => 'account_inactive']);
        exit;
    }

    // Auth success — start session securely
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    session_regenerate_id(true);
    $_SESSION['user_id'] = (int)$user['Id'];

    echo json_encode(['success' => true, 'user_id' => (int)$user['Id']]);
    exit;

} catch (PDOException $e) {
    error_log('Login error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'server_error']);
    exit;
}
