<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
            <img src="assets/images/logo/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item nav-mobile">
                    <a class="nav-link " aria-current="page" href="dashboard.php">
                        <ion-icon id="light-blue-icon" name="home"></ion-icon>
                        Home
                    </a>
                </li>
                <li class="nav-item nav-mobile">
                    <a class="nav-link " aria-current="page" href="show-student-attendance.php">
                        <ion-icon id="pale-yellow" name="shield-checkmark"></ion-icon>
                        Attendance
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link " aria-current="page" href="#">
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

                <li class="nav-item nav-mobile">
                    <a class="nav-link " aria-current="page" href="parent-show-tt-day.php">
                        <ion-icon id="pale-orange" name="calendar"></ion-icon>
                        Time Table
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link " aria-current="page" href="student-view-exam.php">
                        <ion-icon id="bright-red" name="rocket"></ion-icon>
                        Exams & Results
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link " aria-current="page" href="student-select-hw.php">
                        <ion-icon id="pale-orange" name="receipt"></ion-icon>
                        Homework
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link " aria-current="page" href="student-select-diary-date.php">
                        <ion-icon id="flourescent-green" name="book"></ion-icon>
                        Student Diary
                    </a>
                </li>
            </ul>

            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <?php
                        require_once('main/config.php');
                        if (!empty($_SESSION['user_type'])) {
                            $session_user_id = $_SESSION['user_id'];
                            $session_user_type = $_SESSION['user_type'];
                            $query = "SELECT * FROM users WHERE `user_id` = $session_user_id";
                            $result = mysqli_query($connection, $query);
                            $user_contact = "";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $user_contact = $row['user_contact'];
                            }
                            $student_query = "SELECT * FROM `students` WHERE `student_father_contact` = '$user_contact'";
                            $student_res = mysqli_query($connection, $student_query);
                            while ($row = mysqli_fetch_assoc($student_res)) {
                                $student_name = $row['student_name'];
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Learning Management System" aria-expanded="false">
                            <?php echo $student_name ?>
                        </a>
                        <?php
                            }
                        }
                        ?>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <ion-icon name="person-circle"></ion-icon> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">
                                    <ion-icon name="log-out"></ion-icon>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>