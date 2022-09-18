<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header mt-3">
            <h3 class="section-heading">
                <ion-icon name="stopwatch" class="section-heading-icon"></ion-icon>
                Upload Offline Exam | Test
            </h3>
            <p class="section-desc">Caption required</p>
        </div>

        <?php
        if (isset($_POST['create'])) {
            $exam_name = mysqli_real_escape_string($connection, $_POST['exam_title']);
            $exam_instructions = mysqli_real_escape_string($connection, $_POST['exam_instructions']);
            $exam_class_id = $_POST['exam_class_id'];
            $exam_type = $_POST['exam_type'];
            $exam_subject_id = $_POST['exam_subject_id'];
            $exam_start_date = $_POST['exam_start_date'];
            $exam_end_date = $_POST['exam_end_date'];
            $exam_added_by = $session_user_id;

            if ($exam_end_date == null) {
                $exam_end_date = 0;
            }
            $exam_status = 1;

            $exam_file = $_FILES["exam_file"]["name"];
            $exam_file_temp = $_FILES["exam_file"]["tmp_name"];
            $folder = "assets/docs/" . $exam_file;

            $insert_query = "INSERT INTO `exam`(
                    `exam_title`,
                    `exam_instructions`,
                    `exam_class_id`,
                    `exam_type`,
                    `exam_subject_id`,
                    `exam_start_date`,
                    `exam_end_date`,
                    `exam_file`,
                    `exam_added_by`,
                    `exam_status`
                )
                VALUES(
                    '$exam_name',
                    '$exam_instructions',
                    '$exam_class_id',
                    '$exam_type',
                    '$exam_subject_id',
                    '$exam_start_date',
                    '$exam_end_date',
                    '$exam_file',
                    '$exam_added_by',
                    '$exam_status'
                )";
            $insert_result = mysqli_query($connection, $insert_query);
            if (!$insert_result) {
                die(mysqli_error($connection));
            } else {
                if (move_uploaded_file($exam_file_temp, $folder)) {
                    echo "<div class='alert alert-success mb-3' role='alert'>$exam_name created successfully!</div>";
                } else {
                    echo "<div class='alert w-100 alert-danger mb-3' role='alert'>There was some error</div>";
                }
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data" class="card p-4 col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="exam_title" id="examName" placeholder="exam_name"
                    required>
                <label for="examName">Exam | Test Title </label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="exam_instructions" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Instructions</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="exam_class_id" id="examSubject"
                    aria-label="Floating label select example">
                    <option selected>For Class</option>
                    <?php
                    $query = "SELECT * FROM users WHERE user_id = $session_user_id";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_added_by = $row['user_added_by'];
                        $get_subjects = "SELECT * FROM `classes` WHERE `class_added_by` = $user_added_by";
                        $get_result = mysqli_query($connection, $get_subjects);
                        while ($row = mysqli_fetch_assoc($get_result)) {
                            $class_id = $row['class_id'];
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];
                    ?>
                    <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?>
                    </option>
                    <?php }
                    } ?>
                </select>
                <label for="examSubject">Click here to get class list</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="exam_type" id="examType" aria-label="Floating label select example">
                    <option selected>Exam Type</option>
                    <option value="1">Test</option>
                    <option value="2">Exam</option>
                    <option value="3">Half Yearly</option>
                    <option value="4">Quarterly</option>
                    <option value="5">Yearly Exam</option>
                </select>
                <label for="examType">Click here to open exam type list</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="exam_subject_id" id="examSubject"
                    aria-label="Floating label select example">
                    <option selected>Select Subject</option>
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
                <input type="date" name="exam_start_date" class="form-control" placeholder="End Date">
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
                <input type="date" name="exam_end_date" class="form-control" placeholder="End Date">
                <label for="endDateInput">End Date</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload File (.jpeg | .jpg | .png | .pdf | .word )</label>
                <input class="form-control" type="file" name="exam_file" id="formFile">
            </div>
            <div class="mb-3">
                <button type="submit" name="create" class="btn w-100 btn-success">Create</button>
            </div>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>