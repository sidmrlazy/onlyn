<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Collect Fee
            </h3>
            <p class="section-desc">Caption required</p>
        </div>

        <?php
        require_once('main/config.php');

        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }

        if (isset($_POST['collect'])) {
            $fee_school_id = $_POST['fee_school_id'];
            $fee_school_student_id = $_POST['fee_school_student_id'];
            $fee_assigned_class = $_POST['fee_assigned_class'];
            $fee_collection_type = $_POST['fee_collection_type'];
            $fee_collection_date = $_POST['fee_collection_date'];
            $fee_collection_receipt = $_POST['fee_collection_receipt'];
            $fee_collection_status = 1;

            if (empty($fee_collection_receipt)) {
                die("<div class='alert alert-danger mb-3' role='alert'>
                 Fee Receipt cannot be empty!
               </div>");
            }

            $fetch_amount = "SELECT * FROM school_fee WHERE fee_id = '$fee_collection_type' AND fee_school_id = '$fee_school_id'";
            $fetch_amount_res = mysqli_query($connection, $fetch_amount);

            if (!$fetch_amount_res) {
                echo "ERROR";
            } else {
                $fetch_amount = "";
                while ($row = mysqli_fetch_assoc($fetch_amount_res)) {
                    $fee_amount = $row['fee_amount'];
                }

                $insert_query = "INSERT INTO `fee_collection`(
                        `fee_school_id`,
                        `fee_school_student_id`,
                        `fee_assigned_class`,
                        `fee_collection_type`,
                        `fee_collection_date`,
                        `fee_collection_amount`,
                        `fee_collection_receipt`,
                        `fee_collection_status`
                    )
                    VALUES(
                        '$fee_school_id',
                        '$fee_school_student_id',
                        '$fee_assigned_class',
                        '$fee_collection_type',
                        '$fee_collection_date',
                        '$fee_amount',
                        '$fee_collection_receipt',
                        '$fee_collection_status'
                    )";
                $insert_result = mysqli_query($connection, $insert_query);

                if (!$insert_result) {
                    echo "<script>notInserted();</script>";
                } else {
                    echo "<script>inserted();</script>";
                }
            }
        }

        if (isset($_POST['search'])) {
            $student_assigned_school = $_POST['student_assigned_school'];
            $student_assigned_class = $_POST['student_assigned_class'];
            $student_roll_number = $_POST['student_roll_number'];
            $query = "SELECT * FROM `students` WHERE `student_roll_number` = '$student_roll_number' AND `student_assigned_class` = $student_assigned_class";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                $student_id = "";
                $student_assigned_class = "";
                while ($row = mysqli_fetch_assoc($result)) {
                    $student_id = $row['student_id'];
                    $student_name = $row['student_name'];
                    $student_father_name = $row['student_father_name'];
                    $student_father_contact = $row['student_father_contact'];
                    $student_assigned_class = $row['student_assigned_class']; ?>
        <div class="student-details-card">
            <p class="student-details-name"><?php echo $student_name ?></p>
            <p class="m-0"><?php echo $student_father_name . " (" . $student_father_contact . ")" ?></p>
        </div>


        <form method="POST" action="" class="col-md-12 card inclined-card p-3 mt-3">

            <!-- ============== HIDDEN DATA ==============  -->
            <input type="text" name="fee_school_id" value="<?php echo $session_user_id ?>" hidden>
            <input type="text" name="fee_school_student_id" value="<?php echo $student_id ?>" hidden>
            <input type="text" name="fee_assigned_class" value="<?php echo $student_assigned_class ?>" hidden>
            <!-- ============== HIDDEN DATA ==============  -->

            <div id='new-input-field' class='mob-flex d-flex justify-content-center align-items-center w-100 mb-3'>
                <div class="form-floating w-100 m-1">
                    <select class="form-select" id="floatingSelect" name="fee_collection_type"
                        aria-label="Floating label select example">
                        <option value="0">Click here</option>
                        <?php
                                    require_once('main/config.php');
                                    if (!empty($_SESSION['user_type'])) {
                                        $session_user_id = $_SESSION['user_id'];
                                    } else {
                                        $session_user_id = 0;
                                    }

                                    $fetch_class = "SELECT * FROM `school_fee` WHERE `fee_school_id` = $session_user_id GROUP BY fee_type";
                                    $fetch_result = mysqli_query($connection, $fetch_class);

                                    while ($row = mysqli_fetch_assoc($fetch_result)) {
                                        $fee_id = $row['fee_id'];
                                        $fee_type = $row['fee_type'];
                                        $fee_tenure = $row['fee_tenure'];
                                        $fee_amount = $row['fee_amount'];

                                        if ($fee_type == 1) {
                                            $fee_type_name = "Registration Fee";
                                        }
                                        if ($fee_type == 2) {
                                            $fee_type_name = "Monthly Fee";
                                        }
                                        if ($fee_type == 3) {
                                            $fee_type_name = "Uniform | School Dress Fee";
                                        }
                                        if ($fee_type == 4) {
                                            $fee_type_name = "Admission Fee";
                                        }
                                        if ($fee_type == 5) {
                                            $fee_type_name = "Sports Fee";
                                        }
                                        if ($fee_type == 6) {
                                            $fee_type_name = "Computer Lab Fee";
                                        }
                                        if ($fee_type == 7) {
                                            $fee_type_name = "Diary Card Fee";
                                        }
                                        if ($fee_type == 8) {
                                            $fee_type_name = "Transportation Fee";
                                        }
                                        if ($fee_type == 9) {
                                            $fee_type_name = "Fooding Fee";
                                        }
                                        if ($fee_type == 10) {
                                            $fee_type_name = "Music Fee";
                                        }
                                        if ($fee_type == 11) {
                                            $fee_type_name = "Sports Fee";
                                        }
                                        if ($fee_type == 12) {
                                            $fee_type_name = "Onlyn Nerdy Parent Login Fee";
                                        }
                                        if ($fee_type == 13) {
                                            $fee_type_name = "Stationary Fee";
                                        }
                                        if ($fee_type == 14) {
                                            $fee_type_name = "Field Trips & Outing Fee";
                                        }
                                        if ($fee_type == 15) {
                                            $fee_type_name = "Medical Facility Fee";
                                        }
                                        if ($fee_type == 16) {
                                            $fee_type_name = "Yearly Book Fee";
                                        }
                                        if ($fee_type == 17) {
                                            $fee_type_name = "Exam Fee";
                                        }
                                        if ($fee_type == 18) {
                                            $fee_type_name = "Annual Fee";
                                        }

                                        if ($fee_tenure == 1) {
                                            $fee_tenure_name = "Monthly";
                                        }
                                        if ($fee_tenure == 2) {
                                            $fee_tenure_name = "Quarterly";
                                        }
                                        if ($fee_tenure == 3) {
                                            $fee_tenure_name = "Half Yearly";
                                        }
                                        if ($fee_tenure == 4) {
                                            $fee_tenure_name = "Annually";
                                        }
                                        if ($fee_tenure == 5) {
                                            $fee_tenure_name = "One Time";
                                        }
                                    ?>
                        <option value="<?php echo $fee_id ?>">
                            <?php echo $fee_type_name . " (" . $fee_tenure_name . " - ₹" .  $fee_amount . " )" ?>
                        </option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelect">Fee Type</label>
                </div>

                <div class='form-floating w-100 m-1'>
                    <input type='month' name='fee_collection_date' class='form-control' id='floatingContact'
                        placeholder='Mobile Number'>
                    <label for='floatingContact'>For the month of</label>
                </div>

                <!-- <div class='form-floating w-100 m-1'>
                    <input disabled type='number' name='fee_collection_amount' value="<?php echo $fee_amount ?>"
                        class='form-control' id='floatingContact' placeholder='<?php echo "₹" . $fee_amount ?>'>
                    <label for='floatingContact'>Amount (in ₹)</label>
                </div> -->

                <div class='form-floating w-100 m-1'>
                    <input type='text' name='fee_collection_receipt' class='form-control' id='floatingContact'
                        placeholder='Mobile Number'>
                    <label for='floatingContact'>Receipt Number</label>
                </div>
            </div>

            <button type="submit" name="collect" class="btn btn-outline-primary mb-3">
                <ion-icon name="checkmark-circle-outline" class="m-0"></ion-icon> Collect
            </button>
        </form>
        <?php
                }
            } else if ($count == 0) { ?>
        <div class="alert alert-danger" role="alert">No Student Found !</div>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php include('main/footer.php'); ?>