<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container table-responsive animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="shapes" class="section-heading-icon"></ion-icon>
                Status
            </h3>
            <?php
            if (isset($_POST['submit'])) {
                $fee_assigned_class = $_POST['fee_assigned_class'];
                $fee_collection_date = $_POST['fee_collection_date'];
                $fetched_fee_type = $_POST['fee_type'];


                $fetch = "SELECT * FROM school_fee WHERE fee_id = $fetched_fee_type";
                $fetch_r = mysqli_query($connection, $fetch);

                $fetch_student_data = "SELECT * FROM `students` WHERE student_assigned_class = $fee_assigned_class";
                $fetch_student_data_res = mysqli_query($connection, $fetch_student_data);
                $fetch_student_count = mysqli_num_rows($fetch_student_data_res);

                $fee_type = "";
                while ($row = mysqli_fetch_assoc($fetch_r)) {
                    $fee_type = $row['fee_type'];
                }

                if ($fee_type == 1) {
                    $fetched_fee_type_name = "Registration Fee";
                }
                if ($fee_type == 2) {
                    $fetched_fee_type_name = "Monthly Fee";
                }
                if ($fee_type == 3) {
                    $fetched_fee_type_name = "Uniform | School Dress Fee";
                }
                if ($fee_type == 4) {
                    $fetched_fee_type_name = "Admission Fee";
                }
                if ($fee_type == 5) {
                    $fetched_fee_type_name = "Sports Fee";
                }
                if ($fee_type == 6) {
                    $fetched_fee_type_name = "Computer Lab Fee";
                }
                if ($fee_type == 7) {
                    $fetched_fee_type_name = "Diary Card Fee";
                }
                if ($fee_type == 8) {
                    $fetched_fee_type_name = "Transportation Fee";
                }
                if ($fee_type == 9) {
                    $fetched_fee_type_name = "Fooding Fee";
                }
                if ($fee_type == 10) {
                    $fetched_fee_type_name = "Music Fee";
                }
                if ($fee_type == 11) {
                    $fetched_fee_type_name = "Sports Fee";
                }
                if ($fee_type == 12) {
                    $fetched_fee_type_name = "Onlyn Nerdy Parent Login Fee";
                }
                if ($fee_type == 13) {
                    $fetched_fee_type_name = "Stationary Fee";
                }
                if ($fee_type == 14) {
                    $fetched_fee_type_name = "Field Trips & Outing Fee";
                }
                if ($fee_type == 15) {
                    $fetched_fee_type_name = "Medical Facility Fee";
                }
                if ($fee_type == 16) {
                    $fetched_fee_type_name = "Yearly Book Fee";
                }
                if ($fee_type == 17) {
                    $fetched_fee_type_name = "Exam Fee";
                }
                if ($fee_type == 18) {
                    $fetched_fee_type_name = "Annual Fee";
                }
            }

            ?>
            <p class="section-desc">
                Showing students that have paid the
                <strong><?php echo $fetched_fee_type_name ?></strong>
            </p>
            <p>Total Students in this class: <?php echo $fetch_student_count; ?></p>
        </div>

        <div class="student-grid">
            <?php
            if (isset($_POST['submit'])) {
                $fee_assigned_class = $_POST['fee_assigned_class'];
                $fee_collection_date = $_POST['fee_collection_date'];
                $fetched_fee_type = $_POST['fee_type'];

                $fetch_details = "SELECT * FROM school_fee WHERE fee_id = $fetched_fee_type";
                $fetch_res = mysqli_query($connection, $fetch_details);

                $fee_type = "";
                $fetched_fee_type_name = "";
                while ($row = mysqli_fetch_assoc($fetch_res)) {
                    $fee_type = $row['fee_type'];

                    if ($fee_type == 1) {
                        $fetched_fee_type_name = "Registration Fee";
                    }
                    if ($fee_type == 2) {
                        $fetched_fee_type_name = "Monthly Fee";
                    }
                    if ($fee_type == 3) {
                        $fetched_fee_type_name = "Uniform | School Dress Fee";
                    }
                    if ($fee_type == 4) {
                        $fetched_fee_type_name = "Admission Fee";
                    }
                    if ($fee_type == 5) {
                        $fetched_fee_type_name = "Sports Fee";
                    }
                    if ($fee_type == 6) {
                        $fetched_fee_type_name = "Computer Lab Fee";
                    }
                    if ($fee_type == 7) {
                        $fetched_fee_type_name = "Diary Card Fee";
                    }
                    if ($fee_type == 8) {
                        $fetched_fee_type_name = "Transportation Fee";
                    }
                    if ($fee_type == 9) {
                        $fetched_fee_type_name = "Fooding Fee";
                    }
                    if ($fee_type == 10) {
                        $fetched_fee_type_name = "Music Fee";
                    }
                    if ($fee_type == 11) {
                        $fetched_fee_type_name = "Sports Fee";
                    }
                    if ($fee_type == 12) {
                        $fetched_fee_type_name = "Onlyn Nerdy Parent Login Fee";
                    }
                    if ($fee_type == 13) {
                        $fetched_fee_type_name = "Stationary Fee";
                    }
                    if ($fee_type == 14) {
                        $fetched_fee_type_name = "Field Trips & Outing Fee";
                    }
                    if ($fee_type == 15) {
                        $fetched_fee_type_name = "Medical Facility Fee";
                    }
                    if ($fee_type == 16) {
                        $fetched_fee_type_name = "Yearly Book Fee";
                    }
                    if ($fee_type == 17) {
                        $fetched_fee_type_name = "Exam Fee";
                    }
                    if ($fee_type == 18) {
                        $fetched_fee_type_name = "Annual Fee";
                    }
                }

                $query = "SELECT * FROM `fee_collection`";
                $query .= "WHERE `fee_collection_date` = '$fee_collection_date' AND fee_assigned_class = $fee_assigned_class AND fee_collection_type = $fetched_fee_type";
                $result = mysqli_query($connection, $query);

                $count = mysqli_num_rows($result);

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fee_school_student_id = $row['fee_school_student_id'];
                        $fee_collection_status = $row['fee_collection_status'];
                        $fee_collection_receipt = $row['fee_collection_receipt'];
                        $fee_collection_added_date = $row['fee_collection_added_date'];
                        $fee_collection_type = $row['fee_collection_type'];

                        $fetch_student_details = "SELECT * FROM students WHERE student_id = $fee_school_student_id";
                        $fetch_student_res = mysqli_query($connection, $fetch_student_details);
                        $student_name = "";
                        while ($row = mysqli_fetch_assoc($fetch_student_res)) {
                            $student_roll_number = $row['student_roll_number'];
                            $student_name = $row['student_name'];
                        }

            ?>

            <div class="student-fee-tab">

                <p class="student-fee-name"><?php echo $student_name ?></p>
                <p class="student-fee-receipt-number">Receipt number: <?php echo $fee_collection_receipt ?></p>

                <div class="student-fee-row">
                    <?php
                                if ($fee_collection_status == 1) { ?>
                    <p class="fee-paid">PAID</p>
                    <?php } ?>
                    <p class="fee-date"><?php echo $fee_collection_added_date ?></p>
                </div>
            </div>

            <?php
                    }
                } else if ($count == 0) { ?>
            <p>NO DATA FOUND</p>

            <?php
                }
            }
            ?>
        </div>







    </div>
</div>
<?php include('main/footer.php'); ?>