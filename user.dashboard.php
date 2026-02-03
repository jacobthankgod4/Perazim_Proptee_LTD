<?php

$page_title = 'Login Page ';

include 'Administration/config.inc.php';

include "Administration/mysql.inc.php";

redirect_invalid_user();

include "includes/view/header.php";

include "includes/user/processor/dashboard.data.config.php";

include "includes/user/dashboard.php";

include "includes/view/footer.php";