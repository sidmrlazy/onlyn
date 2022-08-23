<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<?php
require_once('main/config.php');
if (!empty($_SESSION['user_type'])) {
    $session_user_id = $_SESSION['user_id'];
} else {
    $session_user_id = 0;
}
$current_date = date('d-m-Y');
?>

<div class="d-flex ">
    <?php include('navbar/teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container table-responsive animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="shield-checkmark-outline" class="section-heading-icon"></ion-icon>
                Mark Attendance
            </h3>
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

                    $check_status = "SELECT * FROM `student_attendance` WHERE attendance_student_id='$attendance_student_id' AND attendance_date = '$current_date'";
                    $status_result = mysqli_query($connection, $check_status);
                    $status_count = mysqli_num_rows($status_result);

                    $att_date = "";
                    while ($row = mysqli_fetch_assoc($status_result)) {
                        $att_date = $row['attendance_date'];
                    }
                    if ($current_date == $att_date) {
                        echo "<div class='alert alert-danger mt-3 mb-3' role='alert'>
                       Attendance already marked for $attendance_student_name!
                     </div>";
                    } else if ($current_date != $att_date) {
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
                            echo '<script>studentAttendance()</script>';
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

                    $check_status = "SELECT * FROM `student_attendance` WHERE attendance_student_id='$attendance_student_id' AND attendance_date = '$current_date'";
                    $status_result = mysqli_query($connection, $check_status);
                    $status_count = mysqli_num_rows($status_result);

                    $att_date = "";
                    while ($row = mysqli_fetch_assoc($status_result)) {
                        $att_date = $row['attendance_date'];
                    }
                    if ($current_date == $att_date) {
                        echo "<div class='alert alert-danger mt-3 mb-3' role='alert'>
                       Attendance already marked for $attendance_student_name!
                     </div>";
                    } else if ($current_date != $att_date) {
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
                            echo '<script>studentAttendance()</script>';
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
                                $fetch_student_attendance = "SELECT * FROM student_attendance WHERE attendance_student_id = $student_id AND attendance_date = '$current_date'";
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

                        <td class="text-center"><button type="submit" name="present"
                                class="btn btn-outline-success">Present</button></td>
                        <td class="text-center"><button type="submit" name="absent"
                                class="btn btn-outline-danger">Absent</button></td>

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
</div>
<?php include('main/footer.php'); ?>