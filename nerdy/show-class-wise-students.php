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
        <div class="table-responsive card p-4 col-md-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Parent Login Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $student_roll_number = $row['student_roll_number'];
                            $student_name = $row['student_name'];
                            $student_login = $row['student_login'];
                        ?>
                    <tr>
                        <td><?php echo $student_roll_number ?></td>
                        <th scope="row"><?php echo $student_name ?></th>
                        <?php if ($student_login == 1) { ?>
                        <td class="text-center d-flex justify-content-center align-items-center">
                            <p class="paid-pill">Active</p>
                        </td>

                        <?php } else if ($student_login == 2) { ?>
                        <td class="text-center d-flex justify-content-center align-items-center">
                            <p class="un-paid-pill">Inactive</p>
                        </td>
                        <?php } ?>
                    </tr>


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