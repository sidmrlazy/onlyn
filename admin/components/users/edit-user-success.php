<div class="container mt-5 add-user-success">
    <?php
    require('includes/connection.php');
    if (isset($_POST['update'])) {
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $user_contact = $_POST['user_contact'];
        $user_password = $_POST['user_password'];
        $encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);

        $update = "UPDATE `bora_users` SET `user_name` = '$user_name', `user_contact` = '$user_contact', `user_password` = '$encrypted_password' WHERE `user_id` = '$user_id'";
        $res = mysqli_query($connection, $update);
        if ($res) { ?>
    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_lk80fpsm.json" background="transparent" speed="1"
        style="width: 300px; height: 300px;" loop autoplay></lottie-player>
    <p>Success! User details edited</p>
    <a href="users.php" class="go-back-btn">Go Back</a>

    <?php } else { ?>
    <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_ckcn4hvm.json" background="transparent" speed="1"
        style="width: 300px; height: 300px;" loop autoplay></lottie-player>
    <p>Oops! Looks like there was some problem updating this users details.</p>
    <a href="users.php" class="go-back-btn">Go Back</a>
    <?php
        }
    }
    ?>
</div>