<?php
    $page_title = 'Login Page ';

    include '../../../Administration/config.inc.php';
    include "../../../Administration/mysql.inc.php";

    $subscribers = escape_data($_POST['subscribers'], $dbc);
    
    $pdo = require __DIR__ . '/../../../includes/db/pdo_pg.php';
    
    // Check if subscriber already exists
    $stmt = $pdo->prepare('SELECT "Id" FROM public.subscribers WHERE "Subscribers" = :email');
    $stmt->execute([':email' => $subscribers]);
    $existing = $stmt->fetch();
    
    if (!$existing) {
        // Insert new subscriber
        $stmt = $pdo->prepare('INSERT INTO public.subscribers ("Subscribers") VALUES (:email)');
        $stmt->execute([':email' => $subscribers]);
        
        $output = "successful";
        echo $output;
    } else {
        $output = "subscription-error";
        echo $output;
    }
