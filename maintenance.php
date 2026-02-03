<?php
include 'Administration/config.inc.php';

if ($_SESSION['email']=="jacobthankgod4@gmail.com") : 
    
    $page_title = 'Maintenance Page ';    

    include "Administration/mysql.inc.php";

    redirect_invalid_admin();

    include "includes/view/header.php";

    include "includes/admin/processor/maintenance.data.config.php";

    include "includes/admin/maintenance.php";

    include "includes/view/footer.php";

else :    

    $page_title = '404 Page ';    

    redirect_invalid_admin();

    include "includes/view/header.php";

    include "404.php";

    include "includes/view/footer.php";
endif;



