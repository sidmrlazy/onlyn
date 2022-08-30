<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="person" class="section-heading-icon"></ion-icon>
                Students
            </h3>
            <p class="section-desc">You will be able to see all the students when a teacher adds a student in their
                account</p>
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
                $fetch_teachers = "SELECT * FROM `classes` WHERE class_added_by = $session_user_id";
                $fetch_teacher_result = mysqli_query($connection, $fetch_teachers);
                while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                    $class_id = $row['class_id'];
                    $class_name = $row['class_name'];
                    $class_section = $row['class_section'];
                    $class_status = $row['class_status'];
                ?>

                <form action="show-class-wise-students.php" method="POST" class="inner-tab">
                    <input type="text" name="class_id" value="<?php echo $class_id; ?>" hidden>
                    <p class="profile-teacher-name"><?php echo $class_name . $class_section; ?></p>
                    <div class="d-flex justify-content-center align-items-start">
                        <?php if ($class_status == "1") { ?>
                        <p class="profile-teacher-active-pill w-100">Active</p>
                        <?php  } elseif ($class_status == '2') { ?>
                        <p class="profile-teacher-inactive-pill w-100">Blocked</p>
                        <?php  } ?>
                        <button type="submit" name="submit" class="btn btn-outline-warning btn-sm">View</button>
                    </div>
                </form>
                <?php

                } ?>
            </div>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>