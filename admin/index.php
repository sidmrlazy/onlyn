<!doctype html>
<html lang="en">

<head>
    <meta name="robots" content="noindex" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- =========== SEO =========== -->
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- =========== JQUERY =========== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- =========== FAVICON =========== -->
    <link rel="shortcut icon" href="../assets/images/logo/brand-favicon.webp" type="image/x-icon">

    <!-- =========== STYLESHEET =========== -->
    <link rel="stylesheet" href="assets/styles.css">

    <!-- =========== LOTTIE =========== -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- =========== GOOGLE FONTS =========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">


    <title>Admin | BIAHS</title>

    <!-- =========== BOOTSTRAP =========== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container form-container">
        <?php
        require('includes/connection.php');
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"] === "true") {
            echo "Redirecting to dashboard...";
            header("location:dashboard.php");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_contact = mysqli_real_escape_string($connection, $_POST['user_contact']);
            $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);

            if (empty($user_contact)) { ?>
        <div class="alert alert-danger w-50" role="alert">
            Please enter Registered Mobile Number
        </div>
        <?php
            } else if (empty($user_password)) { ?>
        <div class="alert alert-danger w-50" role="alert">
            Please enter Password
        </div>
        <?php
            } else {
                try {
                    $search_user_query = "SELECT * FROM `bora_users` WHERE `user_contact` = '$user_contact'";
                    $search_user_result = mysqli_query($connection, $search_user_query);
                    $search_user_count = mysqli_num_rows($search_user_result);

                    if ($search_user_count == 1) {
                        while ($row = mysqli_fetch_assoc($search_user_result)) {
                            if (password_verify($user_password, $row['user_password'])) {
                                setcookie("loggedin", "true", time() + (86400 * 30), "/");
                                setcookie("user_id", $user_contact, time() + (86400 * 30), "/");
                                setcookie("user_type", $row['user_type'], time() + (86400 * 30), "/");
                                header("location:dashboard.php");
                            } else { ?>
        <div class="alert alert-danger w-50" role="alert">
            Invalid Password!
        </div>
        <?php }
                        }
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        }
        ?>

        <form class="login-form" method="POST" action="">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Registered Mobile Number</label>
                <input type="number" name="user_contact" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="user_password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit" class="btn btn-outline-success w-100">Login</button>
        </form>
    </div>

    <?php include('includes/footer.php') ?>