<ul class="pt-3 nav flex-column side-nav">
    <li class="nav-item ">
        <?php $current_date = date('d-m-Y');
        $date_today = strtotime($current_date);
        $query = "SELECT * FROM `subscription` WHERE `subscription_user_id` = '$session_user_id'";
        $subscription_res = mysqli_query($connection, $query);
        $subscription_end_date = "";
        while ($row = mysqli_fetch_assoc($subscription_res)) {
            $subscription_end_date = $row['subscription_end_date'];
        }
        $expiry_date = strtotime($subscription_end_date);

        if ($date_today == $expiry_date) {
            $update_setup = "UPDATE `setup_status` SET `setup_payment_status`= 2 WHERE setup_school_id = $session_user_id";
            $update_setup_res = mysqli_query($connection, $update_setup);
        ?>
        <div class="animate__animated animate__flash animate__infinite infinite navbar-plan-expired mb-3" role="">
            <p>Subscription Expired</p>
        </div>

        <?php }
        if ($date_today < $expiry_date) { ?>
        <div class="navbar-plan-active mb-3" role="">
            <p>Plan Active</p>
        </div>

        <?php }
        if ($date_today > $expiry_date) {
            $update_setup = "UPDATE `setup_status` SET `setup_payment_status`= 2 WHERE setup_school_id = $session_user_id";
            $update_setup_res = mysqli_query($connection, $update_setup);
        ?>
        <div class="animate__animated animate__flash animate__infinite infinite navbar-plan-expired mb-3" role="">
            <p>Subscription Expired on <?php echo $subscription_end_date ?>.</p>
        </div>
        <?php } ?>
    </li>
    <hr>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text " aria-current="page" href="dashboard.php">
            <ion-icon id="light-blue-icon" name="home"></ion-icon>
            Home
        </a>
    </li>
    <hr>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" aria-current="page" href="select-class-activity.php">
            <ion-icon id="pale-orange" name="balloon"></ion-icon>
            Activities
        </a>
    </li>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" aria-current="page" href="school-users-action.php">
            <ion-icon id="dark-blue-icon" name="people"></ion-icon>
            Teachers & Staff
        </a>
    </li>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text " aria-current="page" href="school-students.php">
            <ion-icon id="flourescent-green" name="person"></ion-icon>
            Students
        </a>
    </li>
    <hr>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="school-attendance.php">
            <ion-icon id="pale-yellow" name="shield-checkmark"></ion-icon>
            Attendance
        </a>
    </li>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" aria-current="page" href="announcement.php">
            <ion-icon id="dark-blue-icon" name="megaphone"></ion-icon>
            Announcements
        </a>
    </li>

    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="select-class-tt.php">
            <ion-icon id="pale-orange" name="calendar"></ion-icon>
            Time Table
        </a>
    </li>
    <hr>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="fee-menu.php">
            <ion-icon id="pale-yellow" name="card"></ion-icon>
            Fee
        </a>
    </li>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="manage.php">
            <ion-icon id="bright-red" name="settings"></ion-icon>
            Manage School
        </a>
    </li>
</ul>