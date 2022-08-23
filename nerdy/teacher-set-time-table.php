<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex">
    <?php include('navbar/teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="calendar-outline" class="section-heading-icon"></ion-icon>
                Set Time Table
            </h3>
            <p class="section-desc">Set time table for your assigned class</p>
        </div>


        <?php
        $select_class = "SELECT * FROM classes WHERE class_teacher = $session_user_id";
        $select_class_result = mysqli_query($connection, $select_class);

        $class_id = "";
        $class_name = "";
        $class_section = "";
        while ($row = mysqli_fetch_assoc($select_class_result)) {
            $class_id = $row['class_id'];
            $class_name = $row['class_name'];
            $class_section = $row['class_section'];
        }

        $select_subject = "SELECT * FROM subjects WHERE subject_added_by = $user_added_by";
        $select_subject_result = mysqli_query($connection, $select_subject);

        $subject_name = "";
        while ($row = mysqli_fetch_assoc($select_subject_result)) {
            $subject_name = $row['subject_name'];
        }


        if (isset($_POST['submit'])) {
            $tt_day = $_POST['tt_day'];
            $tt_period = $_POST['tt_period'];
            $tt_subject = $_POST['tt_subject'];
            $tt_time = $_POST['tt_time'];
            $tt_teacher = $_POST['tt_teacher'];
            $user_name;
            $class_id;

            $create_tt = "INSERT INTO `time_table`(
                `tt_day`,
                `tt_period`,
                `tt_subject`,
                `tt_time`,
                `tt_teacher`,
                `tt_class`,
                `tt_created_by`
            )
            VALUES(
                '$tt_day',
                '$tt_period',
                '$tt_subject',
                '$tt_time',
                '$tt_teacher',
                '$class_id',
                '$session_user_id'
                )";
            $create_tt_res = mysqli_query($connection, $create_tt);
            if (!$create_tt_res) {
                die(mysqli_error($connection));
            } else {
                echo "<script>timeTableSuccess();</script>";
            }
        }


        ?>

        <form action="" method="POST" class="time-table-row">
            <div class="form-floating input-time-table">
                <select class="form-select" name="tt_day" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option selected>Days</option>
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                    <option value="7">Sunday</option>
                </select>
                <label for="floatingSelect">Select Day</label>
            </div>

            <div class="form-floating input-time-table">
                <input type="number" name="tt_period" class="form-control" id="floatingInput" placeholder="1st Period">
                <label for="floatingInput">Period (Ex: 1 / 2 / 3)</label>
            </div>

            <div class="form-floating input-time-table">
                <input type="time" class="form-control" name="tt_time" id="floatingInput" placeholder="00:00">
                <label for="floatingInput">Select Time</label>
            </div>
            <div class="form-floating input-time-table">
                <select class="form-select" name="tt_subject" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option selected>Subject List</option>
                    <?php
                    require_once('main/config.php');
                    if (!empty($_SESSION['user_type'])) {
                        $session_user_id = $_SESSION['user_id'];
                    } else {
                        $session_user_id = 0;
                    }
                    $fetch_admin = "SELECT * FROM `users` WHERE user_id = $session_user_id";
                    $fetch_admin_res = mysqli_query($connection, $fetch_admin);
                    $user_added_by = "";
                    while ($row = mysqli_fetch_assoc($fetch_admin_res)) {
                        $user_added_by = $row['user_added_by'];
                    }
                    $query = "SELECT * FROM subjects WHERE subject_added_by = $user_added_by";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $subject_id = $row['subject_id'];
                        $subject_name = $row['subject_name'];
                    ?>
                    <option value="<?php echo $subject_name ?>"><?php echo $subject_name ?></option>
                    <?php } ?>
                    <option value="Recess">Recess</option>
                </select>
                <label for="floatingSelect">Select Subject</label>
            </div>



            <div class="form-floating input-time-table">
                <select class="form-select" id="floatingSelect" name="tt_teacher"
                    aria-label="Floating label select example">
                    <option selected>Teacher List</option>
                    <?php
                    require_once('main/config.php');
                    if (!empty($_SESSION['user_type'])) {
                        $session_user_id = $_SESSION['user_id'];
                    } else {
                        $session_user_id = 0;
                    }
                    $fetch_admin = "SELECT * FROM `users` WHERE user_id = $session_user_id";
                    $fetch_admin_res = mysqli_query($connection, $fetch_admin);
                    $user_added_by = "";
                    while ($row = mysqli_fetch_assoc($fetch_admin_res)) {
                        $user_added_by = $row['user_added_by'];
                    }
                    $query = "SELECT * FROM users WHERE user_added_by = $user_added_by AND user_type = 3";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                    ?>
                    <option value="<?php echo $user_name ?>"><?php echo $user_name ?></option>
                    <?php } ?>
                    <option value="None">None</option>
                </select>
                <label for="floatingSelect">Select Teacher</label>
            </div>

            <button type="submit" name="submit" class="btn btn-sm btn-outline-success time-table-btn">+</button>
        </form>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Period</th>
                        <th scope="col">Time</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Subject Teacher</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['del'])) {
                        $tt_id = $_POST['tt_id'];

                        $delete = "DELETE FROM `time_table` WHERE tt_id = $tt_id";
                        $del_res = mysqli_query($connection, $delete);
                        if (!$del_res) {
                            die(mysqli_error($connection));
                        } else {
                            echo "<script>timeTableDelete();</script>";
                        }
                    }

                    $fetch_tt = "SELECT * FROM time_table WHERE tt_created_by = $session_user_id";
                    $fetch_tt_res = mysqli_query($connection, $fetch_tt);
                    while ($row = mysqli_fetch_assoc($fetch_tt_res)) {
                        $tt_id = $row['tt_id'];
                        $tt_day = $row['tt_day'];
                        if ($tt_day == 1) {
                            $tt_day = "Monday";
                        } else if ($tt_day == 2) {
                            $tt_day = "Tuesday";
                        } else if ($tt_day == 3) {
                            $tt_day = "Wednesday";
                        } else if ($tt_day == 4) {
                            $tt_day = "Thursday";
                        } else if ($tt_day == 5) {
                            $tt_day = "Friday";
                        } else if ($tt_day == 6) {
                            $tt_day = "Saturday";
                        } else if ($tt_day == 7) {
                            $tt_day = "Sunday";
                        }

                        $tt_period = $row['tt_period'];
                        $tt_time = $row['tt_time'];
                        $tt_subject = $row['tt_subject'];
                        $tt_teacher = $row['tt_teacher'];
                    ?>
                    <form method="POST" action="">
                        <tr>
                            <td class="d-none"><input type="text" name="tt_id" value="<?php echo $tt_id ?>"></td>
                            <td><?php echo $tt_day ?></td>
                            <td><?php echo $tt_period ?></td>
                            <td><?php echo $tt_time ?></td>
                            <td><?php echo $tt_subject ?></td>
                            <td><?php echo $tt_teacher ?></td>
                            <td class="text-center">
                                <button type="submit" name="del"
                                    class="btn btn-xs-sm btn-outline-danger">Delete</button>
                                <button type="submit" name="edit" class="btn btn-xs-sm btn-outline-dark">Edit</button>
                            </td>
                        </tr>
                    </form>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>