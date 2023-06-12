<div class="container user-form-container">
    <div class="page-marker-row">
        <div class="page-marker">
            <a href="index.php">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </a>
            <h5>Add Student</h5>
        </div>

        <a href="bulk-upload-student-data.php" class="page-marker-anchor">
            <ion-icon name="cloud-upload-outline"></ion-icon> Bulk Upload Student Data
        </a>
    </div>
    <form class="add-user-form" method="POST" action="add-student-success.php" enctype="multipart/form-data">
        <div class="form-check mb-3">
            <label for="formFile" class="form-label">Upload Student Image</label>
            <input class="form-control" name="student_img" type="file" id="formFile">
        </div>
        <div class="add-user-form-row mb-3">
            <div class="col-md-6 mobile-input m-1">
                <label for="studentName" class="form-label">Student Name</label>
                <input type="text" class="form-control" name="student_name" id="studentName" aria-describedby="emailHelp">
            </div>
            <div class="col-md-6 mobile-input m-1">
                <label for="studentNumber" class="form-label">Student's Mobile Number</label>
                <input type="number" class="form-control" name="student_contact" id="studentNumber" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="add-user-form-row mb-3">
            <div class="col-md-6 mobile-input m-1">
                <label for="fathersName" class="form-label">Father's Name</label>
                <input type="text" class="form-control" name="student_father" id="fathersName" aria-describedby="emailHelp">
            </div>
            <div class="col-md-6 mobile-input m-1">
                <label for="mothersName" class="form-label">Mother's Name</label>
                <input type="text" class="form-control" name="student_mother" id="mothersName" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="add-user-form-row mb-3">
            <div class="col-md-4 mobile-input m-1">
                <label for="studentName" class="form-label">Roll Number</label>
                <input type="text" class="form-control" name="student_roll" id="studentName" aria-describedby="emailHelp">
            </div>
            <div class="col-md-4 mobile-input m-1">
                <label for="studentNumber" class="form-label">Student's Selected Course</label>
                <select class="form-select" name="student_course" aria-label="Default select example">
                    <option selected>Open this select menu</option>
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
                <label for="studentAdmissionDate" class="form-label">Student Admission Date</label>
                <input type="date" class="form-control" name="student_admission_date" id="studentAdmissionDate" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="add-user-form-row mb-3">
            <div class="col-md-4 mobile-input m-1">
                <label for="fathersName" class="form-label">Aadhar Card Number</label>
                <input type="number" class="form-control" name="student_aadhar_number" id="fathersName" aria-describedby="emailHelp">
            </div>
            <div class="m-1 col-md-4 mobile-input">
                <label for="formFile" class="form-label">Upload Aadhar Card Front Image *</label>
                <input class="form-control" name="student_aadhar_file" type="file" id="formFile">
            </div>
            <div class="m-1 col-md-4 mobile-input">
                <label for="formFile" class="form-label">Upload Aadhar Card Back Image *</label>
                <input class="form-control" name="student_aadhar_back_file" type="file" id="formFile">
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Address (as on Aadhar Card)*</label>
            <textarea class="form-control" name="student_aadhar_address" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-check mb-3" onclick="hideInputField()">
            <input class="form-check-input" type="checkbox" value="1" id="addressCheckBox">
            <label class="form-check-label" for="addressCheckBox">
                Same as above
            </label>
        </div>
        <div class="mb-3" id="communicationAddress">
            <label for="exampleFormControlTextarea1" class="form-label">Communication Address</label>
            <textarea class="form-control" name="student_comm_address" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" name="submit" class="w-100 btn btn-outline-primary">Add Student</button>
    </form>
</div>