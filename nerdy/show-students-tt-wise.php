<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/teacher-side-nav.php') ?>
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
            $tt_class = $_POST['tt_class'];

            $query = "SELECT * FROM students WHERE student_assigned_class = $tt_class";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);
        ?>

        <!-- <div class="notification mb-3">
            <p class="m-0">Total students in this class: <span><?php echo $count ?></span></p>
        </div> -->
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
                    <th scope="row"><?php echo $student_roll_number ?></th>
                    <td><?php echo $student_name ?></td>
                    <?php
                            if ($student_login == 1) { ?>
                    <td>Active</td>
                    <?php } else if ($student_login == 2) { ?>
                    <td>In-Active</td>
                    <?php
                            }
                            ?>
                </tr>


                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('main/footer.php'); ?>