<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>

    <div class="school-main-dashboard container mt-3">
        <?php include('dashboard/pills.php') ?>
        <?php
        require_once('main/config.php');

        if (isset($_POST['complete'])) {
            $setup_remove_status = 2;
            $setup_id = $_POST['setup_id'];
            $update_table = "UPDATE `setup_status` SET `setup_remove_status`='$setup_remove_status' WHERE setup_school_id = $session_user_id AND setup_id = $setup_id";
            $update_table_result = mysqli_query($connection, $update_table);
            if (!$update_table_result) {
                die(mysqli_error($connection));
            } else {
                echo '<div class="alert alert-success mt-4 animate__animated animate__fadeInUp" role="alert">Setup Complete!</div>';
            }
        }

        $query = "SELECT * FROM setup_status WHERE setup_school_id = $session_user_id";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $setup_id = $row['setup_id'];
            $setup_registration_status = $row['setup_registration_status'];
            $setup_class_status = $row['setup_class_status'];
            $setup_teacher_status = $row['setup_teacher_status'];
            $setup_staff_status = $row['setup_staff_status'];
            $setup_subject_status = $row['setup_subject_status'];
            $setup_remove_status = $row['setup_remove_status'];

            if ($setup_registration_status == 1) {
                $total_setup_status = 15;
            }
            if ($setup_registration_status == 2) {
                $total_setup_status = 25;
            }
            if ($setup_class_status == 1) {
                $total_setup_status = 50;
            }
            if ($setup_teacher_status == 1) {
                $total_setup_status = 65;
            }
            if ($setup_staff_status == 1) {
                $total_setup_status = 75;
            }
            if ($setup_subject_status == 1) {
                $total_setup_status = 100;
            }
            if ($setup_remove_status == 0) {
        ?>
        <div class="dashboard-custom-card p-3 mt-3">
            <div class="alert alert-success" role="alert">
                Setup Progress
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="25" aria-valuemin="0" style="width: <?php echo $total_setup_status ?>%;"
                    aria-valuemax="100">
                    <?php echo $total_setup_status ?>%</div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <a href="setup.php" class="btn btn-outline-success">Continue Setup</a>
            </div>
        </div>
        <?php
            }
            if ($setup_remove_status == 1) { ?>
        <div class="dashboard-custom-card p-3 mt-3">
            <div class="alert alert-warning" role="alert">
                Setup Progress
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="25" aria-valuemin="0" style="width: <?php echo $total_setup_status ?>%;"
                    aria-valuemax="100">
                    <?php echo $total_setup_status ?>%</div>
            </div>
            <form action="" method="POST" class="mt-3 d-flex justify-content-end">
                <input type="text" name="setup_id" value="<?php echo $setup_id; ?>" hidden>
                <button type="submit" name="complete" class="btn btn-success">End Setup</button>
            </form>
        </div>

        <?php }
            if ($setup_remove_status == 2) { ?>
        <div class="d-none card p-3">
            <div class="alert alert-warning" role="alert">
                Setup Progress
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="25" aria-valuemin="0" style="width: <?php echo $total_setup_status ?>%;"
                    aria-valuemax="100">
                    <?php echo $total_setup_status ?>%</div>
            </div>
            <form action="" method="POST" class="mt-3 d-flex justify-content-end">
                <input type="text" name="setup_id" value="<?php echo $setup_id; ?>" hidden>
                <button type="submit" name="complete" class="btn btn-success">End Setup</button>
            </form>
        </div>
        <?php
            }
        } ?>

        <div class="animate__animated animate__fadeIn mt-5 mb-5">
            <div class="section-header mb-3">
                <h3 class="section-heading-dashboard">
                    <ion-icon name="school-outline" class="section-heading-icon"></ion-icon>
                    Subscription Status
                </h3>
            </div>
            <?php
            if (!empty($_SESSION['user_type'])) {
                $session_user_id = $_SESSION['user_id'];
            } else {
                $session_user_id = 0;
            }
            $current_date = date('d-m-Y');
            echo $current_date;

            $query = "SELECT * FROM `subscription` WHERE `subscription_user_id` = '$session_user_id'";
            $subscription_res = mysqli_query($connection, $query);
            $subscription_end_date = "";
            while ($row = mysqli_fetch_assoc($subscription_res)) {
                $subscription_end_date = $row['subscription_end_date'];

                if ($current_date == $subscription_end_date) {
                    $subscription_end_date = "EXPIRED. CURRENT DATE IS EQUAL TO SUBSCRIPTION END DATE ( $subscription_end_date )";
                } elseif ($current_date <= $subscription_end_date) {
                    $subscription_end_date = "EXPIRED. CURRENT DATE IS LESS THAN OR EQUAL TO SUBSCRIPTION END DATE ( $subscription_end_date )";
                } else {
                    $subscription_end_date = "ACTIVE";
                }
            }

            ?>
            <p style="color: #000;"><?php echo $subscription_end_date; ?></p>


        </div>

        <div class="animate__animated animate__fadeIn mt-4">
            <div class="section-header mb-3">
                <h3 class="section-heading-dashboard">
                    <ion-icon name="glasses-outline" class="section-heading-icon"></ion-icon>
                    Teachers who logged in today
                </h3>
            </div>

            <?php
            $current_date = date('d-m-Y');
            $attendance_query = "SELECT * FROM staff_attendance WHERE staff_attendance_admin_user = $session_user_id";
            $attendance_res = mysqli_query($connection, $attendance_query);
            while ($row = mysqli_fetch_assoc($attendance_res)) {
                $staff_name = $row['staff_attendance_user_name'];
                $staff_attendance_date = $row['staff_attendance_date'];
                $staff_attendance_value = $row['staff_attendance_value'];
                if ($current_date == $staff_attendance_date) { ?>
            <div class="dashboard-live-tab">
                <div class="live-att-col">
                    <p class="live-att-name"><?php echo $staff_name; ?></p>
                    <p class="live-att-date"><?php echo $staff_attendance_date; ?></p>
                </div>
                <?php
                        if ($staff_attendance_value == 1) { ?>
                <img src="assets/images/gif/ol-dot.gif" alt="" class="live-att-img">
                <?php } ?>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <div class="animate__animated animate__fadeIn mt-4 mb-5">
            <div class="section-header mb-3">
                <h3 class="section-heading-dashboard">
                    <ion-icon name="school-outline" class="section-heading-icon"></ion-icon>
                    Daily classwise student attendance
                </h3>
            </div>

            <div class="w-100 animate__animated animate__fadeIn">
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

                        $current_date = date('d-m-Y');

                        $fetch_student = "SELECT * FROM student_attendance WHERE attendance_class_id = $class_id AND attendance_date = '$current_date'";
                        $fetch_res = mysqli_query($connection, $fetch_student);

                        $fetch_att_count = "";
                        $attendance_date = "";
                        while ($row = mysqli_fetch_assoc($fetch_res)) {
                            $attendance_date = $row['attendance_date'];
                            $attendance_value = $row['attendance_value'];
                            if ($attendance_value == 1) {
                                $fetch_att_count = mysqli_num_rows($fetch_res);
                            }
                        }
                    ?>
                    <form action="show-tt-day.php" method="POST">
                        <input type="text" name="tt_class" value="<?php echo $class_id ?>" hidden>
                        <div class="att-carrot mb-2">
                            <?php
                                if (empty($fetch_att_count)) { ?>
                            <p><?php echo $class_name . $class_section . " - " . "Attendance Not Marked" ?></p>
                            <?php } else { ?>
                            <p><?php echo $class_name . $class_section . " - " . $fetch_att_count ?></p>
                            <?php } ?>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>


    </div>
</div>