<?php
require_once('main/config.php');
if (!empty($_SESSION['user_type'])) {
    $session_user_id = $_SESSION['user_id'];
    $session_user_type = $_SESSION['user_type'];
} else {
    $session_user_id = 0;
}
if ($session_user_type == 1) {
    include('./navbar/navbar-admin.php');
} else if ($session_user_type == 2) {
    include('./navbar/navbar-school.php');
} else if ($session_user_type == 3) {
    include('./navbar/navbar-teacher.php');
}