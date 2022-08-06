<div class="container mt-2">
    <?php include('dashboard/pills.php') ?>
    <?php
    require_once('main/config.php');

    if (isset($_POST['complete'])) {
        $setup_remove_status = 2;
        $setup_id = $_POST['setup_id'];
        $update_table = "UPDATE `setup_status` SET `setup_remove_status`='$setup_remove_status' WHERE setup_school_id = $session_user_id AND setup_id = $setup_id";
        $update_table_result = mysqli_query($connection, $update_table);
        if (!$update_table_result) {
            die(mysqli_error($connection));
        } else {
            echo "<div class='alert alert-success' role='alert'>Profile Updation completed!</div>";
        }
    }

    $query = "SELECT * FROM setup_status WHERE setup_school_id = $session_user_id";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $setup_id = $row['setup_id'];
        $setup_registration_status = $row['setup_registration_status'];
        $setup_class_status = $row['setup_class_status'];
        $setup_teacher_status = $row['setup_teacher_status'];
        $setup_staff_status = $row['setup_staff_status'];
        $setup_subject_status = $row['setup_subject_status'];
        $setup_remove_status = $row['setup_remove_status'];

        if ($setup_registration_status == 1) {
            $total_setup_status = 15;
        }
        if ($setup_registration_status == 2) {
            $total_setup_status = 25;
        }
        if ($setup_class_status == 1) {
            $total_setup_status = 50;
        }
        if ($setup_teacher_status == 1) {
            $total_setup_status = 65;
        }
        if ($setup_staff_status == 1) {
            $total_setup_status = 75;
        }
        if ($setup_subject_status == 1) {
            $total_setup_status = 100;
        }
        if ($setup_remove_status == 0) {
    ?>
            <div class="card p-3">
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_vpnuhop8.json" background="transparent" speed="1" class="mb-3" style="width: 80px; height: 80px;" loop autoplay></lottie-player>
                <div class="alert alert-warning" role="alert">
                    School Setup Status
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" style="width: <?php echo $total_setup_status ?>%;" aria-valuemax="100">
                        <?php echo $total_setup_status ?>%</div>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <a href="setup.php" class="btn btn-outline-success">Continue Setup</a>
                </div>
            </div>
        <?php
        }
        if ($setup_remove_status == 1) { ?>
            <div class="card p-3">
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_vpnuhop8.json" background="transparent" speed="1" class="mb-3" style="width: 80px; height: 80px;" loop autoplay></lottie-player>
                <div class="alert alert-warning" role="alert">
                    School Setup Status
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" style="width: <?php echo $total_setup_status ?>%;" aria-valuemax="100">
                        <?php echo $total_setup_status ?>%</div>
                </div>
                <form action="" method="POST" class="mt-3 d-flex justify-content-end">
                    <input type="text" name="setup_id" value="<?php echo $setup_id; ?>" hidden>
                    <button type="submit" name="complete" class="btn btn-success">End Setup</button>
                </form>
            </div>

        <?php }
        if ($setup_remove_status == 2) { ?>
            <div class="d-none card p-3">
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_vpnuhop8.json" background="transparent" speed="1" class="mb-3" style="width: 80px; height: 80px;" loop autoplay></lottie-player>
                <div class="alert alert-warning" role="alert">
                    School Setup Status
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" style="width: <?php echo $total_setup_status ?>%;" aria-valuemax="100">
                        <?php echo $total_setup_status ?>%</div>
                </div>
                <form action="" method="POST" class="mt-3 d-flex justify-content-end">
                    <input type="text" name="setup_id" value="<?php echo $setup_id; ?>" hidden>
                    <button type="submit" name="complete" class="btn btn-success">End Setup</button>
                </form>
            </div>
    <?php
        }
    } ?>
</div>