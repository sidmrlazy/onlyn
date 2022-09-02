<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">

        <!-- <div class="info-pill">
        <p class="info-pill-label">Available Teacher Login ID's</p>
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }
        $fetch_count = "SELECT * FROM subscription WHERE subscription_user_id = $session_user_id";
        $fetch_count_result = mysqli_query($connection, $fetch_count);
        while ($row = mysqli_fetch_assoc($fetch_count_result)) {
            $subscription_teacher_limit = $row['subscription_teacher_limit']; ?>
        <p class="info-pill-response"><?php echo $subscription_teacher_limit ?></p>
        <?php
        } ?>
    </div> -->

        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="person-add" class="section-heading-icon"></ion-icon>
                Add Teacher
            </h3>
            <p class="section-desc">Mention details below to generate Teacher's user ID. <br> To
                <strong>Sign-In</strong> to
                teacher's
                Onlyn Nerdy panel enter the mobile number of the teacher and the <br> First 4 Alphabets of teacher's
                name and
                last 4 Digits of the mobile number.
            </p>
        </div>
        <?php
        $user_exists = false;
        if (isset($_POST['create'])) {
            $entered_user_name = $_POST['user_name'];
            $user_name = substr($_POST['user_name'], 0, 4);

            $entered_user_contact = $_POST['user_contact'];
            $user_contact = substr($_POST['user_contact'], -4);

            $user_password = strtolower($user_name . $user_contact);
            $user_type = 3;
            $user_status = 1;

            $teacher_added_by = $session_user_id;
            $check_user = "SELECT * FROM users WHERE user_contact='$user_contact'";
            $check_user_result = mysqli_query($connection, $check_user);
            $count = mysqli_num_rows($check_user_result);

            if ($count == 0) {

                $get_user_subscription = "SELECT * FROM subscription WHERE 	subscription_user_id = $session_user_id";
                $get_user_subscription_result = mysqli_query($connection, $get_user_subscription);

                while ($row = mysqli_fetch_assoc($get_user_subscription_result)) {
                    $subscription_teacher_limit = $row['subscription_teacher_limit'];
                    if ($subscription_teacher_limit === 'Unlimited') {

                        if (($user_password) && $user_exists == false) {
                            $hash = password_hash($user_password, PASSWORD_DEFAULT);
                            $reg_user = "INSERT INTO `users` ( 
                                     `user_name`,
                                     `user_contact`,
                                     `user_password`,
                                     `user_type`,  
                                     `user_status`,
                                     `user_added_by`) VALUES (
                                         '$entered_user_name',
                                         '$entered_user_contact',
                                         '$hash',
                                         '$user_type',
                                         '$user_status',
                                         '$teacher_added_by')";
                            $reg_user_result = mysqli_query($connection, $reg_user);
                            if ($reg_user_result) {
                                echo "<div class='alert alert-success' role='alert'>
                            $entered_user_name has been added in your account!
                          </div>";
                                $fetch_query = "SELECT * FROM users WHERE user_contact = $entered_user_contact";
                                $fetch_result = mysqli_query($connection, $fetch_query);
                                if ($fetch_result) {
                                    while ($row = mysqli_fetch_assoc($fetch_result)) {
                                        $teacher_user_id = $row['user_id'];
                                        $teacher_name = $row['user_name'];
                                        $teacher_added_by = $row['user_added_by'];

                                        $teacher_setup_query = "INSERT INTO `teacher_setup`(
                                    `teacher_user_id`,
                                    `teacher_name`, 
                                    `teacher_added_by`) VALUES (
                                        '$teacher_user_id',
                                        '$teacher_name',
                                        '$teacher_added_by')";
                                        $teacher_setup_result = mysqli_query($connection, $teacher_setup_query);
                                        if (!$teacher_setup_result) {
                                            die(mysqli_error($connection));
                                        }
                                    }
                                } else {
                                    echo "This User already exists";
                                }
                            }
                        }
                    } else if ($subscription_teacher_limit > 0) {

                        if (($user_password) && $user_exists == false) {
                            $hash = password_hash($user_password, PASSWORD_DEFAULT);
                            $reg_user = "INSERT INTO `users` ( 
                                     `user_name`,
                                     `user_contact`,
                                     `user_password`,
                                     `user_type`,  
                                     `user_status`,
                                     `user_added_by`) VALUES (
                                         '$entered_user_name',
                                         '$entered_user_contact',
                                         '$hash',
                                         '$user_type',
                                         '$user_status',
                                         '$teacher_added_by')";
                            $reg_user_result = mysqli_query($connection, $reg_user);
                            if ($reg_user_result) {
                                echo "<div class='alert alert-success' role='alert'>
                            $entered_user_name has been added in your account!
                          </div>";
                                $fetch_query = "SELECT * FROM users WHERE user_contact = $entered_user_contact";
                                $fetch_result = mysqli_query($connection, $fetch_query);
                                if ($fetch_result) {
                                    while ($row = mysqli_fetch_assoc($fetch_result)) {
                                        $teacher_user_id = $row['user_id'];
                                        $teacher_name = $row['user_name'];
                                        $teacher_added_by = $row['user_added_by'];

                                        $teacher_setup_query = "INSERT INTO `teacher_setup`(
                                    `teacher_user_id`,
                                    `teacher_name`, 
                                    `teacher_added_by`) VALUES (
                                        '$teacher_user_id',
                                        '$teacher_name',
                                        '$teacher_added_by')";
                                        $teacher_setup_result = mysqli_query($connection, $teacher_setup_query);
                                        if (!$teacher_setup_result) {
                                            die(mysqli_error($connection));
                                        } else {
                                            $deducted_teacher_limit = $subscription_teacher_limit - 1;
                                            $update_school_plan = "UPDATE `subscription` SET `subscription_teacher_limit`='$deducted_teacher_limit' WHERE subscription_user_id = $session_user_id";
                                            $update_school_plan_result = mysqli_query($connection, $update_school_plan);

                                            if (!$update_school_plan_result) {
                                                die(mysqli_error($connection));
                                            }
                                        }
                                    }
                                } else {
                                    echo "This user already exists";
                                }
                            }
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>
                                You have exhausted your account limit! Please upgrade plan to use this feature.</div>";
                    }
                }
            } // end if 

            if ($count > 0) {
                $user_exists = "Oops! Looks like this user already exists in our system. try using some other contact number to register this user";
            }
        }
        ?>
        <form method="POST" action="" class="col-md-6 card p-3">
            <div id='new-input-field' class='d-flex mob-flex justify-content-center align-items-center w-100 mb-3'>
                <div class='form-floating w-100 m-1'>
                    <input type='text' name='user_name' class='form-control' id='floatingInput' placeholder='Full Name'>
                    <label for='floatingInput'>Teacher Full Name</label>
                </div>
                <div class='form-floating w-100 m-1'>
                    <input type='number' maxlength="10" name='user_contact' class='form-control' id='floatingContact'
                        placeholder='Mobile Number'>
                    <label for='floatingContact'>Mobile Number</label>
                </div>
            </div>

            <button type="submit" name="create" class="btn btn-outline-warning mb-3">ADD TEACHER</button>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>