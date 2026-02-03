<?php
/**
 * Logout processor for Supabase Auth
 * 
 * Destroys local session; optionally calls Supabase Auth to revoke token
 */

session_start();

try {
    $sb_url = getenv('SUPABASE_URL');
    $sb_key = getenv('SUPABASE_ANON_KEY');
    $token = $_SESSION['auth_user']['token'] ?? null;
    
    // Optionally revoke token at Supabase (sign_out)
    if ($sb_url && $sb_key && $token) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $sb_url . '/auth/v1/logout',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'apikey: ' . $sb_key,
                'Authorization: Bearer ' . $token
            ],
            CURLOPT_TIMEOUT => 5
        ]);
        
        @curl_exec($ch);
        curl_close($ch);
    }
    
} catch (Exception $e) {
    // Silently fail; still destroy local session
}

// Destroy session
$_SESSION = [];
session_destroy();

// Redirect to login
header('Location: login.php');
exit;
