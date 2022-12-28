<div class="login-body">

    <form action="" method="POST" class="col-md-4 login-form">
        <?php
        session_start();
        if (isset($_SESSION["user_name"])) {
            header("location:dashboard.php");
        }
        include('includes/db.php');
        if (isset($_POST['submit'])) {
            $user_name = $_POST['user_name'];
            $user_password = $_POST['user_password'];

            $query = "SELECT * FROM `users` WHERE `user_name` = '$user_name'";
            $q_result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($q_result);
            if ($count == 1) {
                $password = "";
                $user_type = 1;
                $user_name = "";
                while ($row = mysqli_fetch_assoc($q_result)) {
                    $password = $row['user_password'];
                    $user_type = $row['user_type'];
                    $user_name = $row['user_name'];
                }
            }

            if (password_verify($user_password, $password)) {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_type'] = $user_type;
                header("location: dashboard-controller.php");
            } else { ?>
        <div class="alert alert-danger mt-3 mb-3 w-100" role="alert">
            Incorrect User Name or Password!
        </div>
        <?php

            }
        }
        ?>
        <div class="w-100 mb-3 login-form-header">
            <h1>Welcome!</h1>
            <p>Sign-in to continue</p>
        </div>


        <div class="form-floating w-100 mb-3">
            <input type="text" name="user_name" class="form-control rounded-input" id="userName"
                placeholder="name@example.com">
            <label for="userName">Username</label>
        </div>
        <div class="form-floating w-100 mb-3">
            <input type="password" name="user_password" class="form-control rounded-input" id="floatingPassword"
                placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="w-100">
            <button type="submit" name="submit" class="btn btn-primary w-100 rounded-btn">LOGIN</button>
        </div>

        <div class="login-developer-signature">
            <p>Designed & Developed by Onlyn</p>
        </div>
    </form>
</div>