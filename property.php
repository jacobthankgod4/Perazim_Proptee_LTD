<?php

$page_title = 'Property Page ';

include 'Administration/config.inc.php';

include "Administration/mysql.inc.php";

redirect_invalid_admin();

include "includes/view/header.php";

include "includes/admin/processor/property.select.php";

include "includes/admin/property.php";

include "includes/view/footer.php";