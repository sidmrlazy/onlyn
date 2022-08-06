<?php
if (!empty($_SESSION['user_type'])) {
    $session_user_id = $_SESSION['user_id'];
    $session_user_type = $_SESSION['user_type'];
} else {
    $session_user_id = 0;
}

if ($session_user_type == 1) {
?>
    <?php include('dashboard-admin.php') ?>

    <!-- ======================== SCHOOL DASHBOARD START ======================== -->
<?php
} else if ($session_user_type == 2) { ?>
    <?php include('dashboard-school.php') ?>
    <!-- ======================== SCHOOL DASHBOARD END ======================== -->



    <!-- ======================== TEACHER DASHBOARD START ======================== -->
<?php
} else if ($session_user_type == 3) { ?>
    <?php include('dashboard-teacher.php') ?>
    <!-- ======================== SCHOOL DASHBOARD END ======================== -->




    <!-- ======================== PARENT DASHBOARD START ======================== -->
<?php } else if ($session_user_type == 4) { ?>
    <?php include('dashboard-parent.php') ?>
    <!-- ======================== PARENT DASHBOARD END ======================== -->
<?php } ?>