<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Day
            </h3>
            <p class="section-desc">Select Day to show attendance</p>
        </div>

        <div class="w-100">
            <div class="tab-wrap-view">
                <?php
                require_once('main/config.php');
                $fetch_user = "SELECT * FROM `users` WHERE `user_id` = $session_user_id";
                $fetch_user_res = mysqli_query($connection, $fetch_user);

                $user_contact = "";
                while ($row = mysqli_fetch_assoc($fetch_user_res)) {
                    $user_contact = $row['user_contact'];
                }

                $fetch_student = "SELECT * FROM `students` WHERE student_father_contact = '$user_contact'";
                $fetch_student_res = mysqli_query($connection, $fetch_student);

                $student_assigned_class = "";
                while ($row = mysqli_fetch_assoc($fetch_student_res)) {
                    $student_assigned_class = $row['student_assigned_class'];
                }

                $fetch_teachers = "SELECT * FROM `time_table` WHERE tt_class = $student_assigned_class GROUP BY tt_day";
                $fetch_teacher_result = mysqli_query($connection, $fetch_teachers);
                while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                    $tt_id = $row['tt_id'];
                    $tt_day_original = $row['tt_day'];
                    if ($tt_day_original == 1) {
                        $tt_day = "Monday";
                    } else if ($tt_day_original == 2) {
                        $tt_day = "Tuesday";
                    } else if ($tt_day_original == 3) {
                        $tt_day = "Wednesday";
                    } else if ($tt_day_original == 4) {
                        $tt_day = "Thursday";
                    } else if ($tt_day_original == 5) {
                        $tt_day = "Friday";
                    } else if ($tt_day_original == 6) {
                        $tt_day = "Saturday";
                    } else if ($tt_day_original == 7) {
                        $tt_day = "Sunday";
                    }
                    $tt_created_by = $row['tt_created_by'];
                ?>
                <form action="parent-show-tt.php" method="POST">
                    <input type="text" name="tt_created_by" value="<?php echo $tt_created_by ?>" hidden>
                    <input type="text" name="tt_day" value="<?php echo $tt_day_original ?>" hidden>
                    <button type="submit" name="submit" class="att-carrot">
                        <p><?php echo $tt_day ?></p>
                    </button>
                </form>
                <?php

                } ?>
            </div>
        </div>
    </div>



</div>
<?php include('main/footer.php');  ?>