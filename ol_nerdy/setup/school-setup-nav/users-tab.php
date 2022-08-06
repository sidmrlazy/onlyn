<div class="container section-container mb-5">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="card mb-5 p-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manage.php">Manage School</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
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

            $fetch_teachers = "SELECT * FROM `users` WHERE user_type = '3' AND user_added_by = $session_user_id";
            $fetch_tacher_result = mysqli_query($connection, $fetch_teachers);
            while ($row = mysqli_fetch_assoc($fetch_tacher_result)) {
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_contact = $row['user_contact'];
                $user_status = $row['user_status'];
            ?>

            <form action="edit-user-teacher.php" method="POST" class="inner-tab">
                <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                <p class="profile-teacher-name"><?php echo $user_name; ?></p>
                <p class="profile-teacher-contact"><?php echo $user_contact; ?></p>
                <div class="d-flex justify-content-center align-items-center">
                    <?php if ($user_status == "1") { ?>
                    <p class="profile-teacher-active-pill w-100">Active</p>
                    <?php  } else if ($user_status == '2') { ?>
                    <p class="profile-teacher-inactive-pill w-100">Blocked</p>
                    <?php  } ?>
                    <button type="submit" name="edit" class="btn btn-outline-warning btn-sm">Edit</button>
                </div>
            </form>
            <?php
            } ?>
        </div>
    </div>

    <div class="container w-100 mt-5">
        <div class="d-flex">
            <button type="submit"
                class="btn btn-outline-primary mb-3 d-flex justify-content-center align-items-center">Add
                Staff
                <ion-icon style="margin-left: 5px !important" name="add-circle-outline"></ion-icon>
            </button>
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