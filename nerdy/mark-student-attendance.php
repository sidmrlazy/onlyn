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

<div class="d-flex container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container table-responsive animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="shield-checkmark-outline" class="section-heading-icon"></ion-icon>
                Mark Attendance
            </h3>
            <p>Attendance Date: <?php echo $current_date; ?></p>
        </div>

        <div class="table-responsive col-md-8 card p-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['edit-att'])) {
                        $attendance_id = $_POST['attendance_id'];
                        $attendance_value = $_POST['attendance_value'];

                        $update_att = "UPDATE `student_attendance` SET `attendance_value` = $attendance_value WHERE attendance_id = $attendance_id";
                        $update_att_r = mysqli_query($connection, $update_att);
                        if (!$update_att_r) {
                            die("<div class='alert alert-danger mt-3 mb-3' role='alert'>
                       ERROR 404 - (03)
                     </div>");
                        } else {
                            echo "<div class='alert alert-info mt-3 mb-3' role='alert'>
                       Attendance Changed
                     </div>";
                        }
                    }

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
                            $student_roll_number = $row['student_roll_number'];
                            $student_name = $row['student_name'];
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $student_roll_number ?></td>
                        <td><?php echo $student_name ?></td>
                        <form action="" method="POST">
                            <input type="text" name="attendance_class_id" value="<?php echo $class_id ?>" hidden>
                            <input type="text" name="attendance_student_id" value="<?php echo $student_id ?>" hidden>
                            <input type="text" name="attendance_student_name" value="<?php echo $student_name ?>"
                                hidden>

                            <?php
                                    $fetch_student_attendance = "SELECT * FROM student_attendance WHERE attendance_student_id = $student_id AND attendance_date = '$current_date'";
                                    $fetch_student_attendance_res = mysqli_query($connection, $fetch_student_attendance);
                                    $fetch_att_count = mysqli_num_rows($fetch_student_attendance_res);

                                    if ($fetch_att_count > 0) {
                                        while ($row = mysqli_fetch_assoc($fetch_student_attendance_res)) {
                                            $att_id = $row['attendance_id'];
                                            $attendance_value = $row['attendance_value'];
                                            if ($attendance_value == 1) { ?>

                            <!-- If Attendance marked Present -->
                            <td class="text-center">
                                <p class="att-status-p text-center">Present</p>
                            </td>

                            <!-- If Attendance marked Absent -->
                            <?php } elseif ($attendance_value == 2) {  ?>
                            <td class="text-center">
                                <p class="att-status-a">Absent</p>
                            </td>

                            <?php }
                                        } ?>

                            <!-- If Attendance marked show Edit Button -->
                            <?php if ($attendance_value == 1) { ?>
                            <td class="text-center">
                                <form action="" method="POST">
                                    <input type="text" name="attendance_id" value="<?php echo $att_id ?>" hidden>
                                    <input type="text" name="attendance_value" value="2" hidden>
                                    <button type="subimt" name="edit-att" class="btn btn-sm btn-outline-warning">
                                        Change
                                    </button>
                                </form>
                            </td>
                            <?php } else if ($attendance_value == 2) { ?>
                            <td class="text-center">
                                <form action="" method="POST">
                                    <input type="text" name="attendance_id" value="<?php echo $att_id ?>" hidden>
                                    <input type="text" name="attendance_value" value="1" hidden>
                                    <button type="subimt" name="edit-att" class="btn btn-sm btn-outline-success">
                                        Change
                                    </button>
                                </form>
                            </td>
                            <?php } ?>

                            <!-- If Attendance is not marked -->
                            <?php   } else if ($fetch_att_count == 0) { ?>
                            <td><button type="submit" name="present"
                                    class="btn btn-sm btn-outline-success">Present</button>
                            </td>
                            <td><button type="submit" name="absent"
                                    class="btn btn-sm btn-outline-danger">Absent</button></td>
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
</div>
<?php include('main/footer.php'); ?>