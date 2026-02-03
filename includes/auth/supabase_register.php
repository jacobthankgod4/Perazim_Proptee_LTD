<?php
/**
 * Registration processor using Supabase Auth
 * 
 * Flow:
 * 1. User submits email + password via form
 * 2. Create user in Supabase Auth (generates secure password hash + JWT)
 * 3. Insert profile into users_profile table with auth_id
 * 4. Send email confirmation link from Supabase
 * 
 * Dependencies:
 * - SUPABASE_URL: Project URL (e.g., https://xxx.supabase.co)
 * - SUPABASE_ANON_KEY: Anon key for client auth
 * - DATABASE_URL: Postgres connection for profile storage
 */

session_start();

// CSRF validation
require_once __DIR__ . '/../security/csrf_validate.php';
require_once __DIR__ . '/../db/pdo_pg.php';
require_once __DIR__ . '/../helpers/escape.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['error' => 'Method not allowed']));
}

$response = ['success' => false, 'error' => null, 'message' => null];

try {
    // Validate inputs
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $name = trim($_POST['name'] ?? '');
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format.');
    }
    
    if (strlen($password) < 8) {
        throw new Exception('Password must be at least 8 characters.');
    }
    
    if (empty($name)) {
        throw new Exception('Name is required.');
    }
    
    // Get Supabase credentials from env
    $sb_url = getenv('SUPABASE_URL');
    $sb_key = getenv('SUPABASE_ANON_KEY');
    
    if (!$sb_url || !$sb_key) {
        throw new Exception('Supabase not configured. Check SUPABASE_URL and SUPABASE_ANON_KEY.');
    }
    
    // Step 1: Create user in Supabase Auth via REST API
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $sb_url . '/auth/v1/signup',
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'apikey: ' . $sb_key,
            'Authorization: Bearer ' . $sb_key
        ],
        CURLOPT_POSTFIELDS => json_encode([
            'email' => $email,
            'password' => $password
        ]),
        CURLOPT_TIMEOUT => 10
    ]);
    
    $auth_response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code !== 200) {
        $err = json_decode($auth_response, true);
        throw new Exception('Supabase auth failed: ' . ($err['message'] ?? $auth_response));
    }
    
    $auth_data = json_decode($auth_response, true);
    if (!isset($auth_data['user']['id'])) {
        throw new Exception('Invalid Supabase response: missing user id');
    }
    
    $auth_id = $auth_data['user']['id'];
    
    // Step 2: Insert profile into users_profile table
    $pdo = getPdoPostgres();
    
    $stmt = $pdo->prepare('
        INSERT INTO public.users_profile ("auth_id", "Name", "User_Type", "status")
        VALUES (:auth_id, :name, :user_type, :status)
    ');
    
    $stmt->execute([
        ':auth_id' => $auth_id,
        ':name' => $name,
        ':user_type' => 'user',
        ':status' => 'active'
    ]);
    
    // Step 3: Log user in (Supabase returns JWT)
    $_SESSION['auth_user'] = [
        'auth_id' => $auth_id,
        'email' => $email,
        'name' => $name,
        'token' => $auth_data['session']['access_token'] ?? null
    ];
    
    $response['success'] = true;
    $response['message'] = 'Registration successful. Check your email for confirmation link.';
    
    http_response_code(200);

} catch (Exception $e) {
    $response['error'] = $e->getMessage();
    http_response_code(400);
}

header('Content-Type: application/json');
echo json_encode($response);
