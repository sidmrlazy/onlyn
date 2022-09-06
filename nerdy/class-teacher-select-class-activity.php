<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Select Class
            </h3>
            <p class="section-desc">Select class to show all available class-wise activites</p>
        </div>

        <div class="w-100">
            <div class="tab-wrap-view">
                <?php
                require_once('main/config.php');

                $fetch_teachers = "SELECT * FROM `classes` WHERE class_teacher = $session_user_id GROUP BY `class_name`";
                $fetch_teacher_result = mysqli_query($connection, $fetch_teachers);
                while ($row = mysqli_fetch_assoc($fetch_teacher_result)) {
                    $class_id = $row['class_id'];
                    $class_name = $row['class_name'];
                    $class_section = $row['class_section'];
                    $class_status = $row['class_status'];
                ?>
                <form action="class-teacher-show-activity" method="POST">
                    <input type="text" name="class_name" value="<?php echo $class_name ?>" hidden>
                    <button type="submit" name="submit" class="att-carrot">
                        <p><?php echo $class_name ?></p>
                    </button>
                </form>
                <?php

                } ?>
            </div>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>