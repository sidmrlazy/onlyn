<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="megaphone" class="section-heading-icon"></ion-icon>
                Update Fee Structure
            </h3>
            <p class="section-desc">Select the tenure of the fee payment for this student</p>
        </div>

        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
            $session_user_contact = $_SESSION['user_contact'];
            $session_user_type = $_SESSION['user_type'];
        } else {
            $session_user_id = 0;
        }

        if (isset($_POST['update'])) {
            $student_id = $_POST['student_id'];
            $student_fee_tenure = $_POST['student_fee_tenure'];

            $update = "UPDATE `students` SET `student_fee_tenure`=$student_fee_tenure WHERE student_id = $student_id";
            $update_res = mysqli_query($connection, $update);
        }

        if (isset($_POST['edit'])) {
            $student_id = $_POST['student_id'];

            $query = "SELECT * FROM `students` WHERE student_id = $student_id";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $student_id = $row['student_id'];
                $student_roll_number = $row['student_roll_number'];
                $student_name = $row['student_name'];
                $student_fee_tenure = $row['student_fee_tenure'];
        ?>

        <form action="" method="POST" class="card p-3">
            <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
            <div class="w-100 d-flex mb-3">
                <div class="w-100 m-1 form-floating">
                    <input type="number" name="student_roll_number" class="form-control" id="floatingInput"
                        placeholder="Roll Number" value="<?php echo $student_roll_number ?>" readonly>
                    <label for="floatingInput">Roll Number</label>
                </div>
                <div class="w-100 m-1 form-floating">
                    <input type="text" name="student_name" class="form-control" id="floatingInput"
                        placeholder="name@example.com" value="<?php echo $student_name ?>" readonly>
                    <label for="floatingInput">Student's Full Name</label>
                </div>
            </div>

            <div class="form-floating mb-3 w-100">
                <select class="form-select" name="student_fee_tenure" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option>Click here to open list</option>
                    <?php
                            $fetch_tenure = "SELECT * FROM school_fee WHERE fee_school_id = $session_user_id";
                            $fetch_tenure_result = mysqli_query($connection, $fetch_tenure);

                            while ($row = mysqli_fetch_assoc($fetch_tenure_result)) {
                                $fee_tenure = $row['fee_tenure'];
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
                    <option value="<?php echo $fee_tenure ?>"><?php echo $fee_tenure_name  ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Fee Tenure</label>
            </div>

            <button type="submit" name="update" class="btn btn-outline-success p-3 mt-3">Update Fee Structure</button>
        </form>

        <?php }
        } ?>
    </div>
</div>
<?php include('main/footer.php'); ?>