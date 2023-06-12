<?php include('includes/header.php') ?>
<?php include('components/navbar/admin-navbar.php') ?>

<div class="container mt-5 add-user-success">
    <?php
    require('includes/connection.php');
    if (isset($_COOKIE['user_id'])) {
        $user_contact = $_COOKIE['user_id'];
        $fetch_data = "SELECT * FROM `bora_users` WHERE `user_contact` = '$user_contact'";
        $fetch_res = mysqli_query($connection, $fetch_data);
        $user_name = "";
        while ($row = mysqli_fetch_assoc($fetch_res)) {
            $user_name = $row['user_name'];
        }
    }
    if (isset($_POST['submit'])) {

        $course_id = $_POST['course_id'];
        $course_fee = $_POST['course_fee'];

        $update_fee = "UPDATE
        `bora_course`
    SET
        `course_fee` = '$course_fee'
    WHERE
        `course_id` = '$course_id'";

        $update_fee_res = mysqli_query($connection, $update_fee);

        if ($update_fee_res) {
    ?>
    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_lk80fpsm.json" background="transparent" speed="1"
        style="width: 300px; height: 300px;" loop autoplay></lottie-player>
    <p>Success! Fee Updated.</p>
    <a href="course-settings.php" class="go-back-btn">Go Back</a>
    <?php } else { ?>
    <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_ckcn4hvm.json" background="transparent" speed="1"
        style="width: 300px; height: 300px;" loop autoplay></lottie-player>
    <p>There was some problem. Please try again.</p>
    <a href="course-settings.php" class="go-back-btn">Go Back</a>

    <?php
        }
    }
    ?>
</div>
<?php include('includes/footer.php') ?>