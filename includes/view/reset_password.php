<?php

error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen (for development)
ini_set('display_startup_errors', 1); // Display errors that occur during PHP's startup

    $admin_error = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $token=$_POST['token'];

if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#\\\\\^\)\(\[\]\/])[A-Za-z\d@$!%*?&#\\\\\^\)\(\[\]\/]{8,}$/', $_POST['pass'])) {
            
            if ($_POST['pass'] === $_POST['pass1']) {

                $pa = $_POST['pass'];

            }else {

                $admin_error['pass1'] = "you password did not match the confirmed password";

            }
        }else {

            $admin_error['pass'] = "Password must contain an uppercase and a lowercase letter, a number, a special character and must be more then 8 characters";

        }


if (empty($admin_error['pass'])  && empty($admin_error['pass1'])) {


// Verify token exists and not expired using prepared statement
require_once __DIR__ . '/../db/pdo_pg.php';
$pdo = getPdoPostgres();

$stmt = $pdo->prepare('SELECT "reset_token_expires_at" FROM public.users WHERE "reset_token_hash" = :token');
$stmt->execute([':token' => $token]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$token_valid = (count($rows) === 1);

if ($token_valid) {
  // Update password securely with prepared statement
  $new_hash = password_hash($pa, PASSWORD_BCRYPT);
  $stmt2 = $pdo->prepare('UPDATE public.users SET "Password" = :password WHERE "reset_token_hash" = :token');
  $stmt2->execute([
    ':password' => $new_hash,
    ':token' => $token
  ]);
  $updated = ($stmt2->rowCount() > 0);

  if ($updated) {
    echo "yes";
  }
                
                ?>
<script>
    Swal.fire({
                                    icon: 'success',
                                    title: 'Hurray',
                                    text: 'you have successfully reset your password',  
                                    showClass: {
                                      popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                      popup: 'animate__animated animate__fadeOutUp'
                                    }
                                  })
                                  						  setTimeout(function() {
				 			window.location.href = "login"; // Redirect URL
					}, 4000);
                                  
</script>

<?php
                
}else{
			    echo "no";
}
}

}else{
    $token=$_GET['token'];
}
            


?>

<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Reset Password</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Reset Password</li>
</ul>
</div>
</div>

<div class="login-area py-120">
<div class="container">
<div class="col-md-5 mx-auto">
<div class="login-form">
<div class="login-header">
<img src="assets/img/logo/logo_a.png" alt>
<p>Input Your New Password</p>
</div>
<form action="reset-password.php" method='post'>
    <input type="hidden" name='token' value='<?=$token ?>' >
<div class="form-group">
<label>New Password</label>
<input type="password" class="form-control" id="pass1"  name='pass' placeholder="xxxxxxxxxxxxxxx">
<i class="far fa-envelope"></i>
<span class="far fa-eye-slash " id='flt' style="
      position: absolute; 
      top: 70%; 
      right: 10px; 
      transform: translateY(-50%);
      cursor: pointer;" onclick="togglePasswordVisibility()"></span>
</div>
<?php form_error_report('pass', $admin_error); ?>
<div class="form-group">
<label>Confirm New Password</label>
<input type="password" class="form-control" id="pass2"  name='pass1'  placeholder="xxxxxxxxxxxxxxx">
<i class="far fa-envelope"></i>
<span class="far fa-eye-slash " id='flt1' style="
      position: absolute; 
      top: 70%; 
      right: 10px; 
      transform: translateY(-50%);
      cursor: pointer;" onclick="togglePasswordVisibility1()"></span>
</div>
<?php form_error_report('pass1', $admin_error); ?>
<div class="d-flex align-items-center">
<button type="submit" class="theme-btn"><i class="far fa-key"></i> Reset Password</button>
</div>
</form>
</div>
</div>
</div>
</div>

</main>

<script>
  function togglePasswordVisibility() {
    const passwordField1 = document.getElementById('pass1');
    
    const flt = document.getElementById('flt');

    if (passwordField1.type === 'password') {
      passwordField1.type = 'text';
        flt.classList.remove('fa-eye-slash');
        flt.classList.add('fa-eye');
    } else {
      passwordField1.type = 'password';
      flt.classList.remove('fa-eye');
      flt.classList.add('fa-eye-slash');
    }
  }
  
    function togglePasswordVisibility1() {
    const passwordField2 = document.getElementById('pass2');
    
    const flt1 = document.getElementById('flt1');

    if (passwordField2.type === 'password') {
      passwordField2.type = 'text';
        flt1.classList.remove('fa-eye-slash');
        flt1.classList.add('fa-eye');
    } else {
      passwordField2.type = 'password';
      flt1.classList.remove('fa-eye');
      flt1.classList.add('fa-eye-slash');
    }
  }
</script>