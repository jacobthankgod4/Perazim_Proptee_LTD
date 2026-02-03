<?php
include 'Administration/config.inc.php';

include "Administration/mysql.inc.php";

$_SESSION = array();

session_destroy();

setcookie(session_name(), '', time()-300);

header("location: home");


