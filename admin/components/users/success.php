<div class="container mt-5 add-user-success">
    <?php
    require('includes/connection.php');
    if (isset($_POST['submit'])) {
        $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);
        $user_contact = mysqli_real_escape_string($connection, $_POST['user_contact']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        $user_type = mysqli_real_escape_string($connection, '2');

        $encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);

        $check = "SELECT * FROM `bora_users` WHERE `user_contact` = $user_contact";
        $check_res = mysqli_query($connection, $check);
        $check_count = mysqli_num_rows($check_res);

        if ($check_count == 0) {

            $query = "INSERT INTO `bora_users`(
                `user_name`,
                `user_contact`,
                `user_password`,
                `user_type`
            )
            VALUES(
                '$user_name',
                '$user_contact',
                '$encrypted_password',
                '$user_type'
            )";

            $result = mysqli_query($connection, $query);
            if ($result) { ?>
                <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_lk80fpsm.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
                <p>New user added</p>
                <a href="users.php" class="go-back-btn">Go Back</a>
            <?php
            }
        } else { ?>
            <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_ckcn4hvm.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
            <p>Looks like this user already has an account with us!</p>
            <a href="users.php" class="go-back-btn">Go Back</a>
    <?php
        }
    }
    ?>
</div>