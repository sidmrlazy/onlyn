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
            if (isset($_POST['delete'])) {
                echo "Delete";
            }
            if (isset($_POST['edit'])) {
                echo "Edit";
            }
            ?>

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
                            $tt_id = $row['tt_id'];
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
                        <?php
                                    $get_subject = "SELECT * FROM `subjects` WHERE subject_id = $tt_subject";
                                    $get_subject_r = mysqli_query($connection, $get_subject);
                                    $subject_name = "";
                                    while ($row = mysqli_fetch_assoc($get_subject_r)) {
                                        $subject_id = $row['subject_id'];
                                        $subject_name = $row['subject_name'];

                                        if ($tt_subject == $subject_id) {
                                            $tt_subject = $subject_name;
                                        }
                                    }
                                    ?>
                        <p class="att-card-subject"><?php echo $tt_subject ?></p>
                        <p><?php echo $tt_time ?></p>
                    </div>
                    <div class="tt-row">
                        <p class="tt-teacher"><?php echo $tt_teacher ?></p>
                        <div class="d-flex">
                            <form action="" method="POST">
                                <input type="text" name="tt_id" value="<?php echo $tt_id ?>" hidden>
                                <button type="submit" name="edit" class="tt-btn" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Edit ">
                                    <ion-icon name="create-outline"></ion-icon>
                                </button>
                            </form>

                            <form action="" method="POST">
                                <input type="text" name="tt_id" value="<?php echo $tt_id ?>" hidden>
                                <button type="submit" name="delete" class="tt-btn ml-4" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Delete">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>
                        </div>
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