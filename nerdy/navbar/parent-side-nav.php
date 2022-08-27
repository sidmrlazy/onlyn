<ul class="pt-3 nav flex-column side-nav">
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="dashboard.php">
            <ion-icon name="home-outline"></ion-icon>
            Home
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="mark-student-attendance.php">
            <ion-icon name="shield-checkmark-outline"></ion-icon>
            Attendance
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="announcement-teacher.php">
            <ion-icon name="megaphone-outline"></ion-icon>
            Announcements
            <?php
            require_once('main/config.php');
            if (!empty($_SESSION['user_type'])) {
                $session_user_id = $_SESSION['user_id'];
            } else {
                $session_user_id = 0;
            }
            $fetch_user_details = "SELECT * FROM users WHERE user_id = $session_user_id";
            $fetch_user_res = mysqli_query($connection, $fetch_user_details);

            $user_added_by = "";
            while ($row = mysqli_fetch_assoc($fetch_user_res)) {
                $user_added_by = $row['user_added_by'];
            }

            $fetch_records = "SELECT * FROM announcement WHERE ann_to = $session_user_id AND ann_by = $user_added_by AND ann_status = 1";
            $fetch_result = mysqli_query($connection, $fetch_records);
            $fetch_count = mysqli_num_rows($fetch_result);
            ?>
            <?php if ($fetch_count == 0) { ?>
            <span class="d-none badge bg-danger badge-text rounded-circle"><?php echo $fetch_count ?></span>
            <?php } else { ?>
            <span class="badge bg-danger badge-text rounded-circle"><?php echo $fetch_count ?></span>
            <?php } ?>

        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="teacher-set-time-table.php">
            <ion-icon name="calendar-outline"></ion-icon>
            Time Table
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <ion-icon name="book-outline"></ion-icon>
            Student Diary
        </a>
    </li>
</ul>