<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn w-100">

        <div class="mb-3 col-md-3">
            <?php
            $query = "SELECT * FROM `users` WHERE user_id = $session_user_id";
            $result = mysqli_query($connection, $query);
            $user_contact = "";
            while ($row = mysqli_fetch_assoc($result)) {
                $user_contact = $row['user_contact'];
            }

            $get_student = "SELECT * FROM students WHERE student_father_contact = $user_contact";
            $get_student_res = mysqli_query($connection, $get_student);
            $student_id = "";
            while ($row = mysqli_fetch_assoc($get_student_res)) {
                $student_id = $row['student_id'];
            }
            ?>
            <form action="parent-selected-date-attendance.php" method="POST" class="d-flex form-control">
                <input type="text" name="student_id" value="<?php echo $student_id ?>" class="m-1 form-control" hidden>
                <input type="date" name="change_date" class="m-1 form-control">
                <button type="submit" name="change" class="btn btn-sm btn-outline-success m-1">Change</button>
            </form>
        </div>

        <div class="table-responsive card p-4 col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-center">Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `users` WHERE user_id = $session_user_id";
                    $result = mysqli_query($connection, $query);
                    $user_contact = "";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_contact = $row['user_contact'];
                    }

                    $get_student = "SELECT * FROM students WHERE student_father_contact = $user_contact";
                    $get_student_res = mysqli_query($connection, $get_student);
                    $student_id = "";
                    while ($row = mysqli_fetch_assoc($get_student_res)) {
                        $student_id = $row['student_id'];
                    }

                    $attendance = "SELECT * FROM `student_attendance`";
                    $attendance_r = mysqli_query($connection, $attendance);
                    $number_of_result = mysqli_num_rows($attendance_r);

                    $results_per_page = 10;
                    $number_of_page = ceil($number_of_result / $results_per_page);

                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    $page_first_result = ($page - 1) * $results_per_page;

                    $attendance_query = "SELECT * FROM `student_attendance` WHERE `attendance_student_id` = $student_id LIMIT "  . $page_first_result . ',' . $results_per_page;
                    $attendance_result = mysqli_query($connection, $attendance_query);

                    while ($row = mysqli_fetch_assoc($attendance_result)) {
                        $attendance_date = $row['attendance_date'];
                        $attendance_value = $row['attendance_value'];
                        if ($attendance_value == 1) {
                            $attendance_value_name = "PRESENT";
                        }
                        if ($attendance_value == 2) {
                            $attendance_value_name = "ABSENT";
                        }
                    ?>
                    <tr>
                        <td scope="row"><?php echo date('d-M-Y', strtotime($attendance_date)) ?></td>

                        <td class="text-center"><?php echo $attendance_value_name ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <nav class="mt-3" aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                for ($page = 1; $page <= $number_of_page; $page++) {
                    echo '<li class="page-item"><a class="page-link" href="show-student-attendance.php?page=' . $page . '">' . $page . ' </a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div>
<?php include('main/footer.php'); ?>