<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="calendar-outline" class="section-heading-icon"></ion-icon>
                Edit Time Table
            </h3>

            <p class="section-desc">Edit time table set by the teacher</p>
        </div>
        <?php
        if (isset($_POST['update'])) {
            $tt_id = $_POST['tt_id'];
            $tt_period = $_POST['tt_period'];
            $tt_time = $_POST['tt_time'];
            $tt_subject = $_POST['tt_subject'];
            $tt_teacher = $_POST['tt_teacher'];

            $update_tt = "UPDATE
            `time_table`
        SET
            `tt_period` = '$tt_period',
            `tt_subject` = '$tt_subject',
            `tt_time` = '$tt_time',
            `tt_teacher` = $tt_teacher
        WHERE
            `tt_id` = '$tt_id'";
            $update_tt_res = mysqli_query($connection, $update_tt);

            if (!$update_tt_res) {
                echo "<div class='alert alert-danger mb-3 mt-3' role='alert'>
                Error 404!
              </div>";
            } else {
                echo "<div class='alert alert-success mb-3 mt-3' role='alert'>
                Time table updated!
              </div>";
            }
        }



        if (isset($_POST['edit'])) {
            $tt_id = $_POST['tt_id'];
            $get_tt = "SELECT * FROM `time_table` WHERE `tt_id` = '$tt_id'";
            $get_tt_res = mysqli_query($connection, $get_tt);
            while ($row = mysqli_fetch_assoc($get_tt_res)) {
                $tt_day = $row['tt_day'];
                if ($tt_day == 1) {
                    $tt_day_name = "Monday";
                } else if ($tt_day == 2) {
                    $tt_day_name = "Tuesday";
                } else if ($tt_day == 3) {
                    $tt_day_name = "Wednesday";
                } else if ($tt_day == 4) {
                    $tt_day_name = "Thursday";
                } else if ($tt_day == 5) {
                    $tt_day_name = "Friday";
                } else if ($tt_day == 6) {
                    $tt_day_name = "Saturday";
                } else if ($tt_day == 7) {
                    $tt_day_name = "Sunday";
                }
                $tt_period = $row['tt_period'];
                $tt_subject = $row['tt_subject'];
                $tt_time = $row['tt_time'];
                $tt_teacher = $row['tt_teacher'];
                $tt_class = $row['tt_class'];
            }
        }
        ?>
        <form action="" method="POST" class="time-table-row">
            <input type="text" name="tt_id" value="<?php echo $tt_id ?>" hidden>

            <div class="form-floating input-time-table">
                <input required type="number" name="tt_period" value="<?php echo $tt_period ?>" class="form-control"
                    id="floatingInput" placeholder="1st Period">
                <label for="floatingInput">Period (Ex: 1 / 2 / 3)</label>
            </div>

            <div class="form-floating input-time-table">
                <input required type="time" class="form-control" name="tt_time" value="<?php echo $tt_time ?>"
                    id="floatingInput" placeholder="00:00">
                <label for="floatingInput">Select Time</label>
            </div>

            <div class="form-floating input-time-table">
                <select required class="form-select" name="tt_subject" id="floatingSelect"
                    aria-label="Floating label select example">
                    <?php
                    $query_subject = "SELECT * FROM `subjects` WHERE `subject_id` = $tt_subject";
                    $result_subject = mysqli_query($connection, $query_subject);
                    $fetched_subject_id = "";
                    $fetched_subject_name = "";
                    while ($row = mysqli_fetch_assoc($result_subject)) {
                        $fetched_subject_id = $row['subject_id'];
                        $fetched_subject_name = $row['subject_name'];
                    }
                    ?>
                    <option value="<?php echo $fetched_subject_id ?>">
                        <?php echo $fetched_subject_name . " (Assigned)" ?></option>
                    <?php
                    $query = "SELECT * FROM `subjects` WHERE `subject_added_by` = '$session_user_id'";
                    $result = mysqli_query($connection, $query);
                    $subject_name = "";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $subject_id = $row['subject_id'];
                        $subject_name = $row['subject_name'];
                    ?>
                    <option value="<?php echo $subject_id ?>"><?php echo $subject_name ?></option>
                    <?php } ?>
                    <option value="Recess">Recess</option>
                </select>
                <label for="floatingSelect">Select Subject</label>
            </div>

            <div class="form-floating input-time-table">
                <select required class="form-select" id="floatingSelect" name="tt_teacher"
                    aria-label="Floating label select example">
                    <?php
                    $query_subject = "SELECT * FROM `users` WHERE `user_id` = $tt_teacher";
                    $result_subject = mysqli_query($connection, $query_subject);
                    $fetched_teacher_id = "";
                    $fetched_teacher = "";
                    while ($row = mysqli_fetch_assoc($result_subject)) {
                        $fetched_teacher_id = $row['user_id'];
                        $fetched_teacher = $row['user_name'];
                    }
                    ?>
                    <option value="<?php echo $fetched_teacher_id  ?>"><?php echo $fetched_teacher . " (Assigned)" ?>
                    </option>
                    <?php
                    $query_teacher = "SELECT * FROM users WHERE user_added_by = $session_user_id";
                    $result_teacher = mysqli_query($connection, $query_teacher);
                    while ($row = mysqli_fetch_assoc($result_teacher)) {
                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $user_type = $row['user_type'];

                        if ($user_type == 3 || $user_type == 5) {
                    ?>
                    <option value="<?php echo $user_id ?>"><?php echo $user_name ?></option>
                    <?php }
                    } ?>
                    <option value="0">None</option>
                </select>
                <label for="floatingSelect">Select Teacher</label>
            </div>

            <button type="submit" name="update" class="btn btn-sm btn-outline-success time-table-btn">+</button>
        </form>


        <!-- <div class="table-responsive card p-4 mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Period</th>
                        <th scope="col">Time</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Subject Teacher</th>
                        <th scope="col" class="text-center">Action</th>
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

                    $fetch_tt = "SELECT * FROM time_table WHERE tt_created_by = $session_user_id AND `tt_day` = '$fetched_tt_day'";
                    $fetch_tt_res = mysqli_query($connection, $fetch_tt);
                    while ($row = mysqli_fetch_assoc($fetch_tt_res)) {
                        $tt_id = $row['tt_id'];
                        $new_tt_day = $row['tt_day'];
                        if ($new_tt_day == 1) {
                            $tt_day_name = "Monday";
                        } elseif ($new_tt_day == 2) {
                            $tt_day_name = "Tuesday";
                        } elseif ($new_tt_day == 3) {
                            $tt_day_name = "Wednesday";
                        } elseif ($new_tt_day == 4) {
                            $tt_day_name = "Thursday";
                        } elseif ($new_tt_day == 5) {
                            $tt_day_name = "Friday";
                        } elseif ($new_tt_day == 6) {
                            $tt_day_name = "Saturday";
                        } elseif ($new_tt_day == 7) {
                            $tt_day_name = "Sunday";
                        }

                        $tt_period = $row['tt_period'];
                        $tt_time = $row['tt_time'];
                        $tt_subject = $row['tt_subject'];
                        $tt_teacher = $row['tt_teacher'];



                        $fetch_teacher = "SELECT * FROM users WHERE user_id = $tt_teacher";
                        $fetch_teacher_res = mysqli_query($connection, $fetch_teacher);
                        $user_name = "";
                        while ($row = mysqli_fetch_assoc($fetch_teacher_res)) {
                            $user_name = $row['user_name'];
                        }
                    ?>
                    <form method="POST" action="">
                        <tr>
                            <td class="d-none"><input type="text" name="tt_id" value="<?php echo $tt_id ?>"></td>
                            <td><?php echo $tt_day_name ?></td>
                            <td><?php echo $tt_period ?></td>
                            <td><?php echo $tt_time ?></td>
                            <td><?php echo $tt_subject ?></td>

                            <?php if ($tt_subject == 'Recess') { ?>
                            <td><?php echo '---' ?></td>
                            <?php } else { ?>
                            <td><?php echo $user_name ?></td>
                            <?php } ?>

                            <td class="text-center">
                                <button type="submit" name="del" class="btn">
                                    <ion-icon name="trash-outline" class="del-btn-icon"></ion-icon>
                                </button>
                            </td>
                        </tr>
                    </form>
                    <?php } ?>
                </tbody>
            </table>
        </div> -->
    </div>
</div>
<?php include('main/footer.php'); ?>