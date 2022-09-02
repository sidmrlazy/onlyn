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
            <?php
            if (isset($_POST['submit'])) {
                $fee_assigned_class = $_POST['fee_assigned_class'];
                $fee_collection_date = $_POST['fee_collection_date'];
                $fetched_fee_type = $_POST['fee_type'];


                $fetch = "SELECT * FROM school_fee WHERE fee_id = $fetched_fee_type";
                $fetch_r = mysqli_query($connection, $fetch);

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
            <php class="section-desc">Showing <strong><?php echo $fetched_fee_type_name ?></strong></p>
        </div>

        <div class="card p-3 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['submit'])) {
                        $fee_assigned_class = $_POST['fee_assigned_class'];
                        $fee_collection_date = $_POST['fee_collection_date'];
                        $fetched_fee_type = $_POST['fee_type'];
                        $fetched_fee_collection_status = $_POST['fee_collection_status'];

                        $query = "SELECT * FROM `students` WHERE `student_assigned_class` = '$fee_assigned_class'";
                        $result = mysqli_query($connection, $query);

                        $fetch_fee_data = "SELECT * FROM school_fee WHERE fee_id = $fetched_fee_type";
                        $fetch_fee_res = mysqli_query($connection, $fetch_fee_data);

                        $fee_type = "";
                        while ($row = mysqli_fetch_assoc($fetch_fee_res)) {
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

                        $student_id = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $student_id = $row['student_id'];
                            $student_roll_number = $row['student_roll_number'];
                            $student_name = $row['student_name'];


                            $data = "SELECT * FROM `fee_collection` WHERE `fee_school_student_id` = $student_id AND `fee_collection_date` = '$fee_collection_date' AND fee_collection_type = '$fetched_fee_type' GROUP BY fee_school_student_id";
                            $res = mysqli_query($connection, $data);

                            while ($row = mysqli_fetch_assoc($res)) {
                                $fee_school_student_id = $row['fee_school_student_id'];
                                $fee_collection_type = $row['fee_collection_type'];
                                $fee_collection_status = $row['fee_collection_status'];

                                if ($student_id == $fee_school_student_id && $fetched_fee_collection_status == 1) {
                    ?>

                                    <tr>
                                        <td><?php echo $student_roll_number ?></td>
                                        <td><?php echo $student_name ?></td>
                                        <td>Paid</td>
                                    </tr>

                                    <?php
                                    // echo $student_name . " " . $fetched_fee_collection_status . "<br>";
                                } else if (!$fetched_fee_collection_status) {
                                    $fetch_data = "SELECT * FROM `students` WHERE student_id = $student_id";
                                    $fetch_res = mysqli_query($connection, $fetch_data);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $student_id = $row['student_id'];
                                        $student_roll_number = $row['student_roll_number'];
                                        $student_name = $row['student_name']; ?>
                                        <tr>
                                            <td><?php echo $student_roll_number ?></td>
                                            <td><?php echo $student_name ?></td>
                                            <td>Unpaid</td>
                                        </tr>

                    <?php
                                    }
                                }
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