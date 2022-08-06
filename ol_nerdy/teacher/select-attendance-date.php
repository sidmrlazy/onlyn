<?php
require_once('main/config.php');
if (!empty($_SESSION['user_type'])) {
    $session_user_id = $_SESSION['user_id'];
} else {
    $session_user_id = 0;
}
$current_date = date('d-m-Y');
?>
<div class="container section-container table-responsive">
    <div class="section-header">
        <h3 class="m-0">Mark Attendance</h3>
        <p>Attendance Date: <?php echo $current_date; ?></p>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Student Name</th>
                <th scope="col" colspan="2" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['present'])) {
                $attendance_student_id = $_POST['attendance_student_id'];
                $attendance_student_name = $_POST['attendance_student_name'];
                $attendance_class_id = $_POST['attendance_class_id'];
                $current_date;
                $attendance_value = 1;
                $session_user_id;

                $check_status = "SELECT * FROM `student_attendance` WHERE attendance_student_id=$attendance_student_id";
                $status_result = mysqli_query($connection, $check_status);
                $status_count = mysqli_num_rows($status_result);

                // echo $status_count;
                if ($status_count > 0) {
                    echo "<div class='alert alert-danger mt-3 mb-3' role='alert'>
                    Attendance already marked for $attendance_student_name!
                  </div>";
                } else {
                    $insert_attendance = "INSERT INTO `student_attendance`(
                         `attendance_student_id`,
                         `attendance_student_name`,
                         `attendance_date`,
                         `attendance_value`,
                         `attendance_marked_by`,
                         `attendance_class_id`
                     )
                     VALUES(
                         '$attendance_student_id',
                         '$attendance_student_name',
                         '$current_date',
                         '$attendance_value',
                         '$session_user_id',
                         '$attendance_class_id')";
                    $insert_res = mysqli_query($connection, $insert_attendance);
                    if ($insert_res) {
                        echo "<div class='alert alert-success mt-3 mb-3' role='alert'>
                        Attendance marked!
                      </div>";
                    } else {
                        die(mysqli_error($connection));
                    }
                }
            }

            if (isset($_POST['absent'])) {
                $attendance_student_id = $_POST['attendance_student_id'];
                $attendance_student_name = $_POST['attendance_student_name'];
                $attendance_class_id = $_POST['attendance_class_id'];
                $current_date;
                $attendance_value = 2;
                $session_user_id;

                $check_status = "SELECT * FROM `student_attendance` WHERE attendance_student_id=$attendance_student_id";
                $status_result = mysqli_query($connection, $check_status);
                $status_count = mysqli_num_rows($status_result);

                // echo $status_count;
                if ($status_count > 0) {
                    echo "<div class='alert alert-danger mt-3 mb-3' role='alert'>
                    Attendance already marked for $attendance_student_name!
                  </div>";
                } else {
                    $insert_attendance = "INSERT INTO `student_attendance`(
                        `attendance_student_id`,
                        `attendance_student_name`,
                        `attendance_date`,
                        `attendance_value`,
                        `attendance_marked_by`,
                        `attendance_class_id`
                    )
                    VALUES(
                        '$attendance_student_id',
                        '$attendance_student_name',
                        '$current_date',
                        '$attendance_value',
                        '$session_user_id',
                        '$attendance_class_id')";
                    $insert_res = mysqli_query($connection, $insert_attendance);
                    if ($insert_res) {
                        echo "<div class='alert alert-success mt-3 mb-3' role='alert'>
                        Attendance marked!
                      </div>";
                    } else {
                        die(mysqli_error($connection));
                    }
                }
            }

            $fetch_teacher_class = "SELECT * FROM classes WHERE class_teacher = $session_user_id";
            $fetch_teacher_class_result = mysqli_query($connection, $fetch_teacher_class);
            while ($row = mysqli_fetch_assoc($fetch_teacher_class_result)) {
                $class_id = $row['class_id'];
                $fetch_student = "SELECT * FROM students WHERE student_added_by = $session_user_id AND student_assigned_class = $class_id";
                $fetch_student_result = mysqli_query($connection, $fetch_student);
                while ($row = mysqli_fetch_assoc($fetch_student_result)) {
                    $student_id = $row['student_id'];
                    $student_name = $row['student_name'];
            ?>
                    <tr>
                        <th scope="row"><?php echo $student_id ?></th>
                        <td><?php echo $student_name ?></td>
                        <form action="" method="POST">
                            <input type="text" name="attendance_class_id" value="<?php echo $class_id ?>" hidden>
                            <input type="text" name="attendance_student_id" value="<?php echo $student_id ?>" hidden>
                            <input type="text" name="attendance_student_name" value="<?php echo $student_name ?>" hidden>

                            <?php
                            $fetch_student_attendance = "SELECT * FROM student_attendance WHERE attendance_student_id = $student_id";
                            $fetch_student_attendance_res = mysqli_query($connection, $fetch_student_attendance);
                            $fetch_att_count = mysqli_num_rows($fetch_student_attendance_res);
                            // echo $fetch_att_count . " " . $student_name . "<br>";

                            if ($fetch_att_count > 0) {
                                while ($row = mysqli_fetch_assoc($fetch_student_attendance_res)) {
                                    $attendance_value = $row['attendance_value'];
                                    if ($attendance_value == 1) { ?>
                                        <td class="text-center d-flex justify-content-center align-items-center">
                                            <p class="att-status-p">Present</p>
                                        </td>

                                    <?php } elseif ($attendance_value == 2) {  ?>
                                        <td class="text-center d-flex justify-content-center align-items-center">
                                            <p class="att-status-a">Absent</p>
                                        </td>

                                <?php }
                                }
                            } else if ($fetch_att_count == 0) { ?>

                                <td class="text-center"><button type="submit" name="present" class="btn btn-outline-success">Present</button></td>
                                <td class="text-center"><button type="submit" name="absent" class="btn btn-outline-danger">Absent</button></td>

                            <?php } ?>
                        </form>
                    </tr>
            <?php
                }
            }


            ?>
        </tbody>
    </table>
</div>