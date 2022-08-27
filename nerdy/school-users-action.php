<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">

        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="people" class="section-heading-icon"></ion-icon>
                Teachers & Staff
            </h3>
            <p class="section-desc">Add or Edit Teachers and Staff</p>
        </div>

        <div class="container w-100">
            <div class="d-flex">
                <a href="setup-add-teacher.php" type="submit"
                    class="btn btn-outline-primary mb-3 d-flex justify-content-center align-items-center">Add
                    Teacher
                    <ion-icon style="margin-left: 5px !important" name="add-circle-outline"></ion-icon>
                </a>
            </div>
            <div class="tab-wrap-view">
                <?php
                require_once('main/config.php');
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }

                $fetch_teachers = "SELECT * FROM `users` WHERE user_added_by = $session_user_id";
                $fetch_tacher_result = mysqli_query($connection, $fetch_teachers);
                while ($row = mysqli_fetch_assoc($fetch_tacher_result)) {
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $user_contact = $row['user_contact'];
                    $user_status = $row['user_status'];
                    $user_type = $row['user_type'];

                    if ($user_type == 3 || $user_type == 5) {
                ?>

                <form action="edit-user-teacher.php" method="POST" class="inner-tab">
                    <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                    <p class="profile-teacher-name"><?php echo $user_name; ?></p>
                    <p class="profile-teacher-contact"><?php echo $user_contact; ?></p>
                    <div class="d-flex justify-content-center align-items-center">
                        <?php if ($user_status == "1") { ?>
                        <p class="profile-teacher-active-pill w-100">Active</p>
                        <?php  } elseif ($user_status == '2') { ?>
                        <p class="profile-teacher-inactive-pill w-100">Blocked</p>
                        <?php  } ?>
                        <button type="submit" name="edit" class="btn btn-outline-warning btn-sm">Edit</button>
                    </div>
                </form>
                <?php
                    }
                } ?>
            </div>
        </div>

        <div class="container w-100 mt-5">
            <div class="d-flex">
                <a href="add-staff-complete.php" type="submit"
                    class="btn btn-outline-primary mb-3 d-flex justify-content-center align-items-center">Add
                    Staff
                    <ion-icon style="margin-left: 5px !important" name="add-circle-outline"></ion-icon>
                </a>
                <!-- <button type="submit"
                class="btn btn-outline-primary mb-3 d-flex justify-content-center align-items-center">Add Staff
                <ion-icon style="margin-left: 5px !important" name="add-circle-outline"></ion-icon>
            </button> -->
            </div>
            <div class="tab-wrap-view">
                <?php
                require_once('main/config.php');
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }

                $fetch_teachers = "SELECT * FROM `staff` WHERE staff_added_by = $session_user_id";
                $fetch_tacher_result = mysqli_query($connection, $fetch_teachers);
                while ($row = mysqli_fetch_assoc($fetch_tacher_result)) {
                    $staff_id = $row['staff_id'];
                    $staff_name = $row['staff_name'];
                    $staff_contact = $row['staff_contact'];
                    $staff_active_status = $row['staff_active_status'];
                    $staff_type = $row['staff_type'];
                ?>

                <form action="edit-user-staff.php" method="POST" class="inner-tab-staff">
                    <input type="text" name="staff_id" value="<?php echo $staff_id; ?>" hidden>
                    <p class="profile-teacher-name"><?php echo $staff_name; ?></p>
                    <p class="profile-teacher-contact"><?php echo $staff_contact; ?></p>
                    <p class="profile-teacher-contact"><?php echo $staff_type; ?></p>
                    <div class="d-flex justify-content-center align-items-center">
                        <?php if ($staff_active_status == 1) { ?>
                        <p class="profile-teacher-active-pill w-100">Active</p>
                        <?php  } else if ($staff_active_status == 2) { ?>
                        <p class="profile-teacher-inactive-pill w-100">Blocked</p>
                        <?php  } ?>
                        <button type="submit" name="edit" class="btn btn-outline-warning btn-sm m-1">Edit</button>
                    </div>

                </form>
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>