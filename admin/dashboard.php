<?php
include('includes/header.php');
require('includes/connection.php');
if (isset($_COOKIE['user_id'])) {
    $user_contact = $_COOKIE['user_id'];

    $query = "SELECT * FROM `bora_users` WHERE `user_contact` = '$user_contact'";
    $res = mysqli_query($connection, $query);

    if (!$res) {
        echo "Error: " . mysqli_error($connection);
    } else {
        $user_type = "";
        $user_name = "";

        while ($row = mysqli_fetch_assoc($res)) {
            $user_type = $row['user_type'];
            $user_name = $row['user_name'];
        }

        if ($user_type == 1) {
            include('components/navbar/admin-navbar.php');
            include('components/dashboard/admin-dashboard/admin-data-count.php');
            include('includes/footer.php');
        } else if ($user_type == 2) {
            include('components/navbar/user-navbar.php');
            include('components/dashboard/user-dashboard/user-data-count.php');
            include('includes/footer.php');
        }
    }
}