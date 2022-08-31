<div class="container section-container mt-5">
    <div class="centered-row">
        <div class="col-md-6 login-background">
            <img src="assets/images/vectors/vec-1.png" alt="" class="login-img">
        </div>

        <div class="p-3 col-md-6 section-form">
            <h1>Login</h1>
            <p>Enter your registered mobile number and password to login</p>
            <?php
            include('main/config.php');
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                header("Location:dashboard.php");
                exit;
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user_contact = $_POST['user_contact'];
                $user_password = $_POST['user_password'];
                $query = "SELECT * FROM `users` WHERE `user_contact` = $user_contact";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $fetched_password = $row['user_password'];
                    $decrypted_password = password_verify($user_password, $fetched_password);
                    $user_name = $row['user_name'];
                    $user_school_name = $row['user_school_name'];
                    $user_contact = $row['user_contact'];
                    $user_id = $row['user_id'];
                    $user_type = $row['user_type'];
                    if ($user_password == $decrypted_password) {
                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $user_id;
                        $_SESSION["user_type"] = $user_type;
                        $_SESSION["user_contact"] = $user_contact;
                        $_SESSION["user_name"] = $user_name;
                        $_SESSION["user_school_name"] = $user_school_name;
                        header("Location:dashboard.php");
                    } else {
                        die("<div class='alert alert-danger mt-3 mb-3' role='alert'>Contact number or password is invalid!</div>");
                    }
                }
            }
            ?>
            <form action="" class="mt-4 login-form" method="POST">
                <div class="form-floating mb-3">
                    <input type="number" name="user_contact" class="form-control" id="floatingInput"
                        placeholder="+91 XXXXX XXXXX">
                    <label for="floatingInput">Registered Mobile Number</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" autocomplete="on" name="user_password" class="form-control"
                        id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button type="submit" name="submit" class="login-button w-100">Sign-In</button>
                <div class="line section-form"></div>
                <div class="register-text">
                    <p>Not a member yet?<a href="register.php"> Click here </a>to create a new account</p>
                </div>
            </form>
        </div>
    </div>
</div>