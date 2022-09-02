<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn mt-3">
        <?php
        require_once('main/config.php');
        $fetch_school_details = "SELECT * FROM `users` WHERE `user_id` = $session_user_id AND `user_type` = 5";
        $fetch_school_details_result = mysqli_query($connection, $fetch_school_details);

        while ($row = mysqli_fetch_assoc($fetch_school_details_result)) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_contact = $row['user_contact'];
            $user_status = $row['user_status'];
            $user_type = $row['user_type'];
            $user_added_by = $row['user_added_by'];

            $query = "SELECT * FROM users WHERE user_id = $user_added_by";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $user_school_logo = "assets/images/school-logo/" . $row['user_school_logo'];
                $user_school_name = $row['user_school_name'];
            }

        ?>
        <div class="class-teacher-pro-card">
            <div class="class-teacher-row class-teacher-details-box">
                <div class="class-teacher-flex">
                    <p class="class-teacher-box-label">
                        <ion-icon name="person-outline"></ion-icon> Name
                    </p>
                    <p class="class-teacher-name mb-3"><?php echo $user_name ?></p>
                </div>

                <div>
                    <p class="class-teacher-box-label">
                        <ion-icon name="phone-portrait-outline"></ion-icon> Registered Mobile Number
                    </p>
                    <p><?php echo $user_contact ?></p>
                </div>
            </div>


            <div class="class-teacher-row">
                <div class="class-teacher-flex d-flex">
                    <div class="school-logo-holder">
                        <img src="<?php echo $user_school_logo ?>" alt="">
                    </div>
                    <p class="class-teacher-school-name"><?php echo $user_school_name ?></p>
                </div>
                <div>
                    <?php if ($user_status == 1) { ?>
                    <p class="active-pill">Active</p>
                    <?php } else if ($user_status == 2) { ?>
                    <p class="status-active">Inactive</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php  } ?>
</div>
</div>
<?php include('main/footer.php'); ?>