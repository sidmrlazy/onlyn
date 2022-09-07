<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn w-100">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Select Exam
            </h3>
            <p class="section-desc">Caption Required</p>
        </div>
        <form action="student-view-exam-3.php" method="POST" class="card p-3 col-md-6">
            <div class="form-floating mb-3">
                <select class="form-select" name="exam_id" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option selected>Select Exam</option>
                    <?php
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

                    $fetch_exam = "SELECT * FROM `exam` WHERE `exam_class_id` = '$student_assigned_class'";
                    $fetch_exam_res = mysqli_query($connection, $fetch_exam);

                    while ($row = mysqli_fetch_assoc($fetch_exam_res)) {
                        $exam_id = $row['exam_id'];
                        $exam_title = $row['exam_title'];

                        // $fetch_exam_ans = "SELECT * FROM `exam_answer` WHERE `ea_exam_id` = '$exam_id'";
                        // $fetch_exam_ans_res = mysqli_query($connection, $fetch_exam_ans);

                        // while ($row = mysqli_fetch_assoc($fetch_exam_ans_res)) {
                        //     $ea_exam_id = $row['ea_exam_id'];
                        //     $ea_student_id = $row['ea_student_id'];
                        //     $ea_status = $row['ea_status'];


                        //     if ($ea_exam_id == $exam_id && $ea_student_id == $student_id && $ea_status = 2) { 
                    ?>
                    <option value="<?php echo $exam_id ?>"><?php echo $exam_title ?></option>


                    <?php

                    } ?>
                </select>
                <label for="floatingSelect">Click here to get exam | test list</label>
            </div>

            <div class="mb-3">
                <button type="submit" name="continue" class="w-100 btn btn-outline-success">Continue</button>
            </div>
        </form>

    </div>
</div>
<?php include('main/footer.php'); ?>