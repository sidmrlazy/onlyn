<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">

        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Fee Structure Details
            </h3>
        </div>


        <div class="w-100 mt-3">
            <div class="tab-wrap-view table-responsive card p-4">
                <table class="table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th scope="col">Fee Type</th>
                            <th scope="col">Fee Tenure</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        require_once('main/config.php');
                        if (!empty($_SESSION['user_type'])) {
                            $session_user_id = $_SESSION['user_id'];
                        } else {
                            $session_user_id = 0;
                        }

                        if (isset($_POST['submit'])) {
                            $class_id = $_POST['class_id'];
                            $query = "SELECT * FROM `classes` WHERE `class_id` = '$class_id' GROUP BY `class_name`";
                            $result = mysqli_query($connection, $query);
                            if (!$result) {
                                die(mysqli_error($connection));
                            } else {
                                $class_id = "";
                                $class_name = "";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $class_id = $row['class_id'];
                                    $class_name = $row['class_name'];
                                }

                                $fetch_fee = "SELECT * FROM `school_fee` WHERE `fee_class_id` = $class_id AND `fee_school_id` = $session_user_id";
                                $fetch_fee_res = mysqli_query($connection, $fetch_fee);


                                while ($row = mysqli_fetch_assoc($fetch_fee_res)) {
                                    $fee_class_id = $row['fee_class_id'];
                                    $fee_type = $row['fee_type'];
                                    $fee_tenure = $row['fee_tenure'];
                                    $fee_amount = $row['fee_amount'];

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

                        <tr>
                            <td><?php echo $fee_type ?></td>
                            <td><?php echo $fee_tenure_name ?></td>
                            <td>₹<?php echo $fee_amount ?></td>
                        </tr>

                        <?php
                                }
                            }
                        }


                        ?>


                    </tbody>
                </table>

            </div>


            <!-- ============ TOTAL ANNUAL FEE START ============  -->
            <div class="fee-mini-card-holder">
                <?php
                $total_annual = intval("");
                $fetch_annual = "SELECT * FROM `school_fee` WHERE `fee_tenure` = 4 and `fee_class_id` = $fee_class_id";
                $fetch_annual_res = mysqli_query($connection, $fetch_annual);

                while ($row = mysqli_fetch_assoc($fetch_annual_res)) {
                    $total_annual += $row['fee_amount'];
                }
                ?>
                <div class="mini-card">
                    <p>Total Annual Fee : </p>
                    <php>₹<?php echo $total_annual; ?></p>
                </div>
                <!-- ============ TOTAL ANNUAL FEE END ============  -->

                <!-- ============ TOTAL ONE TIME FEE START ============  -->
                <?php
                $total_one_time = intval("");
                $one_time = "SELECT * FROM `school_fee` WHERE `fee_tenure` = 5 and `fee_class_id` = $fee_class_id";
                $one_time_res = mysqli_query($connection, $one_time);

                while ($row = mysqli_fetch_assoc($one_time_res)) {
                    $total_one_time += $row['fee_amount'];
                }
                ?>
                <div class="mini-card">
                    <p>Total One-Time Fee : </p>
                    <php>₹<?php echo $total_one_time; ?></p>
                </div>
                <!-- ============ TOTAL ONE TIME FEE END ============  -->

                <!-- ============ TOTAL MONTHLY FEE START ============  -->
                <?php
                $total_monthly = intval("");
                $fetch_monthly = "SELECT * FROM `school_fee` WHERE `fee_tenure` = 1 and `fee_class_id` = $fee_class_id";
                $fetch_monthly_res = mysqli_query($connection, $fetch_monthly);

                while ($row = mysqli_fetch_assoc($fetch_monthly_res)) {
                    $total_monthly += $row['fee_amount'];
                }
                ?>
                <div class="mini-card">
                    <p>Total Monthly Fee : </p>
                    <php>₹<?php echo $total_monthly; ?></p>
                </div>
                <!-- ============ TOTAL MONTHLY FEE START ============  -->


            </div>
        </div>

    </div>
</div>
<?php include('main/footer.php');  ?>