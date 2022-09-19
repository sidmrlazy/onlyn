<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header section-heading-row">
            <div class="section-flex">
                <h3 class="section-heading">
                    <ion-icon name="print" class="section-heading-icon"></ion-icon>
                    Fee Receipt
                </h3>
                <p class="section-desc">Enter the details given below and the registered mobile number through which the
                    parent sign's in the Onlyn Nerdy Panel</p>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $fee_month = $_POST['fee_month'];
            $fee_contact = $_POST['fee_contact'];

            $search_student_query = "SELECT * FROM `students` WHERE `student_father_contact` = '$fee_contact'";
            $search_student_result = mysqli_query($connection, $search_student_query);

            $student_id = "";
            $student_roll_number = "";
            $student_name = "";
            $student_assigned_class = "";
            $student_assigned_school = "";
            $student_address = "";
            $student_city = "";
            $student_state = "";
            $student_pincode = "";
            while ($row = mysqli_fetch_assoc($search_student_result)) {
                $student_id  = $row['student_id'];
                $student_roll_number  = $row['student_roll_number'];
                $student_name  = $row['student_name'];
                $student_assigned_class  = $row['student_assigned_class'];
                $student_assigned_school  = $row['student_assigned_school'];
                $student_address  = $row['student_address'];
                $student_city  = $row['student_city'];
                $student_state  = $row['student_state'];
                $student_pincode  = $row['student_pincode'];
            } ?>
        <!-- ============== STUDENT DETAILS ============== -->
        <div class="card p-3 mb-3 col-md-6">
            <div class="student-details-receipt">
                <p class="student-details-receipt-label">Roll Number: <?php echo $student_roll_number ?></p>
                <p class="student-details-receipt-name"><?php echo $student_name ?></p>
            </div>
            <p class="student-details-receipt-label">Address</p>
            <p class="student-details-receipt-address">
                <?php echo $student_address . ", " . $student_city . ". " . $student_state . " - " . $student_pincode ?>
            </p>
        </div>
        <!-- ============== STUDENT DETAILS ============== -->
        <?php
            $query = "SELECT * FROM `fee_collection` WHERE `fee_school_student_id` = '$student_id' AND `fee_collection_date` = '$fee_month'";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if ($count == 0) { ?>
        <p>Not Found</p>
        <?php
            } else if ($count > 0) {
                $fee_collection_date = "";

                while ($row = mysqli_fetch_assoc($result)) {
                    $fee_collection_added_date = $row['fee_collection_added_date'];
                    $fee_collection_type = $row['fee_collection_type'];
                    if ($fee_collection_type == 1) {
                        $fee_collection_type_name = "Registration Fee";
                    }
                    if ($fee_collection_type == 2) {
                        $fee_collection_type_name = "Monthly Fee";
                    }
                    if ($fee_collection_type == 3) {
                        $fee_collection_type_name = "Uniform | School Dress Fee";
                    }
                    if ($fee_collection_type == 4) {
                        $fee_collection_type_name = "Admission Fee";
                    }
                    if ($fee_collection_type == 5) {
                        $fee_collection_type_name = "Sports Fee";
                    }
                    $fee_collection_amount = $row['fee_collection_amount'];
                    $fee_collection_receipt = $row['fee_collection_receipt'];
                ?>
        <!-- ============== PAYMENT DETAILS ============== -->
        <div class="card mt-3 mb-3 p-3 receipt-details">
            <div class="receipt-flex">
                <p class="student-details-receipt-label">Date & Receipt Number</p>
                <p class="receipt-number"><?php echo $fee_collection_receipt ?></p>
                <p class="receipt-date">TXN date: <?php echo date('d-M-Y', strtotime($fee_collection_added_date)) ?></p>
            </div>

            <div class="receipt-flex">
                <p class="student-details-receipt-label">Fee Type</p>
                <p><?php echo $fee_collection_type_name ?></p>
            </div>
            <p class="receipt-fee-txn-amt">₹<?php echo $fee_collection_amount ?></p>
        </div>
        <!-- ============== PAYMENT DETAILS ============== -->
        <?php
                }
            }
        }
        ?>
    </div>
</div>
<?php include('main/footer.php'); ?>