<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/images/logo/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">

                    <a class="nav-link active" aria-current="page" href="dashboard-school.php">
                        Home
                    </a>


                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Setup
                    </a>
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
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="setup.php">Complete Setup</a></li>
                    </ul>
                    <?php
                        }
                        if ($setup_remove_status == 2) { ?>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="manage.php">Manage School</a></li>
                    </ul>
                    <?php }
                    } ?>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Learning Management System" aria-expanded="false">
                        LMS
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
            </ul>
            <div class="d-flex">
                <a href="logout.php" type="button" class="nav-link navbar-right-section">
                    Signout
                </a>

            </div>
        </div>
    </div>
</nav>