<?php
session_start();
$sessionId = session_id();
setcookie('session_id', $sessionId, time() + (86400 * 30), '/');
require('includes/db.php');
if (isset($_POST['update_lang'])) {
    $session_user_id = $_POST['session_user_id'];
    $session_selected_lang = $_POST['session_selected_lang'];

    $update_lang = "UPDATE
    `session`
SET
    `session_selected_lang` = '$session_selected_lang'
WHERE
    `session_user_id` = '$session_user_id'";
    $update_lang_r = mysqli_query($connection, $update_lang);
}


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
    $title = "Home | Dr. Neeraj Bora";
    require('includes/header.php');
    require('includes/navbar.php');
    require('components/home/section-1-eng.php');
    require('components/home/section-2-eng.php');
    require('components/home/section-3-eng.php');
    require('components/home/section-4-eng.php');
    require('components/home/section-5-eng.php');
    require('components/home/section-6-eng.php');
    require('components/home/section-7-eng.php');
    require('includes/footer.php');
} else if ($session_selected_lang == '2') {
    $title = "होम | डॉ नीरज बोरा";
    require('includes/header.php');
    require('includes/navbar-hindi.php');
    require('components/home/section-1-hindi.php');
    require('components/home/section-2-hindi.php');
    require('components/home/section-3-hindi.php');
    require('components/home/section-4-hindi.php');
    require('components/home/section-5-hindi.php');
    require('components/home/section-6-hindi.php');
    require('components/home/section-7-hindi.php');
    require('includes/footer-hindi.php');
} else if (!$session_user_id) {
    $title = "Home | Dr. Neeraj Bora";
    require('includes/header.php');
    require('includes/language-modal.php');
    require('includes/navbar.php');
    require('components/home/section-1-eng.php');
    require('components/home/section-2-eng.php');
    require('components/home/section-3-eng.php');
    require('components/home/section-4-eng.php');
    require('components/home/section-5-eng.php');
    require('components/home/section-6-eng.php');
    require('components/home/section-7-eng.php');
    require('includes/footer.php');
}
