<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header mt-3">
            <h3 class="section-heading">
                <ion-icon name="book" class="section-heading-icon"></ion-icon>
                Add Homework
            </h3>
            <p class="section-desc">Caption required</p>
        </div>

        <?php

        if (isset($_POST['add'])) {
            $hw_class = $_POST['hw_class'];
            $hw_title = mysqli_real_escape_string($connection, $_POST['hw_title']);
            $hw_details = mysqli_real_escape_string($connection, $_POST['hw_details']);
            $hw_subject = $_POST['hw_subject'];
            $hw_date = $_POST['hw_date'];

            $hw_file = $_FILES["hw_file"]["name"];
            $hw_file_temp = $_FILES["hw_file"]["tmp_name"];
            $folder = "assets/hw/" . $hw_file;

            $hw_status = 1;

            $insert_query = "INSERT INTO `home_work`(
                  `hw_class`,
                  `hw_title`,
                  `hw_details`,
                  `hw_subject`,
                  `hw_date`,
                  `hw_file`,
                  `hw_status`,
                  `hw_added_by`
              )
              VALUES(
                  '$hw_class',
                  '$hw_title',
                  '$hw_details',
                  '$hw_subject',
                  '$hw_date',
                  '$hw_file',
                  '$hw_status',
                  '$session_user_id'
              )";
            $insert_result = mysqli_query($connection, $insert_query);
            if (!$insert_result) {
                die(mysqli_error($connection));
            } else {
                if (move_uploaded_file($hw_file_temp, $folder)) {
                    echo "<div class='alert alert-success mb-3' role='alert'>$hw_title created successfully!</div>";
                } else {
                    echo "<div class='alert w-100 alert-danger mb-3' role='alert'>There was some error</div>";
                }
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data" class="card p-4 col-md-6">
            <div class="form-floating mb-3">
                <select class="form-select" name="hw_class" id="examSubject" aria-label="Floating label select example">
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
                <input type="text" class="form-control" name="hw_title" id="examName" placeholder="exam_name" required>
                <label for="examName">Homework Title </label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="hw_details" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Details</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="hw_subject" id="examSubject"
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
                <input type="date" name="hw_date" class="form-control" placeholder="End Date">
                <label for="endDateInput">Date</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload File (.jpeg | .jpg | .png | .pdf | .word )</label>
                <input class="form-control" type="file" name="hw_file" id="formFile">
            </div>
            <div class="mb-3">
                <button type="submit" name="add" class="btn w-100 btn-success">Create</button>
            </div>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>