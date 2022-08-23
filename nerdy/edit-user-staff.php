<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard  container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header ">
            <h3>Edit Teacher</h3>
            <p>Edit teacher details below. To change user password, just enter the new mobile number</p>
            <p class="note font-weight-bold">Note: Teacher's Login ID and Password are the first 4 characters of the
                teacher's name
                and last
                4 digits of
                the registered mobile number, all in lowercase. </p>
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
            $user_id = $_POST['staff_id'];
            $user_status = 1;
            $enable_user = "UPDATE `staff` SET `staff_active_status`=$user_status WHERE staff_id = $user_id";
            $enable_result = mysqli_query($connection, $enable_user);
            if ($enable_result) {
                echo "<div class='alert alert-success' role='alert'>
                      Staff ID Enabled! <a href='manage.php' style='text-decoration: none !important;'>Click here</a> to go back to Menu
                    </div>";
            } else {
                die("THERE WAS SOME PROBLEM ENABLING THIS ID" . " ERROR DETAILS: " . mysqli_error($connection));
            }
        }

        // QUERY TO DISABLE USER
        if (isset($_POST['disable'])) {
            $user_id = $_POST['staff_id'];
            $user_status = 2;
            $disable_user = "UPDATE `staff` SET `staff_active_status`=$user_status WHERE staff_id = $user_id";
            $disable_user_result = mysqli_query($connection, $disable_user);
            if (!$disable_user_result) {
                die("THERE WAS SOME PROBLEM DISABLING ID" . " ERROR DETAILS: " . mysqli_error($connection));
            } else {
                echo "<div class='alert alert-warning' role='alert'>Staff ID Disabled! <a href='manage.php' style='text-decoration: none !important;'>Click here</a> to go back to Menu</div>";
            }
        }

        // QUERY TO UPDATE USER DETAILS
        if (isset($_POST['update'])) {
            $user_id = $_POST['staff_id'];
            $entered_user_name = $_POST['staff_name'];
            $entered_user_contact = $_POST['staff_contact'];
            $staff_type = $_POST['staff_type'];

            $update_user = "UPDATE `staff` SET `staff_name`='$entered_user_name',`staff_contact`='$entered_user_contact', `staff_type`='$staff_type' WHERE staff_id = $user_id";
            $update_user_result = mysqli_query($connection, $update_user);
            if ($update_user_result) {
                echo "<div class='alert alert-success' role='alert'>
                     $entered_user_name details have been updated! 
                   </div>";
            } else {
                die("THERE WAS SOME PROBLEM UPDATING THE DETAILS OF THIS ID" . " ERROR DETAILS: " . mysqli_error($connection));
            }
        }

        // QUERY TO FETCH USER DETAILS
        if (isset($_POST['edit'])) {
            $staff_id = $_POST['staff_id'];
            $fetch_staff_details = "SELECT * FROM staff WHERE staff_id = $staff_id AND staff_added_by = $session_user_id";
            $fetch_staff_result = mysqli_query($connection, $fetch_staff_details);

            while ($row = mysqli_fetch_assoc($fetch_staff_result)) {
                $fetched_user_id = $row['staff_id'];
                $staff_name = $row['staff_name'];
                $staff_contact = $row['staff_contact'];
                $staff_type = $row['staff_type'];
                $staff_active_status = $row['staff_active_status']; ?>

        <form method="POST" action="" class="card p-5">
            <!-- =========== HIDDEN =========== -->
            <input type="text" name="staff_id" value="<?php echo $fetched_user_id; ?>" hidden>
            <!-- =========== HIDDEN =========== -->
            <div class='w-100 d-flex justify-content-center align-items-center w-100 mb-3'>
                <div class="w-100 m-1">
                    <label for="userName" class="form-label w-100">Teacher's Full Name</label>
                    <input type="text" name="staff_name" class="form-control w-100" id="userName"
                        aria-describedby="emailHelp" value="<?php echo $staff_name ?>"
                        placeholder="<?php echo $staff_name ?>">
                </div>
                <div class="w-100 m-1">
                    <label for="userContact" class="form-label w-100">Contact Number</label>
                    <input type="number" name="staff_contact" class="form-control w-100" id="userContact"
                        placeholder="<?php echo $staff_contact ?>" value="<?php echo $staff_contact ?>">
                </div>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="staff_type" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option><?php echo $staff_type; ?></option>
                    <?php
                            $fetch_staff = "SELECT * FROM staff_category";
                            $fetch_staff_result = mysqli_query($connection, $fetch_staff);
                            while ($row = mysqli_fetch_assoc($fetch_staff_result)) {
                                $staff_category_name = $row['staff_category_name']; ?>

                    <option value="<?php echo $staff_category_name; ?>"><?php echo $staff_category_name; ?></option>
                    <?php
                            } ?>
                </select>
                <label for="floatingSelect">Works with selects</label>
            </div>

            <!-- =========== UPDATE TEACHER DETAILS =========== -->
            <button type="submit" name="update" class="btn btn-primary mb-3">Update</button>

            <!-- =========== DISABLE TEACHER ID =========== -->
            <?php if ($staff_active_status == 1) { ?>
            <button type="submit" name="disable" class="btn btn-outline-danger">Disable Staff ID</button>

            <!-- =========== ENABLE TEACHER ID =========== -->
            <?php  } else if ($staff_active_status == 2) { ?>
            <button type="submit" name="enable" class="btn btn-outline-success">Enable Staff ID</button>
            <?php  } ?>
        </form>
        <?php
            }
        } ?>

    </div>
</div>
<?php include('main/footer.php'); ?>