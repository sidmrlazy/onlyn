<?php
session_start();
$sessionId = session_id();
setcookie('session_id', $sessionId, time() + (86400 * 30), '/');
$title = "Achievements | Dr. Neeraj Bora";
require('includes/header.php');
require('includes/db.php');
if (isset($_POST['store'])) {
    $session_user_id = mysqli_real_escape_string($connection, $_POST['session_user_id']);
    $session_selected_lang = mysqli_real_escape_string($connection, $_POST['session_selected_lang']);

    $insert_session_data = "INSERT INTO `session`(
        `session_user_id`,
        `session_selected_lang`
    )
    VALUES(
        '$session_user_id',
        '$session_selected_lang'
    )";
    $insert_session_data_result = mysqli_query($connection, $insert_session_data);
}

$fetch_session_var = "SELECT * FROM `session` WHERE `session_user_id` = '$sessionId'";
$fetch_session_var_r = mysqli_query($connection, $fetch_session_var);
$session_user_id = "";
$session_selected_lang = "";
while ($row = mysqli_fetch_assoc($fetch_session_var_r)) {
    $session_user_id = $row['session_user_id'];
    $session_selected_lang = $row['session_selected_lang'];
}
if ($session_selected_lang == '1') {
    require('includes/navbar.php');
    require('components/achievements/section-1-eng.php');
    require('components/achievements/section-2-eng.php');
    require('includes/footer.php');
} else if ($session_selected_lang == '2') {
    require('includes/navbar-hindi.php');
    require('includes/footer-hindi.php');
} else if (!$session_user_id) {
    require('includes/language-modal.php');
    require('includes/navbar.php');
    require('components/achievements/section-1-eng.php');
    require('components/achievements/section-2-eng.php');
    require('includes/footer.php');
}