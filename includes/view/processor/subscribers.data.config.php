<?php
    $page_title = 'Login Page ';

    include '../../../Administration/config.inc.php';

    include "../../../Administration/mysql.inc.php";

    $subscribers = escape_data($_POST['subscribers'], $dbc);
    

        
        
            // Use prepared statements to prevent SQL injection
            $q = "SELECT Id FROM subscribers WHERE Subscribers = ?";
            $stmt = mysqli_prepare($dbc, $q);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 's', $subscribers);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                $rows = $res ? mysqli_num_rows($res) : 0;
                mysqli_stmt_close($stmt);
            } else {
                $rows = 0;
            }

            if ($rows == 0) {
                $q1 = "INSERT INTO `subscribers` (`Subscribers`) VALUES (?)";
                $stmt1 = mysqli_prepare($dbc, $q1);
                if ($stmt1) {
                    mysqli_stmt_bind_param($stmt1, 's', $subscribers);
                    mysqli_stmt_execute($stmt1);
                    mysqli_stmt_close($stmt1);
                }

                
                
                
                $output = "successful";

                echo $output;
          
           }else{

            $output = "subscription-error";

            echo $output;
                
            }
        

    
