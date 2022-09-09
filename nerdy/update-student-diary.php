<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="book" id="flourescent-green" class="section-heading-icon"></ion-icon>
                Update Student Diary
            </h3>
            <p class="section-desc">Enter details below to update student diary</p>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $diary_student_id = $_POST['diary_student_id'];
            $diary_topic = $_POST['diary_topic'];
            $diary_details = mysqli_real_escape_string($connection, $_POST['diary_details']);
            $session_user_id;

            $query = "INSERT INTO `student_diary`(
                    `diary_student_id`,
                    `diary_topic`,
                    `diary_details`,
                    `diary_added_by`
                )
                VALUES(
                    '$diary_student_id',
                    '$diary_topic',
                    '$diary_details',
                    '$session_user_id'
                )";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("<div class='col-md-6 mb-3 alert alert-danger' role='alert'>Error!</div>" . " " . mysqli_error($connection));
            } else {
                echo "<div class='col-md-6 mb-3 alert alert-success' role='alert'>Diary Updated! <a href='class-teacher-student-diary-menu.php'>Click here </a> to go back. </div>";
            }
        }
        ?>

        <form action="" method="POST">
            <div class="card col-md-6 p-4">
                <div class="form-floating mb-3 show">
                    <select name="diary_student_id" class="form-select" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option>Select Student</option>
                        <?php
                        $get_students_list = "SELECT * FROM students WHERE student_added_by = $session_user_id";
                        $get_student_list_result = mysqli_query($connection, $get_students_list);

                        while ($row = mysqli_fetch_assoc($get_student_list_result)) {
                            $student_id = $row['student_id'];
                            $student_name = $row['student_name'];
                        ?>
                        <option value="<?php echo $student_id ?>"><?php echo $student_name ?></option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelect">Click here to open options</label>
                </div>

                <div class="form-floating mb-3">
                    <input name="diary_topic" type="text" class="form-control" id="diaryTopic" placeholder="Topic">
                    <label for="diaryTopic">Topic</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="diary_details" class="form-control" placeholder="Leave a comment here"
                        id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Diary Content</label>
                </div>
            </div>

            <button type="submit" name="submit" class="col-md-6 btn btn-outline-success mt-3">Update
                Diary</button>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>