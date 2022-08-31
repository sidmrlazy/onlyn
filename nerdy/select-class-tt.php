<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Select Class
            </h3>
            <p class="section-desc">Select class to view the time-table set by the respective class teacher</p>
        </div>

        <div class="w-100">
            <div class="tab-wrap-view">
                <?php
                require_once('main/config.php');
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }

                $fetch_teachers = "SELECT * FROM `classes` WHERE class_added_by = $session_user_id";
                $fetch_teacher_result = mysqli_query($connection, $fetch_teachers);
                while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                    $class_id = $row['class_id'];
                    $class_name = $row['class_name'];
                    $class_section = $row['class_section'];
                    $class_status = $row['class_status'];
                ?>
                <form action="show-tt-day.php" method="POST">
                    <input type="text" name="tt_class" value="<?php echo $class_id ?>" hidden>
                    <button type="submit" name="submit" class="att-carrot">
                        <p><?php echo $class_name . $class_section ?></p>
                    </button>
                </form>
                <?php

                } ?>
            </div>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>