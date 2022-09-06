<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard w-100 animate__animated animate__fadeIn">

        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Attendance
            </h3>
            <?php
            if (isset($_POST['submit'])) {
                $tt_created_by = $_POST['tt_created_by'];
                $tt_day_original = $_POST['tt_day'];
                if ($tt_day_original == 1) {
                    $tt_day = "Monday";
                } else if ($tt_day_original == 2) {
                    $tt_day = "Tuesday";
                } else if ($tt_day_original == 3) {
                    $tt_day = "Wednesday";
                } else if ($tt_day_original == 4) {
                    $tt_day = "Thursday";
                } else if ($tt_day_original == 5) {
                    $tt_day = "Friday";
                } else if ($tt_day_original == 6) {
                    $tt_day = "Saturday";
                } else if ($tt_day_original == 7) {
                    $tt_day = "Sunday";
                }
            }
            ?>
            <p class="section-desc">Showing attendance for <?php echo $tt_day ?></p>
        </div>


        <div class="w-100">
            <div class="tab-wrap-view">
                <?php
                require_once('main/config.php');
                if (isset($_POST['submit'])) {
                    $tt_created_by = $_POST['tt_created_by'];
                    $tt_day = $_POST['tt_day'];

                    $query = "SELECT * FROM `time_table` WHERE `tt_day` LIKE '$tt_day' AND `tt_created_by` LIKE '$tt_created_by'";
                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die(mysqli_error($connection));
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tt_period = $row['tt_period'];

                            $tt_subject = $row['tt_subject'];
                            $tt_time = $row['tt_time'];
                            $tt_teacher = $row['tt_teacher'];

                            $get_teacher = "SELECT * FROM users WHERE user_id = $tt_teacher";
                            $get_teacher_res = mysqli_query($connection, $get_teacher);
                            $teacher_name = "";
                            while ($row = mysqli_fetch_assoc($get_teacher_res)) {
                                $teacher_name = $row['user_name'];
                            }
                            $tt_teacher = $teacher_name;

                ?>
                <div class="att-card">
                    <?php if ($tt_period == 1) { ?>
                    <p class="att-card-period"><?php echo $tt_period ?>st Period</p>
                    <?php }
                                if ($tt_period == 2) { ?>
                    <p class="att-card-period"><?php echo $tt_period ?>nd Period</p>
                    <?php }
                                if ($tt_period == 3) { ?>
                    <p class="att-card-period"><?php echo $tt_period ?>rd Period</p>
                    <?php }
                                if ($tt_period == 4 || $tt_period == 5 || $tt_period == 6 || $tt_period == 7 || $tt_period == 8 || $tt_period == 9 || $tt_period == 10) { ?>
                    <p class="att-card-period"><?php echo $tt_period ?>th Period</p>
                    <?php } ?>
                    <div class="d-flex justify-content-center align-items-start">
                        <p class="att-card-subject"><?php echo $tt_subject ?></p>
                        <p><?php echo $tt_time ?></p>
                    </div>
                    <div class="tt-row">
                        <p class="tt-teacher"><?php echo $tt_teacher ?></p>
                        <button type="submit" name="edit" class="tt-btn" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Edit ">
                            <ion-icon name="create-outline"></ion-icon> Edit
                        </button>
                    </div>
                </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>


    </div>
</div>
<?php include('main/footer.php');  ?>