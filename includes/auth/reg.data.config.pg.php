<?php
// Converted registration processor (Postgres + PDO) — production-ready example
// Note: drop-in example. Wire into your routing where appropriate. Requires includes/db/pdo_pg.php

require_once __DIR__ . '/../db/pdo_pg.php';
$pdo = require __DIR__ . '/../db/pdo_pg.php';

// Simple input extraction (add stricter validation as needed)
$email = trim($_POST['email'] ?? '');
$name = trim($_POST['name'] ?? '');
$password = $_POST['password'] ?? '';
$user_type = $_POST['user_type'] ?? 'user';

if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'invalid_input']);
    exit;
}

// Hash password (bcrypt via default)
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Generate activation hash
$activation_hash = bin2hex(random_bytes(16));

try {
    $pdo->beginTransaction();

    // Insert user — rely on unique constraint for email
    $sql = 'INSERT INTO public.users ("User_Type", "Email", "Name", "age", "gender", "bank", "Account", "Password", "account_activation_hash") VALUES (:ut, :email, :name, :age, :gender, :bank, :account, :pwd, :hash) RETURNING "Id"';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ut' => $user_type,
        ':email' => $email,
        ':name' => $name,
        ':age' => null,
        ':gender' => null,
        ':bank' => null,
        ':account' => null,
        ':pwd' => $password_hash,
        ':hash' => $activation_hash,
    ]);

    $newId = $stmt->fetchColumn();

    $pdo->commit();

    // TODO: send activation email using your mailer; do not echo secrets
    echo json_encode(['success' => true, 'user_id' => (int)$newId]);
    exit;
} catch (PDOException $e) {
    $pdo->rollBack();
    // Duplicate email
    if ($e->getCode() === '23505') {
        http_response_code(409);
        echo json_encode(['error' => 'email_exists']);
        exit;
    }
    error_log('Registration error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'server_error']);
    exit;
}
