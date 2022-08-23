<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex">
    <?php include('navbar/teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="person" class="section-heading-icon"></ion-icon>
                Parent Login
            </h3>
            <p class="section-desc">Click on Activate|Disable Button to select students for activating or disabling
                parent
                login</p>
        </div>

        <div class="card p-4 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Roll Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['activate'])) {
                        $student_id = $_POST['student_id'];
                        $student_login = 1;

                        $update_query = "UPDATE `students` SET `student_login`= $student_login WHERE student_id = $student_id";
                        $update_result = mysqli_query($connection, $update_query);
                        if ($update_result) {
                            echo "<script>parentLoginConfirmation()</script>";
                        } else {
                            die(mysqli_error($connection));
                        }
                    }

                    if (isset($_POST['disable'])) {
                        $student_id = $_POST['student_id'];
                        $student_login = 2;

                        $update_query = "UPDATE `students` SET `student_login`= $student_login WHERE student_id = $student_id";
                        $update_result = mysqli_query($connection, $update_query);
                        if ($update_result) {
                            echo "<script>parentDisabledConfirmation()</script>";
                        } else {
                            die(mysqli_error($connection));
                        }
                    }

                    $query_students = "SELECT * FROM `students` WHERE student_added_by = $session_user_id";
                    $result_students = mysqli_query($connection, $query_students);
                    $student_name = "";
                    while ($row = mysqli_fetch_assoc($result_students)) {
                        $student_id = $row['student_id'];
                        $student_roll_number = $row['student_roll_number'];
                        $student_name = $row['student_name'];
                        $student_login = $row['student_login']; ?>

                    <tr>
                        <form action="" method="POST">
                            <input type="text" name="student_id" value="<?php echo $student_id ?>" hidden>
                            <th scope="row"><?php echo $student_roll_number ?></th>
                            <td><?php echo $student_name ?></td>
                            <?php
                                if ($student_login == 2) { ?>
                            <td>In-Active</td>
                            <?php } else if ($student_login == 1) { ?>
                            <td>Active</td>
                            <?php
                                }
                                ?>
                            <?php
                                if ($student_login == 2) { ?>
                            <td>
                                <button type="submit" name="activate" value="1" class="btn btn-sm btn-success">
                                    Activate
                                </button>
                            </td>
                            <?php } else if ($student_login == 1) { ?>
                            <td>
                                <button type="submit" name="disable" value="2" class="btn btn-sm btn-warning">
                                    Disable
                                </button>
                            </td>
                            <?php
                                }
                                ?>

                        </form>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>