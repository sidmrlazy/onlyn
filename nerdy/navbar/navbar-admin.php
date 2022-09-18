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
                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="admin-all-schools.php">Schools</a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="admin-school-txn.php">Transactions</a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="admin-activity-menu.php">Activities</a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="#">Notifications</a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="#">Notifications</a>
                </li>

                <li class="nav-item nav-mobile">
                    <a class="nav-link active" aria-current="page" href="admin-promotions.php">Promotions</a>
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
                                $user_name = $row['user_name'];
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Learning Management System" aria-expanded="false">
                            <?php echo $user_name ?>
                        </a>
                        <?php
                            }
                        } else {
                            $session_user_id = 0;
                        }
                        ?>
                        <ul class="nav-mobile dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
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