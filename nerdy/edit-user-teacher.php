<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="create" class="section-heading-icon"></ion-icon>
                Edit Teacher
            </h3>
            <p class="section-desc">To change the pasword of this Teacher, enter new mobile number of the teacher</p>
        </div>


        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }

        // QUERY TO ENABLE USER
        if (isset($_POST['enable'])) {
            $user_id = $_POST['user_id'];
            $user_status = 1;
            $enable_user = "UPDATE `users` SET `user_status`=$user_status WHERE user_id = $user_id";
            $enable_result = mysqli_query($connection, $enable_user);
            if ($enable_result) {
                echo "<div class='alert alert-success' role='alert'>
                      Teacher ID Enabled! <a href='manage.php' style='text-decoration: none !important;'>Click here</a> to go back to Menu
                    </div>";
            } else {
                die("THERE WAS SOME PROBLEM ENABLING THIS TEACHER'S ID" . " ERROR DETAILS: " . mysqli_error($connection));
            }
        }

        // QUERY TO DISABLE USER
        if (isset($_POST['disable'])) {
            $user_id = $_POST['user_id'];
            $user_status = 2;
            $disable_user = "UPDATE `users` SET `user_status`=$user_status WHERE user_id = $user_id";
            $disable_user_result = mysqli_query($connection, $disable_user);
            if (!$disable_user_result) {
                die("THERE WAS SOME PROBLEM DISABLING THIS TEACHER'S ID" . " ERROR DETAILS: " . mysqli_error($connection));
            } else {
                echo "<div class='alert alert-warning' role='alert'>Teacher ID Disabled! <a href='manage.php' style='text-decoration: none !important;'>Click here</a> to go back to Menu</div>";
            }
        }

        // QUERY TO UPDATE USER DETAILS
        if (isset($_POST['update'])) {
            $user_id = $_POST['user_id'];
            $entered_user_name = $_POST['user_name'];
            $entered_user_contact = $_POST['user_contact'];

            $user_name = substr($_POST['user_name'], 0, 4);
            $user_contact = substr($_POST['user_contact'], -4);

            $user_password = strtolower($user_name . $user_contact);

            $hash = password_hash($user_password, PASSWORD_DEFAULT);
            $update_user = "UPDATE `users` SET `user_name`='$entered_user_name',`user_contact`='$entered_user_contact',`user_password`='$hash' WHERE user_id = $user_id";
            $update_user_result = mysqli_query($connection, $update_user);
            if ($update_user_result) {
                echo "<div class='alert alert-success' role='alert'>
                     $entered_user_name details have been updated! 
                   </div>";
            } else {
                die("THERE WAS SOME PROBLEM UPDATING THIS TEACHER'S DETAILS" . " ERROR DETAILS: " . mysqli_error($connection));
            }
        }

        // QUERY TO FETCH USER DETAILS
        if (isset($_POST['edit'])) {
            $user_id = $_POST['user_id'];
            $fetch_teacher_details = "SELECT * FROM users WHERE user_id = $user_id AND user_added_by = $session_user_id";
            $fetch_teacher_result = mysqli_query($connection, $fetch_teacher_details);

            while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                $fetched_user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_contact = $row['user_contact'];
                $user_status = $row['user_status']; ?>

        <form method="POST" action="" class="col-md-6 card p-3">
            <!-- =========== HIDDEN =========== -->
            <input type="text" name="user_id" value="<?php echo $fetched_user_id; ?>" hidden>
            <!-- =========== HIDDEN =========== -->
            <div class='w-100 mob-flex d-flex justify-content-center align-items-center w-100 mb-3'>
                <div class="w-100 m-1">
                    <label for="userName" class="form-label w-100">Full Name</label>
                    <input type="text" name="user_name" class="form-control w-100" id="userName"
                        aria-describedby="emailHelp" value="<?php echo $user_name ?>"
                        placeholder="<?php echo $user_name ?>">
                </div>
                <div class="w-100 m-1">
                    <label for="userContact" class="form-label w-100">Contact Number</label>
                    <input type="number" name="user_contact" class="form-control w-100" id="userContact"
                        placeholder="<?php echo $user_contact ?>" value="<?php echo $user_contact ?>">
                </div>
            </div>

            <!-- =========== UPDATE TEACHER DETAILS =========== -->
            <button type="submit" name="update" class="btn btn-primary mb-3">Update</button>

            <!-- =========== DISABLE TEACHER ID =========== -->
            <?php if ($user_status == 1) { ?>
            <button type="submit" name="disable" class="btn btn-outline-danger">Disable Teacher ID</button>

            <!-- =========== ENABLE TEACHER ID =========== -->
            <?php  } else if ($user_status == 2) { ?>
            <button type="submit" name="enable" class="btn btn-outline-success">Enable Teacher ID</button>
            <?php  } ?>
        </form>
        <?php
            }
        } ?>
        <!-- <div class="mt-5">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="document-attach" class="section-heading-icon"></ion-icon>
                Assign Subject
            </h3>
            <p class="section-desc">Assign a subject and a class to this teacher.</p>
        </div>

        <div class="card p-3">
            <?php
            if (isset($_POST['assign'])) {
                $user_name = $_POST['teacher_assigned'];
                $teacher_assigned_subject = $_POST['teacher_assigned_subject'];
                $teacher_assigned_class = $_POST['teacher_assigned_class'];

                $assign_teacher_query = "INSERT INTO `teacher_class_assignment`(
                         `teacher_assigned`, 
                         `teacher_assigned_subject`, 
                         `teacher_assigned_class`, 
                         `teacher_assigned_by`) VALUES (
                             '$user_name',
                             '$teacher_assigned_subject',
                             '$teacher_assigned_class',
                             '$session_user_id')";
                $assign_teacher_result = mysqli_query($connection, $assign_teacher_query);
                if ($assign_teacher_result) {
                    echo "Success";
                } else {
                    die("Failed" . mysqli_error($connection));
                }
            }
            ?>
            <form action="" method="POST">
                <div class="d-flex">
                    <input type="text" name="teacher_assigned" value="<?php echo $user_name ?>" hidden>
                    
                    <select class="form-select equal-flex m-1" name="teacher_assigned_subject"
                        aria-label="Default select example">
                        <option selected>Open this menu to get subject list</option>
                        <?php
                        $get_subject = "SELECT * FROM subjects WHERE subject_added_by = $session_user_id";
                        $get_subject_result = mysqli_query($connection, $get_subject);
                        $count_subjects = mysqli_num_rows($get_subject_result);
                        while ($row = mysqli_fetch_array($get_subject_result)) {
                            $subject_name = $row['subject_name'];

                        ?>
                        <option value="<?php echo $subject_name ?>">
                            <?php echo $subject_name ?></option>
                        <?php
                        }

                        ?>
                    </select>

                    
                    <select class="form-select equal-flex m-1" name="teacher_assigned_class"
                        aria-label="Default select example">
                        <option selected>Open this menu to get class list</option>
                        <?php
                        $get_classes = "SELECT * FROM classes WHERE class_added_by = $session_user_id";
                        $get_classes_result = mysqli_query($connection, $get_classes);
                        $count_subjects = mysqli_num_rows($get_classes_result);
                        while ($row = mysqli_fetch_array($get_classes_result)) {
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];

                        ?>
                        <option value="<?php echo $class_name . $class_section ?>">
                            <?php echo $class_name . $class_section ?></option>
                        <?php
                        }

                        ?>
                    </select>

                </div>
                <button type="submit" name="assign" class="btn btn-outline-primary w-100 mt-3">Assign</button>
            </form>

        </div>
    </div> -->
    </div>
</div>
<?php include('main/footer.php'); ?>