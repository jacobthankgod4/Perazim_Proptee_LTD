<?php

$page_title = 'Login Page ';

include 'Administration/config.inc.php';

include "Administration/mysql.inc.php";

redirect_invalid_admin();

include "includes/view/header.php";

include "includes/admin/processor/dashboard.data.config.php";

include "includes/admin/dashboard.php";

include "includes/view/footer.php";