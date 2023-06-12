<?php include('includes/header.php') ?>
<?php include('components/navbar/admin-navbar.php') ?>
<div class="container user-form-container">
    <div class="page-marker">
        <a href="dashboard.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Collect Fee</h5>
    </div>
    <?php
    require('includes/connection.php');
    if (isset($_POST['collect'])) {
        $student_id = $_POST['student_id'];
        $fetch_data = "SELECT * FROM `bora_student` WHERE `student_id` = '$student_id'";
        $fetch_data_res = mysqli_query($connection, $fetch_data);

        $student_name = "";
        $student_course = "";
        $student_contact = "";
        $student_roll = "";

        while ($row = mysqli_fetch_assoc($fetch_data_res)) {
            $student_name = $row['student_name'];
            $student_course = $row['student_course'];
            $student_aadhar_address = $row['student_aadhar_address'];
            $student_contact = $row['student_contact'];
            $student_roll = $row['student_roll'];
        }
    }

    ?>
    <form class="add-user-form" method="POST" action="">
        <div class="receipt-upper-section">
            <img src="../assets/images/logo/brand-logo.webp" alt="">
            <h5>Bora Institute of Allied Health Sciences</h5>
            <p>Bora Institute of Nursing & Paramedical Sciences. Sewa Nagar, NH-24 Sitaur Road. Lucknow - 226201.
                <strong>Contact:</strong> +91 9569863933 | +91 9305748634. <br><strong>Email:</strong> abc@xyz.com.
                <strong>Website:</strong> borainstitute.com
            </p>
        </div>

        <div class="receipt-row">
            <div>
                <p>Invoice Number: <strong>BIAHS06230000001</strong></p>
            </div>

            <div>
                <p>Invoice Date</p>
                <input type="date" name="">
            </div>
        </div>

        <div class="receipt-billing-info-row">
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
                        <th scope="col">TENURE</th>
                        <th scope="col">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <select class="form-select w-100" aria-label="Default select example">
                                <option selected>Click here to open menu</option>
                                <option value="Examination">Examination</option>
                                <option value="Tution Fee">Tution Fee</option>
                            </select>
                        </th>
                        <td>
                            <select id="mySelect" onchange="showSelectedValue()" class="form-select w-100"
                                aria-label="Default select example">
                                <option selected>Click here to open menu</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Half Yearly">Half Yearly</option>
                                <option value="Annual">Annual</option>
                            </select>
                        </td>

                        <td>
                            <div>
                                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive mt-5">
            <table class="table">
                <thead class="table-header">
                    <tr class="bottom-table-header">
                        <th scope="col">GRAND TOTAL</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div>

        </div>
    </form>

</div>
<?php include('includes/footer.php') ?>