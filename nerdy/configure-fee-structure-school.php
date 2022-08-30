<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="mb-5">
            <div class="section-header">
                <h3 class="section-heading">
                    <ion-icon name="cog" class="section-heading-icon"></ion-icon>
                    Configure Fee Structure
                </h3>
                <p class="section-desc">Setup fee structure according to your school</p>
            </div>

            <?php
            if (isset($_POST['add-fee'])) {
                $fee_class_id = $_POST['fee_class_id'];
                $fee_type = $_POST['fee_type'];
                $fee_tenure = $_POST['fee_tenure'];
                $fee_amount = $_POST['fee_amount'];
                $session_user_id;

                if ($fee_class_id == "Select Class") {
                    echo "<script>emptyClass()</script>";
                } else {
                    $query = "INSERT INTO `school_fee`(
                        `fee_class_id`,
                        `fee_type`,
                        `fee_tenure`,
                        `fee_amount`,
                        `fee_school_id`
                    )
                    VALUES(
                        '$fee_class_id',
                        '$fee_type',
                        '$fee_tenure',
                        '$fee_amount',
                        '$session_user_id')";
                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die(mysqli_error($connection));
                    } else {
                        echo "<script>feeAdded()</script>";
                    }
                }
            }

            ?>

            <form action="" method="POST" class="card p-3 col-md-12">
                <div class="horizontal-form-row mob-flex">
                    <select class="form-select equal-flex m-1" name="fee_class_id" aria-label="Default select example">
                        <option selected>Select Class</option>
                        <?php
                        require_once('main/config.php');
                        if (!empty($_SESSION['user_type'])) {
                            $session_user_id = $_SESSION['user_id'];
                        } else {
                            $session_user_id = 0;
                        }

                        $get_classes = "SELECT * FROM classes WHERE class_added_by = $session_user_id GROUP BY class_name";
                        $get_classes_result = mysqli_query($connection, $get_classes);
                        while ($row = mysqli_fetch_assoc($get_classes_result)) {
                            $class_id = $row['class_id'];
                            $class_name = $row['class_name'];
                        ?>
                        <option value="<?php echo $class_id ?>"><?php echo $class_name ?></option>
                        <?php } ?>
                    </select>

                    <select class="form-select equal-flex m-1" name="fee_type" aria-label="Default select example">
                        <option selected>Select Fee Type</option>
                        <option value="1">Registration Fee</option>
                        <option value="2">Monthly Fee</option>
                        <option value="3">Uniform | School Dress Fee</option>
                        <option value="4">Admission Fee</option>
                        <option value="5">Sports Fee</option>
                        <option value="6">Computer Lab Fee</option>
                        <option value="7">Diary Card Fee</option>
                        <option value="8">Transportation Fee</option>
                        <option value="9">Fooding Fees</option>
                        <option value="10">Music Fees</option>
                        <option value="11">Sports Fees</option>
                        <option value="12">Onlyn Nerdy Parent Login Fee</option>
                        <option value="13">Stationary Fee</option>
                        <option value="14">Field Trips & Outing Fee</option>
                        <option value="15">Medical Facility Fee</option>
                        <option value="16">Yearly Book Fee</option>
                        <option value="17">Exam Fee</option>
                        <option value="18">Annual Fee</option>
                    </select>

                    <select class="form-select equal-flex m-1" name="fee_tenure" aria-label="Default select example">
                        <option selected>Fee Tenure</option>
                        <option value="1">Monthly</option>
                        <option value="2">Quarterly</option>
                        <option value="3">Half Yearly</option>
                        <option value="4">Annually</option>
                        <option value="5">One Time</option>
                    </select>

                    <div class="input-group equal-flex m-1">
                        <span class="input-group-text">Amount (in ₹)</span>
                        <input type="number" name="fee_amount" class="form-control" aria-label="Rupee">
                    </div>

                    <button type="submit" name="add-fee" class="btn btn-sm btn-outline-success fee-btn">+</button>
                </div>
            </form>


            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Class</th>
                            <th scope="col">Fee Type</th>
                            <th scope="col">Tenure</th>
                            <th scope="col">Amount</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_POST['del'])) {
                            $fee_id = $_POST['fee_id'];

                            $del_query = "DELETE FROM `school_fee` WHERE fee_id = $fee_id";
                            $del_res = mysqli_query($connection, $del_query);

                            if (!$del_res) {
                                die(mysqli_error($connection));
                            } else {
                                echo "<script>deleteFee();</script>";
                            }
                        }

                        $query = "SELECT * FROM `school_fee` WHERE `fee_school_id` = $session_user_id";
                        $result = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $fee_id = $row['fee_id'];
                            $fee_class_id = $row['fee_class_id'];
                            $fee_type = $row['fee_type'];

                            if ($fee_type == 1) {
                                $fee_type = "Registration Fee";
                            }
                            if ($fee_type == 2) {
                                $fee_type = "Monthly Fee";
                            }
                            if ($fee_type == 3) {
                                $fee_type = "Uniform | School Dress Fee";
                            }
                            if ($fee_type == 4) {
                                $fee_type = "Admission Fee";
                            }
                            if ($fee_type == 5) {
                                $fee_type = "Sports Fee";
                            }
                            if ($fee_type == 6) {
                                $fee_type = "Computer Lab Fee";
                            }
                            if ($fee_type == 7) {
                                $fee_type = "Diary Card Fee";
                            }
                            if ($fee_type == 8) {
                                $fee_type = "Transportation Fee";
                            }
                            if ($fee_type == 9) {
                                $fee_type = "Fooding Fee";
                            }
                            if ($fee_type == 10) {
                                $fee_type = "Music Fee";
                            }
                            if ($fee_type == 11) {
                                $fee_type = "Sports Fee";
                            }
                            if ($fee_type == 12) {
                                $fee_type = "Onlyn Nerdy Parent Login Fee";
                            }
                            if ($fee_type == 13) {
                                $fee_type = "Stationary Fee";
                            }
                            if ($fee_type == 14) {
                                $fee_type = "Field Trips & Outing Fee";
                            }
                            if ($fee_type == 15) {
                                $fee_type = "Medical Facility Fee";
                            }
                            if ($fee_type == 16) {
                                $fee_type = "Yearly Book Fee";
                            }
                            if ($fee_type == 17) {
                                $fee_type = "Exam Fee";
                            }
                            if ($fee_type == 18) {
                                $fee_type = "Annual Fee";
                            }


                            $fee_tenure = $row['fee_tenure'];

                            if ($fee_tenure == 1) {
                                $fee_tenure = "Monthly";
                            }
                            if ($fee_tenure == 2) {
                                $fee_tenure = "Quarterly";
                            }
                            if ($fee_tenure == 3) {
                                $fee_tenure = "Half Yearly";
                            }
                            if ($fee_tenure == 4) {
                                $fee_tenure = "Annually";
                            }
                            if ($fee_tenure == 5) {
                                $fee_tenure = "One Time";
                            }

                            $fee_amount = $row['fee_amount'];

                            $class_query = "SELECT * FROM `classes` WHERE `class_id` = '$fee_class_id'";
                            $class_result = mysqli_query($connection, $class_query);
                            $class_name = "";
                            while ($row = mysqli_fetch_assoc($class_result)) {
                                $class_name = $row['class_name'];
                            }
                            if (
                                $class_name == 1 ||
                                $class_name == 2 ||
                                $class_name == 3 ||
                                $class_name == 4 ||
                                $class_name == 5 ||
                                $class_name == 6 ||
                                $class_name == 7 ||
                                $class_name == 8 ||
                                $class_name == 9 ||
                                $class_name == 10 ||
                                $class_name == 11 ||
                                $class_name == 12
                            ) {
                                $class_name = "Class " . $class_name;
                            }
                        ?>
                        <form action="" method="POST">
                            <tr>
                                <input type="text" name="fee_id" value="<?php echo $fee_id ?>" hidden>
                                <td class="p-3"><?php echo $class_name ?></td>
                                <td class="p-3"><?php echo $fee_type ?></td>
                                <td class="p-3"><?php echo $fee_tenure ?></td>
                                <td class="p-3">₹<?php echo $fee_amount ?></td>
                                <td class="text-center">
                                    <button type="submit" name="del" class="btn">
                                        <ion-icon name="trash-outline" class="del-btn-icon"></ion-icon>
                                    </button>
                                    <!-- <button type="submit" name="edit" class="btn">
                                        <ion-icon name="create-outline" class="edit-btn-icon"></ion-icon>
                                    </button> -->
                                </td>
                            </tr>
                        </form>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include('main/footer.php'); ?>