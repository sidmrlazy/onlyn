<?php include('includes/header.php') ?>
<?php include('components/navbar/admin-navbar.php') ?>
<div class="container user-form-container">
    <div class="page-marker">
        <a href="course-settings.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Assign Fee</h5>
    </div>

    <?php
    require('includes/connection.php');
    if (isset($_POST['update_semester'])) {
        $course_id = $_POST['course_id'];

        $fetch_data = "SELECT * FROM `bora_course` WHERE `course_id` = '$course_id'";
        $fetch_res = mysqli_query($connection, $fetch_data);
        $course_id = "";
        $course_name = "";
        $course_tenure = "";

        while ($row = mysqli_fetch_assoc($fetch_res)) {
            $course_id = $row['course_id'];
            $course_name = $row['course_name'];
            $course_tenure = $row['course_tenure'];
        }
    }
    ?>

    <form class="add-user-form" method="POST" action="update-semester-name.php">
        <input type="text" name="course_id" value="<?php echo $course_id ?>" hidden>
        <div class="mb-3">
            <label for="courseName" class="form-label">Course Name</label>
            <input type="text" placeholder="<?php echo $course_name ?>" class="form-control" disabled id="courseName" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="courseTenure" class="form-label">Course Tenure (in Years)</label>
            <input type="text" class="form-control" placeholder="<?php echo $course_tenure ?>" disabled id="courseName" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="courseSem" class="form-label">Semesters Name</label>
            <input type="text" class="form-control" name="course_semester_name" id="courseSem">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update Course Fee</button>
    </form>
</div>
</div>

<?php include('includes/footer.php') ?>