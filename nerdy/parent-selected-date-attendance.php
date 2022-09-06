<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard w-100 animate__animated animate__fadeIn">

        <?php
        if (isset($_POST['change'])) {
            $student_id = $_POST['student_id'];
            $change_date = date('d-m-Y', strtotime($_POST['change_date']));
            $date_query = "SELECT * FROM `student_attendance` WHERE `attendance_date`='$change_date' AND `attendance_student_id` = '$student_id' ORDER BY attendance_date DESC";
            $date_result = mysqli_query($connection, $date_query);
            $count = mysqli_num_rows($date_result);


            if ($count == 0) { ?>
        <div class="alert alert-danger mb-3 " role="alert">
            No attendance data found for this date
        </div>
        <?php
            } else if ($count > 0) { ?>

        <div class="table-responsive col-md-6 card mob-card p-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            while ($row = mysqli_fetch_assoc($date_result)) {
                                $attendance_date = $row['attendance_date'];
                                $attendance_value = $row['attendance_value'];
                                if ($attendance_value == 1) {
                                    $attendance_value = "Present";
                                } else if ($attendance_value == 2) {
                                    $attendance_value = "Absent";
                                }
                            ?>
                    <tr>
                        <td><?php echo $attendance_date ?></td>
                        <?php
                                    if ($attendance_value == "Present") { ?>
                        <td class="att-status-p"><?php echo $attendance_value ?></td>
                        <?php } else if ($attendance_value == "Absent") { ?>
                        <td class="att-status-a"><?php echo $attendance_value ?></td>
                        <?php } ?>
                    </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>