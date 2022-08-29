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
            <p class="section-desc">Showing class wise students</p>
        </div>
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }
        if (isset($_POST['submit'])) {
            $class_id = $_POST['class_id'];

            $query = "SELECT * FROM students WHERE student_assigned_class = $class_id";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);
        ?>

        <div class="notification mb-3">
            <p class="m-0">Total students in this class: <span><?php echo $count ?></span></p>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Fee Structure</th>
                        <th scope="col">Total Fee</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $student_id = $row['student_id'];
                            $student_roll_number = $row['student_roll_number'];
                            $student_name = $row['student_name'];
                            $student_login = $row['student_login'];
                            $student_fee_tenure = $row['student_fee_tenure'];

                            if ($student_fee_tenure == 1) {
                                $student_fee_tenure_name = "Monthly";
                            }
                            if ($student_fee_tenure == 2) {
                                $student_fee_tenure_name = "Quarterly";
                            }
                            if ($student_fee_tenure == 3) {
                                $student_fee_tenure_name = "Half Yearly";
                            }
                            if ($student_fee_tenure == 4) {
                                $student_fee_tenure_name = "Annually";
                            }
                            if ($student_fee_tenure == 5) {
                                $student_fee_tenure_name = "One Time";
                            }

                            $fee_query = "SELECT * FROM school_fee WHERE fee_tenure = '$student_fee_tenure'";
                            $fee_result = mysqli_query($connection, $fee_query);

                            $fee_tenure = "";
                            $fee_amount = "";
                            while ($row = mysqli_fetch_assoc($fee_result)) {
                                $fee_tenure = $row['fee_tenure'];
                                $fee_amount = $row['fee_amount'];
                            }
                        ?>
                    <form action="edit-student-fee-structure.php" method="POST">
                        <tr>
                            <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
                            <th scope="row"><?php echo $student_roll_number ?></th>
                            <td><?php echo $student_name ?></td>
                            <td><?php echo $student_fee_tenure_name ?></td>
                            <td>₹<?php echo $fee_amount ?></td>
                            <td class="text-center">
                                <!-- <button type="submit" name="del" class="btn">
                                <ion-icon name="trash-outline" class="del-btn-icon"></ion-icon>
                            </button> -->
                                <button type="submit" name="edit" class="btn">
                                    <ion-icon name="create-outline" class="edit-btn-icon"></ion-icon>
                                </button>
                            </td>
                        </tr>
                    </form>

                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>