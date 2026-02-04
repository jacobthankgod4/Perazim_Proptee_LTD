<?php
    $page_title = 'Login Page ';

    include '../../../Administration/config.inc.php';
    include "../../../Administration/mysql.inc.php";

    $ide=$_SESSION['user_id'];
    $fname = escape_data($_POST['fname'], $dbc);
    $account = escape_data($_POST['account'], $dbc);
    $email = escape_data($_POST['mail'], $dbc);
    $bank = escape_data($_POST['bank'], $dbc);
    $age = escape_data($_POST['age'], $dbc);
    $gender = escape_data($_POST['gender'], $dbc);

    if ($fname && $email && $account) {        
        $pdo = require __DIR__ . '/../../../includes/db/pdo_pg.php';
        
        $stmt = $pdo->prepare('UPDATE public.users SET "Name" = :name, "Email" = :email, "Account" = :account, "age" = :age, "gender" = :gender, "bank" = :bank WHERE "Id" = :id');
        $stmt->execute([
            ':name' => $fname,
            ':email' => $email,
            ':account' => $account,
            ':age' => $age,
            ':gender' => $gender,
            ':bank' => $bank,
            ':id' => (int)$ide
        ]);

        $output = "hi2";
        echo $output;

        $_SESSION['Account'] = $account;
        $_SESSION['bank'] = $bank;
    } else {
        $output = "hello0";
        echo $output;
    }
