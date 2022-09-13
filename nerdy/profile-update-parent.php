<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="megaphone" class="section-heading-icon"></ion-icon>
                Add Student
            </h3>
            <p class="section-desc">Enter details below to add student</p>
        </div>

        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
            $session_user_contact = $_SESSION['user_contact'];
            $session_user_type = $_SESSION['user_type'];
        } else {
            $session_user_id = 0;
        }

        $fetch_school = "SELECT * FROM users WHERE user_id = $session_user_id";
        $fetch_school_result = mysqli_query($connection, $fetch_school);
        $user_added_by = "";
        while ($row = mysqli_fetch_assoc($fetch_school_result)) {
            $user_added_by = $row['user_added_by'];
        }
        $student_school_id = $user_added_by;

        if (isset($_POST['save'])) {
            $student_id = $_POST['student_id'];
            $student_name = $_POST['student_name'];
            $student_father_name = $_POST['student_father_name'];
            $student_father_email = $_POST['student_father_email'];
            $student_mother_name = $_POST['student_mother_name'];
            $student_mother_contact = $_POST['student_mother_contact'];
            $student_mother_email = $_POST['student_mother_email'];
            $student_address = $_POST['student_address'];
            $student_state = $_POST['student_state'];
            $student_city = $_POST['student_city'];
            $student_pincode = $_POST['student_pincode'];
            $student_status = 1;

            $update = "UPDATE
            `students`
        SET
            `student_name` = '$student_name',
            `student_father_name` = '$student_father_name',
            `student_father_email` = '$student_father_email',
            `student_mother_name` = '$student_mother_name',
            `student_mother_contact` = '$student_mother_contact',
            `student_mother_email` = '$student_mother_email',
            `student_address` = '$student_address',
            `student_state` = '$student_state',
            `student_city` = '$student_city',
            `student_pincode` = '$student_pincode',
            `student_status` = '$student_status'
        WHERE
            `student_id` = '$student_id'";
            $add_student_result = mysqli_query($connection, $update);

            if (!$add_student_result) {
                die("ERROR 404: " . mysqli_error($connection));
            } else {
                echo  "<div class='alert alert-success' role='alert'>Profile Updated</div>";
            }
        }



        if (isset($_POST['submit'])) {
            $student_id = $_POST['student_id'];

            $get_student = "SELECT * FROM `students` WHERE student_id = $student_id";
            $get_student_r = mysqli_query($connection, $get_student);
            $student_status = "";
            while ($row = mysqli_fetch_assoc($get_student_r)) {
                $student_id = $row['student_id'];
                $student_roll_number = $row['student_roll_number'];
                $student_name = $row['student_name'];
                $student_father_name = $row['student_father_name'];
                $student_father_contact = $row['student_father_contact'];
                $student_father_email = $row['student_father_email'];
                $student_mother_name = $row['student_mother_name'];
                $student_mother_contact = $row['student_mother_contact'];
                $student_mother_email = $row['student_mother_email'];
                $student_address = $row['student_address'];

        ?>
        <form action="" method="POST" class="card p-3">
            <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
            <div class="w-100 d-flex mob-flex mb-3">
                <div class="w-100 m-1 form-floating">
                    <input type="number" name="student_roll_number" value="<?php echo $student_roll_number ?>"
                        class="form-control" id="student_rollNumber" disabled placeholder="Roll Number" required>
                    <label for="student_rollNumber">Roll Number</label>
                </div>
                <div class="w-100 m-1 form-floating">
                    <input type="text" name="student_name" value="<?php echo $student_name ?>" class="form-control"
                        id="studentName" placeholder="Full Name" required>
                    <label for="studentName">Student's Full Name</label>
                </div>
            </div>
            <div class="w-100 d-flex mob-flex mb-3">
                <div class="w-100 form-floating m-1 ">
                    <input type="text" name="student_father_name" value="<?php echo $student_father_name ?>"
                        class="form-control" id="fatherName" placeholder="Password" required>
                    <label for="fatherName">Father's Name</label>
                </div>
                <div class="w-100 form-floating m-1 ">
                    <input disabled type="number" name="student_father_contact"
                        value="<?php echo $student_father_contact ?>" class="form-control" id="fatherContact"
                        placeholder="Password" required>
                    <label for="fatherContact">Father's Mobile Number</label>
                </div>
                <div class="w-100 form-floating m-1 ">
                    <input type="email" name="student_father_email" value="<?php echo $student_father_email ?>"
                        class="form-control" id="fatherEmail" placeholder="Password">
                    <label for="fatherEmail">Father's Email Address</label>
                </div>
            </div>

            <div class="w-100 d-flex mob-flex mb-3">
                <div class="w-100 form-floating m-1 ">
                    <input type="text" name="student_mother_name" value="<?php echo $student_mother_name ?>"
                        class="form-control" id="motherName" placeholder="Password">
                    <label for="motherName">Mother's Name</label>
                </div>
                <div class="w-100 form-floating m-1 ">
                    <input type="number" name="student_mother_contact" value="<?php echo $student_mother_contact ?>"
                        class="form-control" id="motherContact" placeholder="Password">
                    <label for="motherContact">Mother's Mobile Number</label>
                </div>
                <div class="w-100 form-floating m-1 ">
                    <input type="email" name="student_mother_email" value="<?php echo $student_mother_email ?>"
                        class="form-control" id="motherEmail" placeholder="Password">
                    <label for="motherEmail">Mother's Email Address</label>
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="student_address" value="<?php echo $student_address ?>"
                    placeholder="Leave a comment here" id="studentAddress" style="height: 100px" required></textarea>
                <label for="studentAddress">Full Address</label>
            </div>

            <div class="w-100 d-flex mob-flex mb-3">
                <div class="form-floating m-1 w-100">
                    <select class="form-select" name="student_state" id="floatingSelect"
                        aria-label="Floating label select example" required>
                        <option>Click here to open list of States</option>
                        <?php
                                $curl = curl_init();
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/states',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_HTTPHEADER => array(
                                        'X-CSCAPI-KEY: eTAxUGIyaElOSm5ldE9YdDhmQTJTaWMxbEVWUVFqR1hqblZRNmRyVw=='
                                    ),
                                ));
                                $response = curl_exec($curl);
                                curl_close($curl);
                                $response_json = json_decode($response);
                                foreach ($response_json as $key) {
                                    $user_state =  $key->name; ?>
                        <option value="<?php echo $user_state; ?>"><?php echo $user_state; ?></option>
                        <?php
                                }
                                ?>

                    </select>
                    <label for="floatingSelect">State</label>
                </div>

                <div class="form-floating m-1 w-100">
                    <select class="form-select" name="student_city" id="floatingSelect"
                        aria-label="Floating label select example" required>
                        <option>Click here to open list of Cities</option>
                        <?php
                                $curl = curl_init();
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/cities',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_HTTPHEADER => array(
                                        'X-CSCAPI-KEY: eTAxUGIyaElOSm5ldE9YdDhmQTJTaWMxbEVWUVFqR1hqblZRNmRyVw=='
                                    ),
                                ));
                                $response = curl_exec($curl);
                                curl_close($curl);
                                $response_json = json_decode($response);
                                foreach ($response_json as $key) {
                                    $user_city =  $key->name; ?>

                        <option value="<?php echo $user_city; ?>"><?php echo $user_city; ?></option>
                        <?php
                                }
                                ?>
                    </select>
                    <label for="floatingSelect">City</label>
                </div>

                <div class="form-floating m-1 w-100">
                    <input type="number" name="student_pincode" value="<?php echo $student_pincode ?>" maxlength="6"
                        class="form-control" id="pincode" placeholder="XXXXXX" required>
                    <label for="pincode">Pincode</label>
                </div>
            </div>

            <button type="submit" name="save" class="btn btn-outline-success p-3 mt-3">Save</button>
        </form>
        <?php }
        } ?>
    </div>
</div>
<?php include('main/footer.php'); ?>