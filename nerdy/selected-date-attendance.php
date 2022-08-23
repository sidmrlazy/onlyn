<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container table-responsive animate__animated animate__fadeIn">
        <div class="card p-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['change'])) {
                        $change_date = date('d-m-Y', strtotime($_POST['change_date']));


                        $date_query = "SELECT * FROM `student_attendance` WHERE attendance_date='$change_date' ORDER BY attendance_date DESC";
                        $date_result = mysqli_query($connection, $date_query);

                        while ($row = mysqli_fetch_assoc($date_result)) {
                            $attendance_date = $row['attendance_date'];
                            $attendance_student_name = $row['attendance_student_name'];
                            $attendance_value = $row['attendance_value'];
                            if ($attendance_value == 1) {
                                $attendance_value = "Present";
                            } else if ($attendance_value == 2) {
                                $attendance_value = "Absent";
                            }
                    ?>

                    <tr>
                        <td><?php echo $attendance_date ?></td>
                        <td><?php echo $attendance_student_name ?></td>
                        <?php
                                if ($attendance_value == "Present") { ?>
                        <td class="att-status-p"><?php echo $attendance_value ?></td>
                        <?php } else if ($attendance_value == "Absent") { ?>
                        <td class="att-status-a"><?php echo $attendance_value ?></td>
                        <?php
                                }
                                ?>
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