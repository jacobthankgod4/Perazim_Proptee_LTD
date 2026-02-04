<?php
    $page_title = 'Login Page ';

    include '../../../Administration/config.inc.php';

    include "../../../Administration/mysql.inc.php";

    $pass = escape_data($_POST['pass'], $dbc);
    $pass1 = escape_data($_POST['pass1'], $dbc);

    $email=$_SESSION['Email'];


    if ($pass1 && $pass) {        
        
        // Fetch existing password hash using prepared statement
        $pdo = require __DIR__ . '/../../../includes/db/pdo_pg.php';
        
        $stmt = $pdo->prepare('SELECT "Password" FROM public.users WHERE "Email" = :email');
        $stmt->execute([':email' => $email]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row = count($rows) > 0 ? $rows[0] : null;

        if ($row && password_verify($pass, $row['Password'])) {
            $new_hash = password_hash($pass1, PASSWORD_BCRYPT);
            $stmt2 = $pdo->prepare('UPDATE public.users SET "Password" = :password WHERE "Email" = :email');
            $stmt2->execute([
                ':password' => $new_hash,
                ':email' => $email
            ]);

            $output = "hi2";
            echo $output;
        
          
           }else{

            $output = "hello1";

            echo $output;
                
            }
        

    }else{
        $output = "hello0";

        echo $output;
    }
