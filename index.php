<?php

error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen (for development)
ini_set('display_startup_errors', 1); // Display errors that occur during PHP's startup

$page_title = 'Home Page ';

include 'Administration/config.inc.php';

include "Administration/mysql.inc.php";

include "includes/view/header.php";

include "includes/view/processor/home.data.config.php";

include "includes/view/home.php";

include "includes/view/footer.php";