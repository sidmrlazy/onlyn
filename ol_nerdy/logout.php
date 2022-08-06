<?php
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION["loggedin"] = false;
$_SESSION = array();
session_destroy();
header("Location:index.php", true, 301); // Or wherever you want to redirect
exit;