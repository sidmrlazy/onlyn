<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header section-heading-row">
            <div class="section-flex">
                <h3 class="section-heading">
                    <ion-icon name="ribbon" class="section-heading-icon"></ion-icon>
                    Upload Result
                </h3>
                <p class="section-desc">Caption required</p>
            </div>
        </div>


        <?php
        if (isset($_POST['update'])) {
            $exam_id = $_POST['exam_id'];
            $exam_status = 2;

            $update = "UPDATE `exam` SET `exam_status`= $exam_status WHERE exam_id = $exam_id";
            $update_res = mysqli_query($connection, $update);

            if (!$update_res) {
                echo "<div class='alert alert-danger mb-3' role='alert'>Error!</div>";
            } else {
                echo "<div class='alert alert-success mb-3' role='alert'>Exam Completed</div>";
            }
        }

        if (isset($_POST['submit'])) {
            echo "Submit";
        }

        if (isset($_POST['mark'])) {
            $exam_id = $_POST['exam_id'];

            $fetch_exam_query = "SELECT * FROM `exam` WHERE `exam_id` = '$exam_id'";
            $fetch_exam_query_res = mysqli_query($connection, $fetch_exam_query);

            while ($row = mysqli_fetch_assoc($fetch_exam_query_res)) {
                $exam_id = $row['exam_id'];
                $exam_title = $row['exam_title'];
                $exam_class_id = $row['exam_class_id'];
                $exam_type = $row['exam_type'];
                $exam_subject_id = $row['exam_subject_id'];
                $exam_start_date = $row['exam_start_date'];
                $exam_end_date = $row['exam_end_date'];
                $exam_file = "assets/docs/" . $row['exam_file'];
                $exam_added_by = $row['exam_added_by'];
                $exam_status = $row['exam_status'];

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

                $get_class = "SELECT * FROM `classes` WHERE `class_id` = '$exam_class_id'";
                $get_class_res = mysqli_query($connection, $get_class);

                $class_id = "";
                while ($row = mysqli_fetch_assoc($get_class_res)) {
                    $class_id = $row['class_id'];
                    $class_name = $row['class_name'];
                    $class_section = $row['class_section'];

                    if ($exam_class_id == $class_id) {
                        $class = $class_name . $class_section;
                    }

                    $get_subject = "SELECT * FROM `subjects` WHERE `subject_id` = '$exam_subject_id'";
                    $get_subject_res = mysqli_query($connection, $get_subject);

                    while ($row = mysqli_fetch_assoc($get_subject_res)) {
                        $subject_id = $row['subject_id'];
                        $subject_name = $row['subject_name'];

                        if ($exam_subject_id == $subject_id) {
                            $subject = $subject_name;
                        }
                    }
                } ?>
        <form action="" method="POST" class="result-data">
            <input type="text" name="exam_id" value="<?php echo $exam_id ?>" hidden>
            <div class="exam-section">
                <p class="exam-section-label">Exam Title</p>
                <p class="exam-title"><?php echo $exam_title ?></p>
            </div>

            <div class="exam-section">
                <p class="exam-section-label">Class</p>
                <p><?php echo $class ?></p>
            </div>

            <div class="exam-section">
                <p class="exam-section-label">Type</p>
                <p><?php echo $exam_type_name ?></p>
            </div>

            <div class="exam-section">
                <p class="exam-section-label">Subject</p>
                <p><?php echo $subject ?></p>
            </div>

            <div class="exam-section">
                <p class="exam-section-label">Start Date</p>
                <p><?php echo date('d-M-Y', strtotime($exam_start_date)) ?></p>
            </div>

            <div>
                <p class="exam-section-label">End Date</p>
                <p><?php echo date('d-M-Y', strtotime($exam_end_date)) ?></p>
            </div>


            <a class="exam-section-file" target="_blank" href="<?php echo $exam_file ?>"><?php echo $exam_file ?>
                <p class="exam-section-label">Download</p>
                <img src="<?php echo $exam_file_ext_img ?>" alt="">
            </a>

            <div>
                <button type="submit" name="update" class="btn btn-sm btn-outline-primary">Mark as Complete</button>
            </div>

        </form>
        <?php }
            $get_students = "SELECT * FROM students WHERE student_assigned_class = $class_id";
            $get_students_res = mysqli_query($connection, $get_students);

            while ($row = mysqli_fetch_assoc($get_students_res)) {
                $student_id = $row['student_id'];
                $student_roll_number = $row['student_roll_number'];
                $student_name = $row['student_name'];
            ?>
        <form action="" method="POST" class="student-result-section ">
            <p class="student-name"><?php echo $student_name ?></p>

            <div class="form-floating student-marks-section col-md-3">
                <input type="number" class="form-control" id="marksObtained" placeholder="XXX">
                <label for="marksObtained">Marks Obtained</label>
            </div>

            <div class="form-floating student-marks-section col-md-3">
                <input type="number" class="form-control student-marks-section" id="outOf" placeholder="XXX">
                <label for="outOf">Out Of</label>
            </div>

            <div class="form-floating col-md-3">
                <button type="submit" name="submit" class="btn btn-outline-success">Submit</button>
            </div>

        </form>
        <?php }
        } ?>

    </div>
</div>
<?php include('main/footer.php'); ?>