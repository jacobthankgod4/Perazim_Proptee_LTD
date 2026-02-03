<?php

$token = $_GET['token'] ?? '';

// Verify token with prepared statement
require_once __DIR__ . '/../db/pdo_pg.php';
$pdo = getPdoPostgres();

$stmt = $pdo->prepare('SELECT "Id" FROM public.users WHERE "account_activation_hash" = :token');
$stmt->execute([':token' => $token]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) === 1) {
    echo "yes";
    $row_id = (int)$rows[0]['Id'];

    // Nullify activation hash using prepared statement
    $stmt2 = $pdo->prepare('UPDATE public.users SET "account_activation_hash" = NULL WHERE "Id" = :id');
    $stmt2->execute([':id' => $row_id]);
} else {
    echo "no";
}



            


?>

<main class="main">
    <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
    <div class="container">
    <h2 class="breadcrumb-title">Account Activation Successful</h2>
    <ul class="breadcrumb-menu">
    <li><a href="index.html">Home</a></li>
    <li class="active">Account Activation</li>
    </ul>
    </div>
    </div>
    
    <script>
        						  setTimeout(function() {
							window.location.href = "login"; // Redirect URL
						}, 3000);
    </script>

    
    </main>
