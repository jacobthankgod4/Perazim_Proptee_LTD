<?php
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen (for development)
ini_set('display_startup_errors', 1); // Display errors that occur during PHP's startup

$page_title = 'Login Page ';

include 'Administration/config.inc.php';

include "Administration/mysql.inc.php";

if (!isset($_SESSION['identity'])) {
    $_SESSION['identity']=$_POST['identity'];

    $_SESSION['identity2']=$_POST['identity2'];

    $_SESSION['period']=$_POST['period'];

    $_SESSION['title_']=$_POST['title_'];

    $_SESSION['img_']=$_POST['img_'];

    $_SESSION['address_']=$_POST['address_'];

    $_SESSION['cost_']=$_POST['cost_'];

    $_SESSION['interest_']=$_POST['interest_'];
        
}elseif(isset($_POST['identity'])) {
$_SESSION['identity']=$_POST['identity'];

    $_SESSION['identity2']=$_POST['identity2'];

    $_SESSION['period']=$_POST['period'];

    $_SESSION['title_']=$_POST['title_'];

    $_SESSION['img_']=$_POST['img_'];

    $_SESSION['address_']=$_POST['address_'];

    $_SESSION['cost_']=$_POST['cost_'];

    $_SESSION['interest_']=$_POST['interest_'];
        
}


if (isset($_SESSION['user_id'])) {    
    
    include "includes/view/header.php";
    
    include "includes/view/invest_now.php";
    
    if($output=="success"){

    include "includes/view/checkout.php";
    }

    include "includes/view/footer.php";

} else {

    header("Location: login");
    exit;
}

