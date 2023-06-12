<?php include('includes/header.php') ?>
<?php include('components/navbar/admin-navbar.php') ?>

<div class="container user-form-container">
    <div class="page-marker">
        <a href="index.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Add Semester</h5>
    </div>
    <?php
    require('includes/connection.php');
    if (isset($_COOKIE['user_id'])) {
        $user_contact = $_COOKIE['user_id'];
        $fetch_data = "SELECT * FROM `bora_users` WHERE `user_contact` = '$user_contact'";
        $fetch_res = mysqli_query($connection, $fetch_data);
        $user_name = "";
        while ($row = mysqli_fetch_assoc($fetch_res)) {
            $user_name = $row['user_name'];
        }
    }

    if (isset($_POST['submit'])) {
        $semester_course_id = $_POST['semester_course_id'];
        $semester_name = $_POST['semester_name'];
        $semester_fee = $_POST['semester_fee'];

        $query = "INSERT INTO `bora_semester`(
        `semester_course_id`,
        `semester_name`,
        `semester_fee`,
        `semester_added_by`
    )
    VALUES(
        '$semester_course_id',
        '$semester_name',
        '$semester_fee',
        '$user_name'
    )";
        $result = mysqli_query($connection, $query);

        if ($result) { ?>
    <div class="w-100 mb-3 mt-3 alert alert-success" role="alert">
        Semester Added
    </div>
    <?php
        }
    }
    ?>
    <form class="add-user-form" method="POST" action="">
        <div class="mb-3">
            <label for="courseTenure" class="form-label">Select Course </label>
            <select class="form-select" name="semester_course_id" aria-label="Default select example">
                <option selected>Click here to open options</option>
                <?php
                require('includes/connection.php');
                $fetch_course = "SELECT * FROM `bora_course`";
                $fetch_course_res = mysqli_query($connection, $fetch_course);

                while ($row = mysqli_fetch_assoc($fetch_course_res)) {
                    $course_id = $row['course_id'];
                    $course_name = $row['course_name'];
                ?>
                <option value="<?php echo $course_id ?>"><?php echo $course_name ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="courseName" class="form-label">Semester Name</label>
            <input type="text" name="semester_name" required class="form-control" id="courseName"
                aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="courseName" class="form-label">Semester Fee</label>
            <input type="number" name="semester_fee" required class="form-control" id="courseName"
                aria-describedby="emailHelp">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Semester</button>
    </form>
</div>
<?php include('includes/footer.php') ?>