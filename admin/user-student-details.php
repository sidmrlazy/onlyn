<?php include('includes/header.php') ?>
<?php include('components/navbar/user-navbar.php') ?>
<div class="container user-form-container">
    <div class="page-marker">
        <a href="user-view-students.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>View Student Details</h5>
    </div>
    <div class="container-row">
        <?php
        require('includes/connection.php');

        if (isset($_POST['update'])) {
            $student_id = $_POST['student_id'];
            $student_name = mysqli_real_escape_string($connection, $_POST['student_name']);
            $student_contact = mysqli_real_escape_string($connection, $_POST['student_contact']);
            $student_father = mysqli_real_escape_string($connection, $_POST['student_father']);
            $student_mother = mysqli_real_escape_string($connection, $_POST['student_mother']);
            $student_roll = mysqli_real_escape_string($connection, $_POST['student_roll']);
            $student_course = mysqli_real_escape_string($connection, $_POST['student_course']);
            $student_admission_date = mysqli_real_escape_string($connection, $_POST['student_admission_date']);
            $student_aadhar_number = mysqli_real_escape_string($connection, $_POST['student_aadhar_number']);
            $student_aadhar_address = mysqli_real_escape_string($connection, $_POST['student_aadhar_address']);
            $student_comm_address = mysqli_real_escape_string($connection, $_POST['student_comm_address']);

            if (empty($student_comm_address)) {
                $student_comm_address = "Same as Aadhar Address";
            }

            $update_query = "UPDATE
                `bora_student`
            SET
                `student_name` = '$student_name',
                `student_contact` = '$student_contact',
                `student_father` = '$student_father',
                `student_mother` = '$student_mother',
                `student_roll` = '$student_roll',
                `student_course` = '$student_course',
                `student_admission_date` = '$student_admission_date',
                `student_aadhar_number` = '$student_aadhar_number',
                `student_aadhar_address` = '$student_aadhar_address',
                `student_comm_address` = '$student_comm_address'
            WHERE
                `student_id` = '$student_id'";

            $update_res = mysqli_query($connection, $update_query);

            if ($update_res) {
        ?>
                <div class="alert alert-primary" role="alert">
                    Student details updated!
                </div>
        <?php

            }
        }

        if (isset($_POST)) {
            $student_id = $_POST['student_id'];

            $fetch = "SELECT * FROM `bora_student` WHERE `student_id` = '$student_id'";
            $result = mysqli_query($connection, $fetch);

            $student_id = "";
            $student_img = "";
            $student_name = "";
            $student_contact = "";
            $student_father = "";
            $student_mother = "";
            $student_roll = "";
            $student_course = "";
            $student_admission_date = "";
            $student_aadhar_number = "";
            $student_aadhar_file = "";
            $student_aadhar_back_file = "";
            $student_aadhar_address = "";
            $student_comm_address = "";

            while ($row = mysqli_fetch_assoc($result)) {
                $student_id = $row['student_id'];
                $student_img = "assets/student/" . $row['student_img'];
                $student_name = $row['student_name'];
                $student_contact = $row['student_contact'];
                $student_father = $row['student_father'];
                $student_mother = $row['student_mother'];
                $student_roll = $row['student_roll'];
                $student_course = $row['student_course'];
                $student_admission_date = $row['student_admission_date'];
                $student_aadhar_number = $row['student_aadhar_number'];
                $student_aadhar_file = "assets/student_aadhar_image" . $row['student_aadhar_file'];
                $student_aadhar_back_file = "assets/student_aadhar_image" . $row['student_aadhar_back_file'];
                $student_aadhar_address = $row['student_aadhar_address'];
                $student_comm_address = $row['student_comm_address'];
            }
        }
        ?>
        <form class="add-user-form col-md-10 m-1" method="POST" action="" enctype="multipart/form-data">
            <input class="form-control" name="student_id" hidden type="text" value="<?php echo $student_id ?>" id="formFile">

            <div class="add-user-form-row mb-3">
                <div class="col-md-6 mobile-input m-1">
                    <label for="studentName" class="form-label">Student Name</label>
                    <input type="text" class="form-control" name="student_name" value="<?php echo $student_name ?>" id="studentName" aria-describedby="emailHelp">
                </div>
                <div class="col-md-6 mobile-input m-1">
                    <label for="studentNumber" class="form-label">Student's Mobile Number</label>
                    <input type="number" class="form-control" name="student_contact" value="<?php echo $student_contact ?>" id="studentNumber" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="add-user-form-row mb-3">
                <div class="col-md-6 mobile-input m-1">
                    <label for="fathersName" class="form-label">Father's Name</label>
                    <input type="text" class="form-control" name="student_father" value="<?php echo $student_father ?>" id="fathersName" aria-describedby="emailHelp">
                </div>
                <div class="col-md-6 mobile-input m-1">
                    <label for="mothersName" class="form-label">Mother's Name</label>
                    <input type="text" class="form-control" name="student_mother" id="mothersName" value="<?php echo $student_mother ?>" aria-describedby="emailHelp">
                </div>
            </div>

            <div class="add-user-form-row mb-3">
                <div class="col-md-4 mobile-input m-1">
                    <label for="studentName" class="form-label">Roll Number</label>
                    <input type="text" class="form-control" value="<?php echo $student_roll ?>" name="student_roll" id="studentName" aria-describedby="emailHelp">
                </div>
                <div class="col-md-4 mobile-input m-1">
                    <label for="studentNumber" class="form-label">Selected Course</label>
                    <select class="form-select" name="student_course" aria-label="Default select example">
                        <option value="<?php echo $student_course  ?>"><?php echo $student_course . " (Selected)" ?>
                        </option>
                        <?php
                        require('includes/connection.php');
                        $fetch_course_name = "SELECT * FROM `bora_course` WHERE `course_status` = '1'";
                        $fetch_course_res = mysqli_query($connection, $fetch_course_name);

                        while ($row = mysqli_fetch_assoc($fetch_course_res)) {
                            $course_id = $row['course_id'];
                            $course_name = $row['course_name'];
                        ?>
                            <option value="<?php echo $course_name ?>"><?php echo $course_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4 mobile-input m-1">
                    <label for="studentAdmissionDate" class="form-label">Admission Date</label>
                    <input type="date" class="form-control" name="student_admission_date" value="<?php echo $student_admission_date  ?>" id="studentAdmissionDate" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="mb-3 w-100">
                <div class="col-md-4 mobile-input m-1">
                    <label for="fathersName" class="form-label">Aadhar Card Number</label>
                    <input type="number" class="form-control w-100" value="<?php echo $student_aadhar_number  ?>" name="student_aadhar_number" id="fathersName" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Address (as on Aadhar Card)*</label>
                <input style="height: 100px" type="text" class="form-control" name="student_aadhar_address" id="mothersName" value="<?php echo $student_aadhar_address ?>" aria-describedby="emailHelp">
            </div>
            <div class="form-check mb-3" onclick="hideInputField()">
                <input class="form-check-input" type="checkbox" value="1" id="addressCheckBox">
                <label class="form-check-label" for="addressCheckBox">
                    Same as above
                </label>
            </div>
            <div class="mb-3" id="communicationAddress">
                <label for="exampleFormControlTextarea1" class="form-label">Communication Address</label>
                <input style="height: 100px" type="text" class="form-control" name="student_comm_address" id="mothersName" value="<?php echo $student_comm_address ?>" aria-describedby="emailHelp">
            </div>
            <button type="submit" name="update" class="w-100 btn btn-outline-primary">Update Student Details</button>
        </form>

        <div class="col-md-3 m-1">
            <div class="student-right-img">
                <img src="<?php echo $student_img  ?>" alt="">
            </div>
            <form method="POST" action="" class="add-user-form-tab">
                <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
                <button type="submit" name="view" class="student-doc-btn">
                    Upload | Change Profile Picture
                </button>
            </form>
            <form method="POST" action="view-student-document.php" class="add-user-form-tab">
                <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
                <button type="submit" name="view" class="student-doc-btn">
                    Upload | View Aadhar Image
                </button>
            </form>
            <form method="POST" action="" class="add-user-form-tab">
                <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
                <button type="submit" name="view" class="student-doc-btn">
                    Upload | View 12th Marksheet
                </button>
            </form>
            <form method="POST" action="" class="add-user-form-tab">
                <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
                <button type="submit" name="view" class="student-doc-btn">
                    Upload | View Transfer Certificate
                </button>
            </form>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>