<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid">
    <?php include('navbar/teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                View Students
            </h3>
            <p class="section-desc">View students in the class according to you time-table</p>
        </div>

        <div class="w-100">
            <div class="tab-wrap-view">
                <?php
                require_once('main/config.php');
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }
                $fetch_teachers = "SELECT * FROM `time_table` WHERE `tt_teacher` = $session_user_id GROUP BY tt_teacher";
                $fetch_teacher_result = mysqli_query($connection, $fetch_teachers);
                $fetch_count = mysqli_num_rows($fetch_teacher_result);

                if ($fetch_count > 0) {
                    while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                        $tt_class = $row['tt_class'];

                        $fetch_class_name = "SELECT * FROM classes WHERE class_id = $tt_class";
                        $fetch_class_res = mysqli_query($connection, $fetch_class_name);

                        $class_name = "";
                        $class_section = "";

                        while ($row = mysqli_fetch_assoc($fetch_class_res)) {
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];
                        }
                ?>
                <form action="show-students-tt-wise.php" method="POST">
                    <input type="text" name="tt_class" value="<?php echo $tt_class ?>" hidden>
                    <button type="submit" name="submit" class="att-carrot">
                        <p><?php echo $class_name . $class_section ?></p>
                    </button>
                </form>
                <?php }
                } else if ($fetch_count == 0) {
                    echo "<div class='col-md-6 mb-3 alert alert-danger' role='alert'>No Data Found!</div>";
                } ?>
            </div>
        </div>
    </div>
    <?php include('main/footer.php'); ?>