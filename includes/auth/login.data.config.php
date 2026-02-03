<?php

    $page_title = 'Login Page ';

    include '../../Administration/config.inc.php';

    include "../../Administration/mysql.inc.php";

	$log_error = array();

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
			$le = escape_data($_POST['mail'], $dbc);
		}else{
			$log_error['mail'] = 'please enter a valid email';
		}
		if (!empty($_POST['pass'])) {
			$lp = $_POST['pass'];
		}else{
			$log_error['pass'] = 'please enter a password';
		}

		if (empty($log_error)) {
			// PDO prepared statement for Postgres
			require_once __DIR__ . '/../db/pdo_pg.php';
			$pdo = getPdoPostgres();
			$stmt = $pdo->prepare('SELECT "Id", "Email", "Password", "User_Type", "Name", "Account", "age", "gender", "bank", "account_activation_hash" FROM public.users WHERE "Email" = :email');
			$stmt->execute([':email' => $le]);
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$r3 = $rows;
			if (!empty($r3) && count($r3) === 1) {
				$row = $r3[0];

				// Server-side CSRF validation
				require_once __DIR__ . '/../security/csrf_validate.php';
				if (!validate_csrf()) {
					$output = 'CSRF validation failed';
					echo $output;
					exit;
				}

				if (password_verify($lp, $row['Password'])) {

				if ($row['account_activation_hash']===NULL) {

					session_regenerate_id(true);								
					

					$_SESSION['Name'] = $row['Name'];					

					$_SESSION['Email'] = $row['Email'];

					$_SESSION['Account'] = $row['Account'];

					
						if ($row['User_Type'] === 'admin') {

							$_SESSION['admin_id'] = $row['Id'];

							$_SESSION['email'] = $row['Email'];

                            $output = "app-users";

                            echo $output;					


						}elseif ($row['User_Type'] === 'user') {

							$_SESSION['user_id'] = $row['Id'];
							$_SESSION['name'] = $row['Name'];							
							$_SESSION['account'] = $row['Account'];
							$_SESSION['age'] = $row['age'];
							$_SESSION['gender'] = $row['gender'];
							$_SESSION['bank'] = $row['bank'];

							if (isset($_SESSION['period'])) {
								$output = "invest-now";

                            	echo $output;
							} else {								                            
							$output = "my-investments";

                            echo $output;
							}
							


							
						}
				}else{
				    $output = 'Username or Password Incorrect';
				    
				    echo $output;
				}
						
				}else{					
                    $output = "Incorrect Password";

                    echo $output;
				}
			}else{					
                    $output = 'Username or Password Incorrect';

                    echo $output;
			}
		}
	}