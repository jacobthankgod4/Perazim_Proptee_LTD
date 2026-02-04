<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$page_title = 'Home Page ';

try {
    include 'Administration/config.inc.php';
    include "Administration/mysql.inc.php";
    include "includes/view/header.php";
    include "includes/view/processor/home.data.config.php";
    include "includes/view/home.php";
    include "includes/view/footer.php";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    error_log($e->getMessage());
}