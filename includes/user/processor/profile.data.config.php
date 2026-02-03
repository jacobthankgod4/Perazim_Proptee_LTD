<?php
    $page_title = 'Login Page ';

    include '../../../Administration/config.inc.php';

    include "../../../Administration/mysql.inc.php";

    $ide=$_SESSION['user_id'];

    $fname = escape_data($_POST['fname'], $dbc);

    $account = escape_data($_POST['account'], $dbc);

    $email = escape_data($_POST['mail'], $dbc);

    // $pass = escape_data($_POST['pass1'], $dbc);

    $bank = escape_data($_POST['bank'], $dbc);

    $age = escape_data($_POST['age'], $dbc);

    $gender = escape_data($_POST['gender'], $dbc);

    if ($fname && $email  && $account) {        
        
            

                $q1 = "UPDATE `users` SET `Name` = ?, `Email` = ?, `Account` = ?, `age` = ?, `gender` = ?, `bank` = ? WHERE Id = ?";
                $stmt = mysqli_prepare($dbc, $q1);
                if ($stmt) {
                    $id_int = (int)$ide;
                    mysqli_stmt_bind_param($stmt, 'ssssssi', $fname, $email, $account, $age, $gender, $bank, $id_int);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }

                $output = "hi2";
                echo $output;

                $_SESSION['Account'] = $account;
                $_SESSION['bank'] = $bank;

        

    }else{
        $output = "hello0";

        echo $output;
    }
