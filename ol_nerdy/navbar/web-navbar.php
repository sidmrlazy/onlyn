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
                    <?php
                    require_once('main/config.php');
                    if (!empty($_SESSION['user_type'])) {
                        $session_user_id = $_SESSION['user_id'];
                    } else {
                        $session_user_id = 0;
                    }

                    ?>
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>



            </ul>
            <!-- <div class="d-flex">
                <a href="logout.php" class="nav-link">Logout</a>
            </div> -->
        </div>
    </div>
</nav>