<?php

$page_title = 'Login Page ';

include 'Administration/config.inc.php';

include "Administration/mysql.inc.php";

redirect_invalid_user();

include "includes/view/header.php";

include "includes/user/withdrawal.php";

include "includes/view/footer.php";
