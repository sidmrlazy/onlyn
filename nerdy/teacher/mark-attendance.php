<div class="container section-container">
    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    if (isset($_POST['present'])) {
        $attendance_student_id = $_POST['attendance_student_id'];
        $attendance_student_name = $_POST['attendance_student_name'];
        $attendance_date = $_POST['attendance_date'];
        $attendance_value = 1;
        $attendance_status = 1;
        $session_user_id;

        $insert_att = "INSERT INTO `student_attendance`(
                 `attendance_student_id`,
                 `attendance_student_name`,
                 `attendance_date`,
                 `attendance_value`,
                 `attendance_marked_by`,
                 `attendance_status`,
             )
             VALUES(
                 '$attendance_student_id',
                 '$attendance_student_name',
                 '$attendance_date',
                 '$attendance_value',
                 '$session_user_id',
                 '$attendance_status')";
        $insert_att_result = mysqli_query($connection, $insert_att);
        if (!$insert_att_result) {
            die("ERROR 404: " . mysqli_error($connection));
        } else {
            echo "<div class='alert alert-success' role='alert'>
                 Attendance marked!
               </div>";
        }
    }

    if (isset($_POST['mark'])) {
        $fetched_date = $_POST['attendance_date'];
        $attendance_class = $_POST['attendance_class'];

        // $insert_att_date = "INSERT INTO `attendance_date`(
        //     `attendance_date`,
        //     `attendance_class`,
        //     `attendance_by`
        // )
        // VALUES(
        //     '$fetched_date',
        //     '$attendance_class',
        //     '$session_user_id')";
        // $insert_att_result = mysqli_query($connection, $insert_att_date);
    }

    //     if ($fetch_data_result) {
    $fetch_student_data = "SELECT * FROM `students` WHERE student_added_by = $session_user_id";
    $fetch_student_data_res = mysqli_query($connection, $fetch_student_data);
    while ($row = mysqli_fetch_assoc($fetch_student_data_res)) {
        $student_id = $row['student_id'];
        $student_name = $row['student_name'];
    ?>

        <form action="" method="POST" class="mb-3">
            <div class="card p-3">
                <div class="mb-3 d-flex">
                    <!-- Hidden Values Start -->
                    <input type="text" name="attendance_date" class="form-control" value="<?php echo $fetched_date; ?>" hidden>
                    <input type="text" name="attendance_student_id" class="form-control" value="<?php echo $student_id; ?>" hidden>
                    <input type="text" name="attendance_student_name" class="form-control" value="<?php echo $student_name; ?>" hidden>
                    <!-- Hidden Values End -->

                    <div class="double-flex-attendance">
                        <p><?php echo $student_name; ?></p>

                    </div>


                    <button type='submit' name='present' class='btn btn-sm btn-outline-success m-1'>Mark
                        Present</button>
                    <button type='submit' name='absent' class='btn btn-sm btn-outline-danger m-1'>Mark
                        Absent</button>

                </div>
            </div>
        </form>
    <?php
    } ?>
</div>