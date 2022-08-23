<?php
require_once('main/config.php');
if (!empty($_SESSION['user_type'])) {
    $session_user_id = $_SESSION['user_id'];
    $session_user_type = $_SESSION['user_type'];
} else {
    $session_user_id = 0;
}
if ($session_user_type == 1) {

    include('./main/navbar-admin.php');
} else if ($session_user_type == 2) {
    include('./main/navbar-school.php');
} else if ($session_user_type == 3) {
    include('./main/navbar-teacher.php');
} else if ($session_user_type == 4) {
    include('./main/navbar-parent.php');
}