<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container table-responsive animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="person" class="section-heading-icon"></ion-icon>
                Students
            </h3>
            <p class="section-desc">Showing monthly fee payment student wise</p>
        </div>

        <div class="table-responsive card p-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Month</th>
                        <th scope="col">Fee Paid for</th>
                        <th scope="col">Fee Status</th>
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
                        $fee_assigned_class = $_POST['fee_assigned_class'];
                        $fee_collection_date = $_POST['fee_collection_date'];

                        $query = "SELECT * FROM `fee_collection` WHERE `fee_assigned_class` = $fee_assigned_class AND `fee_collection_date` = '$fee_collection_date'";
                        $res = mysqli_query($connection, $query);

                        if (!$res) {
                            die('ERROR');
                        } else {

                            $fee_collection_status = "";
                            $fee_assigned_class = "";
                            while ($row = mysqli_fetch_assoc($res)) {
                                $fee_school_student_id = $row['fee_school_student_id'];
                                $fee_collection_type = $row['fee_collection_type'];
                                $fee_collection_status = $row['fee_collection_status'];
                                $fee_assigned_class = $row['fee_assigned_class'];

                                $fetch_fee_det = "SELECT * FROM school_fee WHERE fee_id = $fee_collection_type";
                                $fetch_fee_res = mysqli_query($connection, $fetch_fee_det);
                                $fee_type = "";
                                while ($row = mysqli_fetch_assoc($fetch_fee_res)) {
                                    $fee_type = $row['fee_type'];
                                }
                            }

                            $data = "SELECT * FROM `students` WHERE `student_assigned_class` = '$fee_assigned_class'";
                            $result = mysqli_query($connection, $data);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $student_id = $row['student_id'];
                                $student_roll_number = $row['student_roll_number'];
                                $student_name = $row['student_name'];
                    ?>
                    <tr>
                        <td><?php echo $student_roll_number ?></td>
                        <th scope="row"><?php echo $student_name ?></th>
                        <td><?php echo date('M-Y', strtotime($fee_collection_date)) ?></td>

                        <?php
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

                                    ?>

                        <td><?php echo $fee_type_name ?></td>
                        <?php if ($student_id === $fee_school_student_id && $fee_collection_status == 1) { ?>
                        <td class="text-center d-flex justify-content-center align-items-center">
                            <p class="paid-pill">Paid</p>
                        </td>
                        <?php } else { ?>
                        <td class="text-center d-flex justify-content-center align-items-center">
                            <p class="un-paid-pill">Not Paid</p>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php
                            }
                        }
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>