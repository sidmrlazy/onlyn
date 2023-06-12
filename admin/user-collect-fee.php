<?php include('includes/header.php') ?>
<?php include('components/navbar/user-navbar.php') ?>
<div class="container user-form-container">
    <div class="page-marker">
        <a href="dashboard.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Collect Fee</h5>
    </div>
    <?php
    require('includes/connection.php');
    if (isset($_COOKIE['user_id'])) {
        $user_contact = $_COOKIE['user_id'];
        $fetch_data = "SELECT * FROM `bora_users` WHERE `user_contact` = '$user_contact'";
        $fetch_res = mysqli_query($connection, $fetch_data);
        $user_name = "";
        while ($row = mysqli_fetch_assoc($fetch_res)) {
            $user_name = $row['user_name'];
        }
    }

    if (isset($_POST['collect'])) {
        $student_id = $_POST['student_id'];
        $fetch_data = "SELECT * FROM `bora_student` WHERE `student_id` = '$student_id'";
        $fetch_data_res = mysqli_query($connection, $fetch_data);

        $student_id = "";
        $student_name = "";
        $student_course = "";
        $student_contact = "";
        $student_roll = "";

        while ($row = mysqli_fetch_assoc($fetch_data_res)) {
            $student_id = $row['student_id'];
            $student_name = $row['student_name'];
            $student_course = $row['student_course'];
            $student_aadhar_address = $row['student_aadhar_address'];
            $student_contact = $row['student_contact'];
            $student_roll = $row['student_roll'];
        }
    }

    ?>
    <form class="add-user-form" method="POST" action="generate-invoice.php">
        <input type="text" name="bora_invoice_student_id" value="<?php echo $student_id ?>" hidden>
        <input type="text" name="bora_invoice_student_id" value="<?php echo $student_id ?>" hidden>
        <div class="receipt-upper-section">
            <img src="../assets/images/logo/brand-logo.webp" alt="">
            <h5>Bora Institute of Allied Health Sciences</h5>
            <p>Bora Institute of Nursing & Paramedical Sciences. Sewa Nagar, NH-24 Sitaur Road. Lucknow - 226201.
                <strong>Contact:</strong> +91 9569863933 | +91 9305748634. <br><strong>Email:</strong> abc@xyz.com.
                <strong>Website:</strong> borainstitute.com
            </p>
        </div>

        <div class="receipt-row">
            <?php
            $current_month = date('m');
            $current_year = date('y');
            $new_query = "SELECT * FROM `bora_invoice`";
            $new_res = mysqli_query($connection, $new_query);
            $bora_invoice_number = "";
            while ($row = mysqli_fetch_assoc($new_res)) {
                $bora_invoice_number = $row['bora_invoice_number'];
            }
            if ($bora_invoice_number && strpos($bora_invoice_number, $current_month . $current_year) !== false) {
                $last_number = intval(substr($bora_invoice_number, -4)) + 1;
            } else {
                $last_number = 1;
            }
            $receipt_number = 'BIAHS' . $current_month . $current_year . str_pad($last_number, 4, '0', STR_PAD_LEFT);
            ?>
            <div>
                <p>Invoice Number: <strong><?php echo $receipt_number; ?></strong></p>
                <input type="text" name="bora_invoice_number" value="<?php echo $receipt_number; ?>" hidden>
            </div>

            <div>
                <p>Invoice Date</p>
                <input type="date" name="bora_invoice_date" required>
            </div>
        </div>

        <div class="receipt-billing-info-row">
            <input type="text" name="bora_invoice_student" value="<?php echo $student_name ?>" hidden>
            <input type="text" name="bora_invoice_student_address" value="<?php echo $student_aadhar_address ?>" hidden>
            <input type="text" name="bora_invoice_student_contact" value="<?php echo $student_contact ?>" hidden>
            <input type="text" name="bora_invoice_student_course" value="<?php echo $student_course ?>" hidden>
            <div class="mt-3 recipient">
                <h6><strong>BILL TO</strong></h6>
                <h4><?php echo $student_name ?></h4>
                <p><?php echo $student_aadhar_address ?> | <?php echo $student_contact ?></p>
            </div>

            <div class="mt-3 recipient recipient-flex-end">
                <h6><strong>BILLING FOR</strong></h6>
                <h4><?php echo $student_course ?></h4>
            </div>
        </div>

        <div class="table-responsive mt-5">
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th scope="col">ITEM</th>
                        <th scope="col">SEMESTER</th>
                        <th scope="col">COLLECTING AMOUNT</th>
                        <th scope="col">DISCOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <select name="invoice_for" class="form-select w-100" aria-label="Default select example">
                                <option selected>Click here to open menu</option>
                                <option value="Examination">Examination Fee</option>
                                <option value="Tution Fee">Tution Fee</option>
                            </select>
                        </th>
                        <td>
                            <select name="invoice_tenure" class="form-select w-100" aria-label="Default select example">
                                <option selected>Click here to open menu</option>
                                <?php
                                $fetch_course_name = "SELECT * FROM `bora_course` WHERE `course_name` = '$student_course'";
                                $fetch_course_name_res = mysqli_query($connection, $fetch_course_name);
                                $course_id = "";
                                $course_name = "";
                                while ($row = mysqli_fetch_assoc($fetch_course_name_res)) {
                                    $course_id = $row['course_id'];
                                    $course_name = $row['course_name'];
                                }

                                $fetch_sem = "SELECT * FROM `bora_semester` WHERE `semester_course_id` = '$course_id'";
                                $fetch_sem_res = mysqli_query($connection, $fetch_sem);
                                while ($row = mysqli_fetch_assoc($fetch_sem_res)) {
                                    $semester_id = $row['semester_id'];
                                    $semester_name = $row['semester_name'];
                                    $semester_fee = $row['semester_fee'];
                                ?>
                                <option value="<?php echo $semester_name ?>">
                                    <?php echo $semester_name ?> | ₹(<?php echo $semester_fee ?>)
                                </option>
                                <?php } ?>
                            </select>
                        </td>

                        <td>
                            <div>
                                <input type="number" name="invoice_value" id="collectingAmount" class="form-control"
                                    id="exampleFormControlInput1" placeholder="">
                            </div>
                        </td>

                        <td>
                            <div>
                                <input type="number" name="invoice_disc" id="discount" class="form-control"
                                    id="exampleFormControlInput1" placeholder="">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="receipt-calculation-row">
            <div class="receipt-calculation">
                <h6>Discount:</h6>
                <p id="difference"></p>
            </div>

            <div class="receipt-calculation">
                <h6>Total Amount:</h6>
                <p id="output"></p>
            </div>
        </div>

        <button type="submit" name="generate" class="btn btn-success mt-3">Generate Invoice</button>
    </form>

</div>
<?php include('includes/footer.php') ?>