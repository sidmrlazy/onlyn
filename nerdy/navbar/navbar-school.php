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
                <?php
                require_once('main/config.php');
                if (!empty($_SESSION['user_type'])) {
                    $session_user_id = $_SESSION['user_id'];
                } else {
                    $session_user_id = 0;
                }
                $get_setup_status = "SELECT * FROM `setup_status` WHERE setup_school_id = $session_user_id";
                $get_setup_result = mysqli_query($connection, $get_setup_status);
                while ($row = mysqli_fetch_assoc($get_setup_result)) {
                    $setup_remove_status = $row['setup_remove_status'];

                    if ($setup_remove_status == 0 || $setup_remove_status == 1) {
                ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="setup.php">
                        <ion-icon name="settings"></ion-icon>
                        Continue Setup
                    </a>
                </li>
                <?php
                    }
                    if ($setup_remove_status == 2) { ?>
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">
                        <ion-icon name="home"></ion-icon>
                        Home
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="school-users-action.php">
                        <ion-icon name="people"></ion-icon>
                        Teachers & Staff
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="school-students.php">
                        <ion-icon name="person"></ion-icon>
                        Students
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="school-attendance.php">
                        <ion-icon name="shield-checkmark"></ion-icon>
                        Attendance
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="announcement.php">
                        <ion-icon name="megaphone"></ion-icon>
                        Announcements
                    </a>
                </li>
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="manage.php">
                        <ion-icon name="settings"></ion-icon>
                        Manage School
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Learning Management System" aria-expanded="false">
                        <ion-icon name="bulb"></ion-icon>
                        Download Activities
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Add Student Data</a></li>
                        <li><a class="dropdown-item" href="#">View | Edit Student Data</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Add Subjects</a></li>
                        <li><a class="dropdown-item" href="#">View | Edit Subjects</a></li>
                    </ul>
                </li>
                <?php }
                } ?>

            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <?php
                        require_once('main/config.php');
                        if (!empty($_SESSION['user_type'])) {
                            $session_user_id = $_SESSION['user_id'];
                            $session_user_type = $_SESSION['user_type'];
                            $query = "SELECT * FROM users WHERE user_id = $session_user_id";
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $user_school_name = $row['user_school_name'];
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Learning Management System" aria-expanded="false">
                            <?php echo $user_school_name ?>
                        </a>
                        <?php
                            }
                        } else {
                            $session_user_id = 0;
                        }
                        ?>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="profile-school.php">
                                    <ion-icon name="person-circle-outline"></ion-icon> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="transactions-school.php">
                                    <ion-icon name="list-outline"></ion-icon> Transactions
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">
                                    <ion-icon name="log-out-outline"></ion-icon>
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