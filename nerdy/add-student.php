<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex">
    <?php include('navbar/class-teacher-side-nav.php') ?>
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

        if (isset($_POST['add'])) {
            $student_roll_number = $_POST['student_roll_number'];
            $student_name = $_POST['student_name'];
            $student_father_name = $_POST['student_father_name'];
            $student_father_contact = $_POST['student_father_contact'];
            $student_father_email = $_POST['student_father_email'];
            $student_mother_name = $_POST['student_mother_name'];
            $student_mother_contact = $_POST['student_mother_contact'];
            $student_mother_email = $_POST['student_mother_email'];
            $student_address = $_POST['student_address'];
            $student_state = $_POST['student_state'];
            $student_city = $_POST['student_city'];
            $student_pincode = $_POST['student_pincode'];
            $student_assigned_class = $_POST['student_assigned_class'];
            $student_status = 1;
            $student_school_id;
            $student_login = 2;

            $add_student_query = "INSERT INTO `students`(
            `student_roll_number`,
            `student_name`, 
            `student_father_name`, 
            `student_father_contact`,
             `student_father_email`,
             `student_mother_name`,
             `student_mother_contact`,
             `student_mother_email`,
             `student_address`,
             `student_state`,
             `student_city`,
             `student_pincode`,
             `student_added_by`,
             `student_assigned_class`,
             `student_assigned_school`,
             `student_login`,
             `student_status`) VALUES (
                '$student_roll_number',
                '$student_name',
             '$student_father_name',
             '$student_father_contact',
             '$student_father_email',
             '$student_mother_name',
             '$student_mother_contact',
             '$student_mother_email',
             '$student_address',
             '$student_state',
             '$student_city',
             '$student_pincode',
             '$session_user_id',
             '$student_assigned_class',
             '$student_school_id',
             '$student_login',
             '$student_status')";
            $add_student_result = mysqli_query($connection, $add_student_query);
            if (!$add_student_result) {
                die("ERROR 404: " . mysqli_error($connection));
            } else {
                $fetch_sub_status = "SELECT * FROM `subscription` WHERE subscription_user_id = $student_school_id";
                $fetch_sub_result = mysqli_query($connection, $fetch_sub_status);

                while ($row = mysqli_fetch_assoc($fetch_sub_result)) {
                    $subscription_parent_limit = $row['subscription_parent_limit'];

                    $deducted_parent_limit = $subscription_parent_limit - 1;
                    $update_user_limit = "UPDATE `subscription` SET `subscription_parent_limit`= $deducted_parent_limit WHERE subscription_user_id = $student_school_id";
                    $update_user_result = mysqli_query($connection, $update_user_limit);
                    if ($update_user_result) {


                        // Parent Login Generation.
                        $temp_password_first = substr($student_name, 0, 4);
                        $temp_password_last = substr($student_father_contact, -4);

                        $parent_login_id = $student_father_contact;
                        $temp_login_password = strtolower($temp_password_first . $temp_password_last);

                        $parent_login_password = password_hash($temp_login_password, PASSWORD_DEFAULT);
                        $parent_user_status = 2;

                        $parent_user_type = 4;

                        $search_query = "SELECT * FROM `users` WHERE user_contact = $student_father_contact";
                        $search_result = mysqli_query($connection, $search_query);
                        $search_count = mysqli_num_rows($search_result);

                        if ($search_count > 0) {
                            echo "Looks like this user is already registered as a student in our system";
                        } else if ($search_count == 0) {
                            $insert_parent = "INSERT INTO `users`(
                                `user_name`,  
                                `user_contact`, 
                                `user_password`, 
                                `user_status`, 
                                `user_type`, 
                                `user_added_by`) VALUES(
                                    '$student_name',
                                    '$parent_login_id',
                                    '$parent_login_password',
                                    '$parent_user_status',
                                    '$parent_user_type',
                                    '$session_user_id'
                                )";
                            $insert_parent_res = mysqli_query($connection, $insert_parent);
                            if ($insert_parent_res) {
                                echo '<script>studentAdded()</script>';
                            }
                        }
                    } else {
                        die(mysqli_error($connection));
                    }
                }

        ?>

        <!-- Mark Attendance Toast Start -->
        <div class="toast-container">
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="studentAddToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="assets/images/logo/logo-round.png" class="rounded me-2 toast-logo" alt="...">
                        <strong class="me-auto">Update</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <p><?php echo $student_name ?> Added</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mark Attendance Toast End -->

        <?php }
        } ?>
        <form action="" method="POST" class="card p-3">
            <div class="w-100 d-flex mb-3">
                <div class="w-100 m-1 form-floating">
                    <input type="number" name="student_roll_number" class="form-control" id="floatingInput"
                        placeholder="Roll Number">
                    <label for="floatingInput">Roll Number</label>
                </div>
                <div class="w-100 m-1 form-floating">
                    <input type="text" name="student_name" class="form-control" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Student's Full Name</label>
                </div>
            </div>
            <div class="w-100 d-flex mb-3">
                <div class="w-100 form-floating m-1 ">
                    <input type="text" name="student_father_name" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Father's Name</label>
                </div>
                <div class="w-100 form-floating m-1 ">
                    <input type="number" name="student_father_contact" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Father's Mobile Number</label>
                </div>
                <div class="w-100 form-floating m-1 ">
                    <input type="email" name="student_father_email" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Father's Email Address</label>
                </div>
            </div>

            <div class="w-100 d-flex mb-3">
                <div class="w-100 form-floating m-1 ">
                    <input type="text" name="student_mother_name" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Mother's Name</label>
                </div>
                <div class="w-100 form-floating m-1 ">
                    <input type="number" name="student_mother_contact" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Mother's Mobile Number</label>
                </div>
                <div class="w-100 form-floating m-1 ">
                    <input type="email" name="student_mother_email" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Mother's Email Address</label>
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="student_address" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Full Address</label>
            </div>

            <div class="w-100 d-flex mb-3">
                <div class="form-floating m-1 w-100">
                    <select class="form-select" name="student_state" id="floatingSelect"
                        aria-label="Floating label select example">
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
                        aria-label="Floating label select example">
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
                    <input type="number" name="student_pincode" maxlength="6" class="form-control" id="floatingInput"
                        placeholder="XXXXXX">
                    <label for="floatingInput">Pincode</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="student_assigned_class" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option selected>Open this select menu</option>
                    <?php
                    $fetch_class = "SELECT * FROM classes where class_teacher = $session_user_id";
                    $fetch_result = mysqli_query($connection, $fetch_class);
                    while ($row = mysqli_fetch_assoc($fetch_result)) {
                        $class_id = $row['class_id'];
                        $class_name = $row['class_name'];
                        $class_section = $row['class_section'];
                    ?>
                    <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?></option>
                    <?php
                    } ?>
                </select>
                <label for="floatingSelect">Assign Class</label>
            </div>
            <button type="submit" name="add" class="btn btn-outline-success p-3 mt-3">Add Student</button>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>