<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Select Class
            </h3>
            <p class="section-desc">Caption Needed</p>
        </div>

        <form method="POST" action="show-fee-defaulting-students.php" class="col-md-10 card p-3">
            <input type="text" name="student_assigned_school" value="<?php echo $session_user_id ?>" hidden>
            <div id='new-input-field' class='mob-flex d-flex justify-content-center align-items-center w-100 mb-3'>
                <div class="form-floating w-100 m-1">
                    <select class="form-select" id="floatingSelect" name="fee_assigned_class"
                        aria-label="Floating label select example">
                        <option value="0">Click here</option>
                        <?php
                        require_once('main/config.php');
                        if (!empty($_SESSION['user_type'])) {
                            $session_user_id = $_SESSION['user_id'];
                        } else {
                            $session_user_id = 0;
                        }

                        $fetch_class = "SELECT * FROM `classes` WHERE `class_added_by` = $session_user_id";
                        $fetch_result = mysqli_query($connection, $fetch_class);

                        while ($row = mysqli_fetch_assoc($fetch_result)) {
                            $class_id = $row['class_id'];
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];
                        ?>
                        <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?></option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelect">Select Class</label>
                </div>

                <div class='form-floating w-100 m-1'>
                    <input type='month' name='fee_collection_date' class='form-control' id='floatingContact'
                        placeholder='Mobile Number'>
                    <label for='floatingContact'>Select Month</label>
                </div>

                <div class="form-floating w-100 m-1">
                    <select class="form-select" id="floatingSelect" name="fee_type"
                        aria-label="Floating label select example">
                        <option value="0">Click here</option>
                        <?php
                        require_once('main/config.php');
                        if (!empty($_SESSION['user_type'])) {
                            $session_user_id = $_SESSION['user_id'];
                        } else {
                            $session_user_id = 0;
                        }

                        $fetch_class = "SELECT * FROM `school_fee` WHERE `fee_school_id` = $session_user_id";
                        $fetch_result = mysqli_query($connection, $fetch_class);

                        while ($row = mysqli_fetch_assoc($fetch_result)) {
                            $fee_id = $row['fee_id'];
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
                        ?>
                        <option value="<?php echo $fee_id ?>"><?php echo $fee_type ?></option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelect">Select Fee Type</label>
                </div>

                <!-- <div class="form-floating w-100 m-1">
                    <select class="form-select" id="floatingSelect" name="fee_collection_status"
                        aria-label="Floating label select example">
                        <option value="0">Click here</option>
                        <option value="1">Paid</option>
                        <option value="">Unpaid</option>
                    </select>
                    <label for="floatingSelect">Status Type</label>
                </div> -->
            </div>

            <button type="submit" name="submit" class="btn btn-outline-success mb-3">
                <ion-icon name="search-outline"></ion-icon> SEARCH
            </button>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>