<div class="d-flex container-fluid">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard w-100">
        <?php
        $get_user = "SELECT * FROM users WHERE user_id = $session_user_id";
        $get_user_r = mysqli_query($connection, $get_user);

        $user_contact = "";
        while ($row = mysqli_fetch_assoc($get_user_r)) {
            $user_contact = $row['user_contact'];
        }

        $get_student = "SELECT * FROM `students` WHERE student_father_contact = $user_contact";
        $get_student_r = mysqli_query($connection, $get_student);
        $student_status = "";
        while ($row = mysqli_fetch_assoc($get_student_r)) {
            $student_id = $row['student_id'];
            $student_status = $row['student_status'];
        }

        if ($student_status == 2) { ?>
        <form action="profile-update-parent.php" method="POST" class="dashboard-notification">
            <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
            <button type="submit" name="submit" href="" class="dashboard-notification-btn">
                <div class="notification-name">
                    <p class="notification-name-text">Profile Update</p>
                </div>
                <p>Please complete student profile to continue!</p>
            </button>
        </form>
        <?php } ?>

        Time table for <?php echo date('D'); ?>



        <div class="table-responsive card p-4 mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Time</th>
                        <th scope="col">Teacher</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query = "SELECT * FROM `users` WHERE `user_id` = $session_user_id";
                    $result = mysqli_query($connection, $query);

                    $user_contact = "";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $user_contact = $row['user_contact'];
                    }

                    $fetch_student = "SELECT * FROM `students` WHERE `student_father_contact` = '$user_contact'";
                    $fetch_student_result = mysqli_query($connection, $fetch_student);

                    $student_assigned_class = "";
                    while ($row = mysqli_fetch_assoc($fetch_student_result)) {
                        $student_id = $row['student_id'];
                        $student_assigned_class = $row['student_assigned_class'];
                    }


                    $get_time_table = "SELECT * FROM `time_table` WHERE `tt_class` = $student_assigned_class";
                    $get_time_table_result = mysqli_query($connection, $get_time_table);

                    $current_day = date('D');

                    while ($row = mysqli_fetch_assoc($get_time_table_result)) {
                        $tt_day_original = $row['tt_day'];
                        $tt_period = $row['tt_period'];
                        $tt_subject = $row['tt_subject'];
                        $tt_time = $row['tt_time'];
                        $tt_teacher = $row['tt_teacher'];

                        $fetch_teacher = "SELECT * FROM `users` WHERE `user_id` = '$tt_teacher'";
                        $fetch_teacher_res = mysqli_query($connection, $fetch_teacher);

                        $user_name = "";
                        while ($row = mysqli_fetch_assoc($fetch_teacher_res)) {
                            $user_name = $row['user_name'];
                        }
                        $tt_teacher = $user_name;


                        if ($tt_day_original == 1) {
                            $tt_day = 'Mon';
                        } else if ($tt_day_original == 2) {
                            $tt_day = 'Tue';
                        } else if ($tt_day_original == 3) {
                            $tt_day = 'Wed';
                        } else if ($tt_day_original == 4) {
                            $tt_day = 'Thu';
                        } else if ($tt_day_original == 5) {
                            $tt_day = 'Fri';
                        } else if ($tt_day_original == 6) {
                            $tt_day = 'Sat';
                        } else if ($tt_day_original == 7) {
                            $tt_day = 'Sun';
                        }

                        if ($tt_day == $current_day) { ?>

                    <tr>
                        <td><?php echo $tt_day ?></td>
                        <td><?php echo $tt_subject ?></td>
                        <td><?php echo $tt_time ?></td>
                        <td><?php echo $tt_teacher ?></td>
                    </tr>
                    <?php }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>