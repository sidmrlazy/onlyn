<?php

$link = "https://wa.me/+917388565681?text=Hi%20";


?>
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
                $setup_payment_status = $row['setup_payment_status'];

                if ($setup_remove_status == 0 || $setup_remove_status == 1) {
            ?>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">
                        <ion-icon name="home"></ion-icon>
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="setup.php">
                        <ion-icon name="settings"></ion-icon>
                        Continue Setup
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
                                <a class="dropdown-item" href="logout.php">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php }
                if ($setup_remove_status == 2 && $setup_payment_status == 1) { ?>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">
                        <ion-icon id="light-blue-icon" name="home"></ion-icon>
                        Home
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="select-class-activity.php">
                        <ion-icon id="pale-orange" name="balloon"></ion-icon>
                        Activities
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="school-users-action.php">
                        <ion-icon id="dark-blue-icon" name="people"></ion-icon>
                        Teachers & Staff
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="school-students.php">
                        <ion-icon id="flourescent-green" name="person"></ion-icon>
                        Students
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="school-attendance.php">
                        <ion-icon id="pale-yellow" name="shield-checkmark"></ion-icon>
                        Attendance
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="announcement.php">
                        <ion-icon id="dark-blue-icon" name="megaphone"></ion-icon>
                        Announcements
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="select-class-tt.php">
                        <ion-icon id="pale-orange" name="calendar"></ion-icon>
                        Time Table
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="fee-menu.php">
                        <ion-icon id="pale-yellow" name="card"></ion-icon>
                        Fee
                    </a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="manage.php">
                        <ion-icon id="bright-red" name="settings"></ion-icon>
                        Manage School
                    </a>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                        <div class="animate__animated animate__flash animate__infinite infinite navbar-plan-expired"
                            role="">
                            <p>
                                Subscription Expired
                            </p>
                        </div>

                        <?php }
                                if ($date_today < $expiry_date) { ?>
                        <div class="navbar-plan-active" role="">
                            <p>Plan Active</p>
                        </div>

                        <?php }
                                if ($date_today > $expiry_date) {
                                    $update_setup = "UPDATE `setup_status` SET `setup_payment_status`= 2 WHERE setup_school_id = $session_user_id";
                                    $update_setup_res = mysqli_query($connection, $update_setup);
                                ?>
                        <div class="animate__animated animate__flash animate__infinite infinite navbar-plan-expired"
                            role="">
                            <p>
                                Subscription Expired on <?php echo $subscription_end_date ?>.
                            </p>
                        </div>
                        <?php } ?>
                        <!-- <a class="nav-link active" aria-current="page" href="dashboard.php">
                            <ion-icon name="home"></ion-icon>
                            Home
                        </a> -->
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" aria-current="page" href="#">
                            <ion-icon name="game-controller-outline"></ion-icon> Your Activities
                        </a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" aria-current="page" href="#">
                            <ion-icon name="cart-outline" class="navbar-cart"></ion-icon>
                        </a>
                    </li>
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
                                <a class="dropdown-item" target="_blank" href="<?php echo $link ?>">
                                    <ion-icon name="logo-whatsapp"></ion-icon> Support
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
            <?php }
                if ($setup_payment_status == 2) { ?>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">
                        <ion-icon name="home"></ion-icon>
                        Home
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
                                <a class="dropdown-item" href="logout.php">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <?php
                }
            } ?>
        </div>
    </div>
</nav>