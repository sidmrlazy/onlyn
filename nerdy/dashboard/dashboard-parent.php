<?php
if (!empty($_SESSION['user_type'])) {
    $session_user_id = $_SESSION['user_id'];
    $session_user_contact = $_SESSION['user_contact'];
    $session_user_type = $_SESSION['user_type'];
} else {
    $session_user_id = 0;
}
?>
<div class="container mt-5">
    <div class="card p-3">
        <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_vpnuhop8.json" background="transparent"
            speed="1" class="mb-3" style="width: 80px; height: 80px;" loop autoplay></lottie-player>
        <div class="alert alert-warning" role="alert">
            Parent Setup Status
        </div>
        <div class="progress">
            <?php
            require_once('main/config.php');
            $query = "SELECT * FROM setup_status WHERE setup_school_id = $session_user_id";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $setup_registration_status = $row['setup_registration_status'];
                $setup_class_status = $row['setup_class_status'];
                $setup_staff_status = $row['setup_staff_status'];
                $setup_subject_status = $row['setup_subject_status'];

                if ($setup_registration_status == 1) {
                    $total_setup_status = 15;
                }
                if ($setup_registration_status == 2) {
                    $total_setup_status = 25;
                }
                if ($setup_class_status == 1) {
                    $total_setup_status = 50;
                }
                if ($setup_staff_status == 1) {
                    $total_setup_status = 75;
                }
                if ($setup_subject_status == 1) {
                    $total_setup_status = 100;
                }
            ?>
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25"
                aria-valuemin="0" style="width: <?php echo $total_setup_status ?>%;" aria-valuemax="100">
                <?php echo $total_setup_status ?>%</div>

            <?php

            } ?>
        </div>

        <div class="mt-3 d-flex justify-content-end">
            <a href="setup.php" class="btn btn-outline-success">Continue Setup</a>
        </div>
    </div>

</div>