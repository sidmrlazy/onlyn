<div class="container login-form-body">
    <div class="login-form">
        <h1>Welcome!</h1>
        <p>Enter your registered mobile number and password to login to Admin Panel</p>

        <?php
        require('../api/connection.php');
        session_start();

        if (isset($_SESSION["user_mobile"])) {
            header("Location: dashboard.php");
            exit();
        }

        if (isset($_POST["login"])) {
            $user_mobile = $_POST["user_mobile"];
            $user_password = $_POST["user_password"];

            // Prepare statement to select user with given mobile number
            $stmt = $connection->prepare("SELECT * FROM `user` WHERE `user_mobile` = ?");
            $stmt->bind_param("s", $user_mobile);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Verify password with bcrypt
                if (password_verify($user_password, $row["user_password"])) {
                    $_SESSION["user_mobile"] = $user_mobile;
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error_message = "<div class='alert alert-danger' role='alert'>
                    Hm, something seems to be off with your password. Please double-check and try again.
                  </div>";
                }
            } else {
                $error_message = "<div class='alert alert-danger' role='alert'>
                Oh no! We can't seem to find you in our records. Please try again with a valid mobile number.
              </div>";
            }

            $stmt->close();
            $connection->close();
        }

        ?>
        <?php if (isset($error_message)) {
            echo "<p>" . $error_message . "</p>";
        } ?>

        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="user_mobile" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Registered Mobile Number</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="user_password" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button type="submit" name="login" class="login-form-btn">LOGIN</button>
        </form>
    </div>
</div>