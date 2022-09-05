<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header mt-3">
            <h3 class="section-heading">
                <ion-icon name="stopwatch" class="section-heading-icon"></ion-icon>
                Edit Offline Exam | Test
            </h3>
            <p class="section-desc">Caption required</p>
        </div>

        <?php
        if (isset($_POST['update'])) {
            $exam_title = $_POST['exam_title'];
            $exam_class_id = $_POST['exam_class_id'];
            $exam_type = $_POST['exam_type'];
            $exam_subject_id = $_POST['exam_subject_id'];
            $exam_start_date = $_POST['exam_start_date'];
            $exam_end_date = $_POST['exam_end_date'];
            $exam_file = "assets/docs/" . $_POST['exam_file'];
            $exam_added_by = $_POST['exam_added_by'];
            $exam_status = $_POST['exam_status'];
        }

        if (isset($_POST['edit'])) {
            $exam_id = $_POST['exam_id'];

            $fetch = "SELECT * FROM `exam` WHERE exam_id = $exam_id";
            $fetch_exam_query_res = mysqli_query($connection, $fetch);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
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


                    // =============== FILE EXTENSION START ===============
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
                    // =============== FILE EXTENSION END ===============

                    // =============== EXAM TYPE START ===============
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
                    // =============== EXAM TYPE END ===============

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

        <form action="" method="POST" enctype="multipart/form-data" class="card p-4 col-md-6">

            <div class="mb-3">
                <label for="examTitle" class="form-label">Exam | Test Title </label>
                <input type="text" class="form-control" id="examTitle" name="exam_title"
                    placeholder="<?php echo $exam_title ?>">
            </div>

            <div class="mb-3">
                <label for="examClass" class="form-label">Class</label>
                <select class="form-select" name="exam_class_id" aria-label="Default select example">
                    <option selected><?php echo $class ?></option>
                    <?php $get_subjects = "SELECT * FROM `classes` WHERE `class_added_by` = $user_added_by";
                                $get_result = mysqli_query($connection, $get_subjects);
                                while ($row = mysqli_fetch_assoc($get_result)) {
                                    $class_id = $row['class_id'];
                                    $class_name = $row['class_name'];
                                    $class_section = $row['class_section'];
                                ?>
                    <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?>
                        <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="examClass" class="form-label">Exam Type</label>
                <select class="form-select" name="exam_type" aria-label="Default select example">
                    <option selected><?php echo $exam_type_name ?></option>
                    <option value="1">Test</option>
                    <option value="2">Exam</option>
                    <option value="3">Half Yearly</option>
                    <option value="4">Quarterly</option>
                    <option value="5">Yearly Exam</option>
                </select>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="exam_subject_id" id="examSubject"
                    aria-label="Floating label select example">
                    <option selected><?php echo $subject ?></option>
                    <?php
                                $query = "SELECT * FROM users WHERE user_id = $session_user_id";
                                $result = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $user_added_by = $row['user_added_by'];
                                    $get_subjects = "SELECT * FROM `subjects` WHERE `subject_added_by` = $user_added_by";
                                    $get_result = mysqli_query($connection, $get_subjects);
                                    while ($row = mysqli_fetch_assoc($get_result)) {
                                        $subject_id = $row['subject_id'];
                                        $subject_name = $row['subject_name'];
                                ?>
                    <option value="<?php echo $subject_id ?>"><?php echo $subject_name ?>
                    </option>
                    <?php }
                                } ?>
                </select>
                <label for="examSubject">Click here to get subject list</label>
            </div>

            <div class="form-floating mb-3">
                <input type="date" name="exam_start_date" value="<?php echo $exam_start_date ?>" class="form-control"
                    placeholder="End Date">
                <label for="endDateInput">Exam Start Date</label>
            </div>
            <div class="form-check mb-3">
                <input onclick="readStatus()" name="exam_end_date_status" class="form-check-input" type="checkbox"
                    value="1" id="endDateCheckBox">
                <label class="form-check-label" for="endDateCheckBox">
                    Is there an end date?
                </label>
            </div>
            <div style="display: none;" class="form-floating mb-3" id="endDateInput">
                <input type="date" name="exam_end_date" value="<?php echo $exam_end_date ?>" class="form-control"
                    placeholder="End Date">
                <label for="endDateInput">End Date</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload File (.jpeg | .jpg | .png | .pdf | .word )</label>
                <input class="form-control" type="file" name="exam_file" id="formFile">
            </div>
            <div class="mb-3">
                <button type="submit" name="update" class="btn w-100 btn-success">Update</button>
            </div>
        </form>

        <?php
                }
            } else if ($count == 0) { ?>
        <div class="alert alert-danger" role="alert">
            No Data Found!
        </div>
        <?php
            }
        }
        ?>


    </div>
</div>
<?php include('main/footer.php'); ?>