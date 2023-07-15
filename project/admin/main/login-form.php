<div class="container mt-5 form-center">
    <div class="form-container">
        <?php
        require('main/db.php');
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"] === "true") {
            echo "Redirecting to dashboard...";
            header("location:dashboard.php");
            exit;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
            $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);

            if (empty($user_email)) {
                echo "<div class='alert alert-danger w-50' role='alert'>Please enter Registered Email Address </div>";
            } else if (empty($user_password)) {
                echo "<div class='alert alert-danger w-50' role='alert'>Please enter Password</div>";
            } else {
                try {
                    $search_user_query = "SELECT * FROM `user` WHERE `user_email` = '$user_email'";
                    $search_user_result = mysqli_query($connection, $search_user_query);
                    $search_user_count = mysqli_num_rows($search_user_result);

                    if ($search_user_count == 1) {
                        while ($row = mysqli_fetch_assoc($search_user_result)) {
                            if (password_verify($user_password, $row['user_password'])) {
                                setcookie("loggedin", "true", time() + (86400 * 30), "/");
                                setcookie("user_id", $user_email, time() + (86400 * 30), "/");
                                setcookie("user_type", $row['user_type'], time() + (86400 * 30), "/");
                                header("location:dashboard.php");
                            } else {
                                echo "<div class='alert alert-danger w-50' role='alert'>Invalid Password!</div>";
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        }
        ?>
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input name="user_email" type="email" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input name="user_password" type="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button type="submit" name="login" class="btn btn-outline-success w-100">LOGIN</button>
        </form>
    </div>
</div>