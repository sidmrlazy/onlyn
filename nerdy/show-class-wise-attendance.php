<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container table-responsive animate__animated animate__fadeIn">

        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }
        if (isset($_POST['submit'])) {
            $class_id = $_POST['class_id'];
            $query = "SELECT * FROM student_attendance WHERE attendance_class_id = $class_id ORDER BY attendance_date DESC";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);
        ?>
        <div class="d-flex mb-3">
            <form action="selected-date-attendance.php" method="POST" class="d-flex form-control">
                <input type="date" name="change_date" class="m-1 form-control">
                <button type="submit" name="change" class="change-date-btn-new m-1">Change</button>
            </form>
        </div>
        <div class="card mob-card p-5">
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
                        while ($row = mysqli_fetch_assoc($result)) {
                            $attendance_student_name = $row['attendance_student_name'];
                            $attendance_date = $row['attendance_date'];
                            $attendance_value = $row['attendance_value'];
                            if ($attendance_value == 1) {
                                $attendance_value = "Present";
                            } else if ($attendance_value == 2) {
                                $attendance_value = "Absent";
                            }
                        ?>
                    <tr>
                        <td scope="row"><?php echo $attendance_date ?></td>
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