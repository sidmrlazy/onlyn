<?php
if (!empty($_SESSION['user_type'])) {
    $session_user_id = $_SESSION['user_id'];
    $session_user_type = $_SESSION['user_type'];
} else {
    $session_user_id = 0;
}

if ($session_user_type == 1) {
    include('dashboard-admin.php');
} else if ($session_user_type == 2) {
    include('./dashboard/dashboard-school.php');
} else if ($session_user_type == 3) {
    include('./dashboard/dashboard-teacher.php');
} else if ($session_user_type == 4) {
    include('./dashboard/dashboard-parent.php');
}