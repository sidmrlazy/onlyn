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
            <p class="section-desc">Select class to view time-table</p>
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

                $fetch_teachers = "SELECT * FROM `classes` WHERE `class_added_by` = $session_user_id GROUP BY `class_name`";
                $fetch_teacher_result = mysqli_query($connection, $fetch_teachers);
                while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                    $class_id = $row['class_id'];
                    $class_name = $row['class_name'];
                    $class_section = $row['class_section'];
                    $class_status = $row['class_status'];

                    if (
                        $class_name == 1 ||
                        $class_name == 2 ||
                        $class_name == 3 ||
                        $class_name == 4 ||
                        $class_name == 5 ||
                        $class_name == 6 ||
                        $class_name == 7 ||
                        $class_name == 8 ||
                        $class_name == 9 ||
                        $class_name == 10 ||
                        $class_name == 11 ||
                        $class_name == 12
                    ) {
                        $class_name = "Class " . $class_name;
                    }
                ?>
                <form action="view-class-wise-fee-details.php" method="POST">
                    <input type="text" name="class_id" value="<?php echo $class_id ?>" hidden>
                    <button type="submit" name="submit" class="att-carrot">
                        <p><?php echo $class_name ?></p>
                    </button>
                </form>
                <?php

                } ?>
            </div>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>