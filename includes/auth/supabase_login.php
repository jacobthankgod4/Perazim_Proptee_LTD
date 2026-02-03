<?php
/**
 * Login processor using Supabase Auth
 * 
 * Flow:
 * 1. User submits email + password
 * 2. Authenticate with Supabase Auth (validates email + password, issues JWT)
 * 3. Load user profile from users_profile table
 * 4. Create secure session (store JWT and auth_id)
 * 
 * Dependencies:
 * - SUPABASE_URL
 * - SUPABASE_ANON_KEY
 * - DATABASE_URL
 */

session_start();

// CSRF validation
require_once __DIR__ . '/../security/csrf_validate.php';
require_once __DIR__ . '/../db/pdo_pg.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['error' => 'Method not allowed']));
}

$response = ['success' => false, 'error' => null, 'redirect' => null];

try {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format.');
    }
    
    if (empty($password)) {
        throw new Exception('Password is required.');
    }
    
    $sb_url = getenv('SUPABASE_URL');
    $sb_key = getenv('SUPABASE_ANON_KEY');
    
    if (!$sb_url || !$sb_key) {
        throw new Exception('Supabase not configured.');
    }
    
    // Step 1: Authenticate with Supabase Auth
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $sb_url . '/auth/v1/token?grant_type=password',
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'apikey: ' . $sb_key
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
        // Try to decode for error message
        $err = @json_decode($auth_response, true);
        throw new Exception('Login failed: ' . ($err['error_description'] ?? 'Invalid credentials'));
    }
    
    $auth_data = json_decode($auth_response, true);
    if (!isset($auth_data['user']['id'])) {
        throw new Exception('Invalid Supabase response');
    }
    
    $auth_id = $auth_data['user']['id'];
    $access_token = $auth_data['access_token'] ?? null;
    
    // Step 2: Load user profile from Postgres
    $pdo = getPdoPostgres();
    $stmt = $pdo->prepare('
        SELECT "auth_id", "Name", "User_Type", "status"
        FROM public.users_profile
        WHERE "auth_id" = :auth_id AND "status" = :status
    ');
    
    $stmt->execute([
        ':auth_id' => $auth_id,
        ':status' => 'active'
    ]);
    
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$profile) {
        // Profile doesn't exist yet; create one (for migrated users resetting password)
        $stmt = $pdo->prepare('
            INSERT INTO public.users_profile ("auth_id", "status")
            VALUES (:auth_id, :status)
            ON CONFLICT ("auth_id") DO NOTHING
        ');
        $stmt->execute([':auth_id' => $auth_id, ':status' => 'active']);
        
        $profile = ['auth_id' => $auth_id, 'Name' => $email, 'User_Type' => 'user', 'status' => 'active'];
    }
    
    // Step 3: Create secure session
    $_SESSION['auth_user'] = [
        'auth_id' => $auth_id,
        'email' => $email,
        'name' => $profile['Name'],
        'user_type' => $profile['User_Type'],
        'token' => $access_token,
        'logged_in_at' => date('Y-m-d H:i:s')
    ];
    
    // Set session cookie as secure + httpOnly + sameSite
    session_set_cookie_params([
        'secure' => (getenv('LIVE') === 'true'),
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    $response['success'] = true;
    $response['redirect'] = 'user.dashboard.php';
    
    http_response_code(200);

} catch (Exception $e) {
    $response['error'] = $e->getMessage();
    http_response_code(401);
}

header('Content-Type: application/json');
echo json_encode($response);
