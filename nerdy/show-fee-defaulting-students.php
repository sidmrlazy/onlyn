<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
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
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Month</th>
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