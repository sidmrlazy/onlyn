<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn w-100">
        <?php
        if (isset($_POST['continue'])) {
            $exam_id = $_POST['exam_id'];

            $fetch_user = "SELECT * FROM `users` WHERE `user_id` = $session_user_id";
            $fetch_user_res = mysqli_query($connection, $fetch_user);

            $user_contact = "";
            while ($row = mysqli_fetch_assoc($fetch_user_res)) {
                $user_contact = $row['user_contact'];
            }

            $fetch_student = "SELECT * FROM `students` WHERE `student_father_contact` = '$user_contact'";
            $fetch_student_res = mysqli_query($connection, $fetch_student);

            $student_id = "";
            $student_assigned_class = "";
            while ($row = mysqli_fetch_assoc($fetch_student_res)) {
                $student_id = $row['student_id'];
                $student_assigned_class = $row['student_assigned_class'];
            }

            $data = "SELECT * FROM `exam` WHERE `exam_id` = '$exam_id'";
            $data_res = mysqli_query($connection, $data);

            $fetch = "SELECT * FROM `exam_result` WHERE `exam_result_exam_id` = '$exam_id' AND `exam_result_student_id` = '$student_id'";
            $result = mysqli_query($connection, $fetch);
            $count = mysqli_num_rows($result);

            if ($count == 0) { ?>
        <div class="alert alert-danger" role="alert">
            No marks allotted yet!
        </div>
        <?php } else if ($count > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $obt = $row['exam_result_obt'];
                    $out_of = $row['exam_result_out_of']; ?>
        <div class="student-result-view">
            <p>You have received <?php echo $obt ?> out of <?php echo $out_of ?> for this exam!</p>
        </div>
        <?php
                }
            }
        }
        ?>

    </div>
</div>
<?php include('main/footer.php'); ?>