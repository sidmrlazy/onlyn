<ul class="nav flex-column side-nav">
    <li class="nav-item side-nav-link mt-4">
        <a class="nav-link side-nav-text" aria-current="page" href="dashboard.php">
            <ion-icon id="light-blue-icon" name="home"></ion-icon>
            Home
        </a>
    </li>
    <hr>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" aria-current="page" href="class-teacher-select-class-activity">
            <ion-icon id="pale-orange" name="balloon"></ion-icon>
            Activities
        </a>
    </li>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" aria-current="page" href="student.php">
            <ion-icon id="dark-blue-icon" name="person"></ion-icon>
            Students
        </a>
    </li>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="mark-student-attendance.php">
            <ion-icon id="pale-yellow" name="shield-checkmark"></ion-icon>
            Attendance
        </a>
    </li>
    <hr>
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" aria-current="page" href="announcement-teacher.php">
            <ion-icon id="dark-blue-icon" name="megaphone"></ion-icon>
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
    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="time-table-menu.php">
            <ion-icon id="pale-orange" name="calendar"></ion-icon>
            Time Table
        </a>
    </li>

    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="class-teacher-student-diary-menu.php">
            <ion-icon id="flourescent-green" name="book"></ion-icon>
            Student Diary
        </a>
    </li>

    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="exam-menu.php">
            <ion-icon id="bright-red" name="rocket"></ion-icon>
            Exams & Results
        </a>
    </li>

    <li class="nav-item side-nav-link">
        <a class="nav-link side-nav-text" href="class-teacher-home-work-menu.php">
            <ion-icon id="pale-orange" name="receipt"></ion-icon>
            Homework
        </a>
    </li>
</ul>