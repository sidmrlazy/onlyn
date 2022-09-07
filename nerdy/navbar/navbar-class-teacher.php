<?php include('modal.php') ?>
<?php include('toasts.php') ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/images/logo/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">
                        <ion-icon name="home"></ion-icon> Home
                    </a>
                </li>
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="class-teacher-select-class-activity">
                        <ion-icon name="balloon"></ion-icon>
                        Activities
                    </a>
                </li>
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="student.php">
                        <ion-icon name="person"></ion-icon>
                        Students
                    </a>
                </li>
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="mark-student-attendance.php">
                        <ion-icon name="shield-checkmark"></ion-icon>
                        Attendance
                    </a>
                </li>
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="#">
                        <ion-icon name="megaphone"></ion-icon>
                        Announcements
                    </a>
                </li>
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="#">
                        <ion-icon name="calendar"></ion-icon>
                        Time Table
                    </a>
                </li>
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="class-teacher-student-diary-menu.php">
                        <ion-icon name="book"></ion-icon>
                        Student Diary
                    </a>
                </li>

            </ul>

            <div class="d-flex">
                <?php
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }
                $current_date = date('d-m-Y');

                $query = "SELECT * FROM `staff_attendance` WHERE staff_attendance_user_id = $session_user_id AND staff_attendance_date = '$current_date'";
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);

                if ($count == 0) {
                    if (isset($_POST['mark'])) {
                        $staff_attendance_user_id = $_POST['staff_attendance_user_id'];
                        $staff_attendance_user_name = $_POST['staff_attendance_user_name'];
                        $staff_attendance_date = $current_date;
                        $staff_attendance_admin_user = $_POST['staff_attendance_admin_user'];
                        $staff_attendance_value = 1;

                        $mark_staff_att = "INSERT INTO `staff_attendance`(
                           `staff_attendance_user_id`,
                           `staff_attendance_user_name`,
                           `staff_attendance_date`,
                           `staff_attendance_admin_user`,
                           `staff_attendance_value`
                       )
                       VALUES(
                           '$staff_attendance_user_id',
                           '$staff_attendance_user_name',
                           '$staff_attendance_date',
                           '$staff_attendance_admin_user',
                           '$staff_attendance_value')";
                        $mark_att_res = mysqli_query($connection, $mark_staff_att);
                        if (!$mark_att_res) {
                            die("ERROR 404: " . mysqli_error($connection));
                        } else {
                            echo '<script>markAttToast()</script>';
                        }
                    }
                }


                $user_query = "SELECT * FROM users WHERE user_id = $session_user_id";
                $user_result = mysqli_query($connection, $user_query);
                $user_id = "";
                $user_name = "";
                $user_added_by = "";
                while ($row = mysqli_fetch_assoc($user_result)) {
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $user_added_by = $row['user_added_by'];
                }
                if ($count == 0) {
                    echo "<script>classTeacherAttendanceModal();</script>";
                ?>
                <form action="" method="POST">
                    <input type="text" name="staff_attendance_user_id" value="<?php echo $user_id ?>" hidden>
                    <input type="text" name="staff_attendance_user_name" value="<?php echo $user_name ?>" hidden>
                    <input type="text" name="staff_attendance_admin_user" value="<?php echo $user_added_by ?>" hidden>

                    <button type="submit" name="mark" class="btn btn-sm btn-outline-primary">Mark Attendance</button>
                </form>
                <?php
                } ?>



                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <?php
                        require_once('main/config.php');
                        if (!empty($_SESSION['user_type'])) {
                            $session_user_id = $_SESSION['user_id'];
                            $session_user_type = $_SESSION['user_type'];
                            $query = "SELECT * FROM users WHERE user_id = $session_user_id";
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $user_name = $row['user_name'];
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Learning Management System" aria-expanded="false">
                            <?php echo $user_name ?>
                        </a>
                        <?php
                            }
                        } else {
                            $session_user_id = 0;
                        }
                        ?>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="profile-class-teacher.php">
                                    <ion-icon name="person-circle-outline"></ion-icon> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</nav>