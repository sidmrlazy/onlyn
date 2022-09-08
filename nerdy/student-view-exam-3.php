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
        <?php
        if (isset($_POST['submit'])) {
            $ea_exam_id = $_POST['ea_exam_id'];
            $ea_student_id = $_POST['ea_student_id'];
            $ea_file = $_FILES["ea_file"]["name"];
            $ea_file_temp = $_FILES["ea_file"]["tmp_name"];
            $folder = "assets/ans/" . $ea_file;
            $ea_status = 1;

            $insert = "INSERT INTO `exam_answer`(
                `ea_student_id`,
                `ea_exam_id`,
                `ea_file`,
                `ea_status`
            )
            VALUES(
                '$ea_student_id',
                '$ea_exam_id',
                '$ea_file',
                '$ea_status'
            )";
            $insert_res = mysqli_query($connection, $insert);

            if (!$result) {
                die(mysqli_error($connection));
            } else {
                if (move_uploaded_file($ea_file_temp, $folder)) {
                    echo "<div class='alert w-100 alert-success' role='alert'>Answer uploaded!</div>";
                } else {
                    echo "<div class='alert w-100 alert-danger' role='alert'>Error</div>";
                }
            }
        }

        if (isset($_POST['continue'])) {
            $exam_id = $_POST['exam_id'];

            $fetch_exam = "SELECT * FROM `exam` WHERE `exam_id` = '$exam_id'";
            $fetch_exam_res = mysqli_query($connection, $fetch_exam);

            while ($row = mysqli_fetch_assoc($fetch_exam_res)) {
                $exam_id = $row['exam_id'];
                $exam_title = $row['exam_title'];
                $exam_instructions = $row['exam_instructions'];
                $exam_type = $row['exam_type'];
                $exam_subject_id = $row['exam_subject_id'];
                $exam_start_date = $row['exam_start_date'];
                $exam_end_date = $row['exam_end_date'];
                $exam_file = "assets/docs/" . $row['exam_file'];

                $exam_file_ext = pathinfo($exam_file, PATHINFO_EXTENSION);

                if ($exam_file_ext == "pdf") {
                    $exam_file_ext_img = "assets/images/icons/pdf_logo.png";
                }
                if ($exam_file_ext == "docx") {
                    $exam_file_ext_img = "assets/images/icons/word_logo.webp";
                }
                if ($exam_file_ext == "xlsx") {
                    $exam_file_ext_img = "assets/images/icons/excel_logo.png";
                }

                if ($exam_file_ext == "pptx") {
                    $exam_file_ext_img = "assets/images/icons/powerpoint_logo.webp";
                }

                if ($exam_type == 1) {
                    $exam_type_name = "Test";
                }
                if ($exam_type == 2) {
                    $exam_type_name = "Exam";
                }
                if ($exam_type == 3) {
                    $exam_type_name = "Half Yearly";
                }
                if ($exam_type == 4) {
                    $exam_type_name = "Quarterly";
                }
                if ($exam_type == 5) {
                    $exam_type_name = "Yearly Exam";
                }

                $fetch_subjects = "SELECT * FROM `subjects` WHERE `subject_id` = '$exam_subject_id'";
                $fetch_subjects_res = mysqli_query($connection, $fetch_subjects);

                $subject_name = "";
                while ($row = mysqli_fetch_assoc($fetch_subjects_res)) {
                    $subject_name = $row['subject_name'];
                }

                $fetch_user_details = "SELECT * FROM users WHERE user_id = $session_user_id";
                $fetch_user_res = mysqli_query($connection, $fetch_user_details);

                $user_contact = "";
                while ($row = mysqli_fetch_assoc($fetch_user_res)) {
                    $user_contact = $row['user_contact'];
                }

                $fetch_student_details = "SELECT * FROM `students` WHERE student_father_contact = '$user_contact'";
                $fetch_student_res = mysqli_query($connection, $fetch_student_details);

                $student_id = "";
                while ($row = mysqli_fetch_assoc($fetch_student_res)) {
                    $student_id = $row['student_id'];
                }

        ?>
        <div class="result-data">
            <div class="exam-section-desc">
                <p class="exam-section-label">Exam Title</p>
                <p class="exam-title"><?php echo $exam_title ?></p>
                <p class="exam-instructions"><?php echo $exam_instructions ?></p>
            </div>

            <div class="exam-section">
                <p class="exam-section-label">Type</p>
                <p><?php echo $exam_type_name ?></p>
            </div>

            <div class="exam-section">
                <p class="exam-section-label">Subject</p>
                <p><?php echo $subject_name ?></p>
            </div>

            <div class="exam-section">
                <p class="exam-section-label">Start Date</p>
                <p><?php echo date('d-M-Y', strtotime($exam_start_date)) ?></p>
            </div>

            <div>
                <p class="exam-section-label">End Date</p>
                <?php if ($exam_end_date == 0) { ?>
                <p>No end date</p>
                <?php } else { ?>
                <p><?php echo date('d-M-Y', strtotime($exam_end_date)) ?></p>
                <?php } ?>
            </div>


            <a class="exam-section-file" target="_blank" href="<?php echo $exam_file ?>"><?php echo $exam_file ?>
                <p class="exam-section-label">Download</p>
                <img src="<?php echo $exam_file_ext_img ?>" alt="">
            </a>
        </div>
        <?php
            }
            $data = "SELECT * FROM `exam_answer` WHERE `ea_exam_id` = '$exam_id' AND `ea_student_id` = '$student_id'";
            $data_res = mysqli_query($connection, $data);

            $ea_student_id = "";
            $ea_status = "";
            while ($row = mysqli_fetch_assoc($data_res)) {
                $ea_student_id = $row['ea_student_id'];
                $ea_status = $row['ea_status'];
            }

            if ($ea_status == 1 && $ea_student_id === $student_id) { ?>

        <div class="alert alert-info" role="alert">
            You have already submitted your answer
        </div>
        <form action="" enctype="multipart/form-data" method="POST" class="d-none card p-3 col-md-6">
            <input type="text" name="ea_exam_id" value="<?php echo $exam_id ?>" hidden>
            <input type="text" name="ea_student_id" value="<?php echo $student_id ?>" hidden>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Upload Answer (.jpg | .word | .pdf | .xlsx |
                    .png)</label>
                <input type="file" name="ea_file" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <button type="submit" name="submit" class="w-100 btn btn-outline-success">Submit</button>
            </div>
        </form>

        <?php } else if ($ea_status == 2 && $ea_student_id === $student_id) { ?>

        <div class="alert alert-info" role="alert">
            You have already submitted your answer
        </div>
        <form action="" enctype="multipart/form-data" method="POST" class="d-none card p-3 col-md-6">
            <input type="text" name="ea_exam_id" value="<?php echo $exam_id ?>" hidden>
            <input type="text" name="ea_student_id" value="<?php echo $student_id ?>" hidden>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Upload Answer (.jpg | .word | .pdf | .xlsx |
                    .png)</label>
                <input type="file" name="ea_file" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <button type="submit" name="submit" class="w-100 btn btn-outline-success">Submit</button>
            </div>
        </form>

        <?php } else { ?>
        <p>Upload Answer Document</p>
        <form action="" enctype="multipart/form-data" method="POST" class="card p-3 col-md-6">
            <input type="text" name="ea_exam_id" value="<?php echo $exam_id ?>" hidden>
            <input type="text" name="ea_student_id" value="<?php echo $student_id ?>" hidden>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Upload Answer (.jpg | .word | .pdf | .xlsx |
                    .png)</label>
                <input type="file" name="ea_file" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <button type="submit" name="submit" class="w-100 btn btn-outline-success">Submit</button>
            </div>
        </form>

        <?php }
        } ?>

    </div>
</div>
<?php include('main/footer.php'); ?>