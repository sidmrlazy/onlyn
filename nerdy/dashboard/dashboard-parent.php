<?php
if (!empty($_SESSION['user_type'])) {
    $session_user_id = $_SESSION['user_id'];
    $session_user_contact = $_SESSION['user_contact'];
    $session_user_type = $_SESSION['user_type'];
} else {
    $session_user_id = 0;
}
?>
<div class="d-flex">
    <?php include('navbar/parent-side-nav.php') ?>

    <div class="school-main-dashboard container mt-5">


    </div>
</div>