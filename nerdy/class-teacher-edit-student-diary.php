<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="newspaper" id="dark-blue-icon" class="section-heading-icon"></ion-icon>
                Edit Student Diary
            </h3>
            <p class="section-desc">Edit or Delete student diary details</p>
        </div>

        <?php

        if (isset($_POST['delete'])) {
            $diary_id = $_POST['diary_id'];

            $delete = "DELETE FROM `student_diary` WHERE diary_id = $diary_id";
            $res = mysqli_query($connection, $delete);

            if (!$res) {
                die("<div class='col-md-6 mb-3 alert alert-danger' role='alert'>Error!</div>" . " " . mysqli_error($connection));
            } else {
                echo "<div class='col-md-6 mb-3 alert alert-success' role='alert'>Diary Content Deleted! <a href='class-teacher-student-diary-menu.php'>Click here </a> to go back. </div>";
            }
        }

        $query = "SELECT * FROM student_diary WHERE diary_added_by = $session_user_id ORDER BY diary_id DESC";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $diary_id = $row['diary_id'];
                $diary_student_id = $row['diary_student_id'];
                $diary_topic = $row['diary_topic'];
                $diary_details = $row['diary_details'];
                $diary_added_date = $row['diary_added_date'];

                if ($diary_student_id == 0) {
                    $student_name = "Sent to all students";
                } else if ($diary_student_id != 0) {
                    $student = "SELECT * FROM `students` WHERE `student_id` = $diary_student_id";
                    $res = mysqli_query($connection, $student);
                    $student_name = "";
                    while ($row = mysqli_fetch_assoc($res)) {
                        $student_name = $row['student_name'];
                    }
                }

        ?>
        <div class="diary-card diary-row p-1">
            <div class="col-md-10">
                <div class="diary-section">
                    <p class="diary-label">Sent to</p>
                    <p class="m-0"><?php echo $student_name ?></p>
                </div>

                <div class="diary-section">
                    <p class="diary-label">Topic</p>
                    <p class="m-0"><?php echo $diary_topic ?></p>
                </div>
                <div class="diary-section">
                    <p class="diary-label">Content</p>
                    <p class="m-0"><?php echo $diary_details ?></p>
                    <p class="diary-label mt-3"><?php echo $diary_added_date ?></p>
                </div>
            </div>
            <form action="" method="POST" class="diary-btn-holder">
                <input type="text" name="diary_id" value="<?php echo $diary_id ?>" hidden>
                <button type="submit" name="delete" class="diary-btn">
                    <ion-icon name="trash-outline"></ion-icon>
                </button>
            </form>
        </div>
        <?php

            }
        } else if ($count == 0) {
            echo "<div class='col-md-6 mb-3 alert alert-danger' role='alert'>No Diary Data Found!</div>";
        }
        ?>
        <div>

        </div>

    </div>
</div>
<?php include('main/footer.php'); ?>