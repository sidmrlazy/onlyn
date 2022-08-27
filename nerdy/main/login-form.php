<?php include('toasts.php') ?>
<div class="container section-container mt-5">
    <div class="centered-row">
        <div class="col-md-6 login-background">
            <img src="assets/images/vectors/vec-1.png" alt="" class="login-img">
        </div>

        <div class="col-md-6 section-form">
            <h1>Login</h1>
            <p>Enter your registered mobile number and password to login</p>

            <?php
            require_once('main/config.php');
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                // Set condition according to user type and login user accordingly\
                header("location:dashboard.php");
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $user_contact = $_POST['user_contact'];
                $user_password = $_POST['user_password'];

                $query = "SELECT * FROM users WHERE user_contact = $user_contact AND user_status = 1";
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
                        // Send OTP SMS and then Login

                        // $curl = curl_init();

                        // curl_setopt_array($curl, [
                        //     CURLOPT_URL => "https://api.movider.co/v1/verify",
                        //     CURLOPT_RETURNTRANSFER => true,
                        //     CURLOPT_ENCODING => "",
                        //     CURLOPT_MAXREDIRS => 10,
                        //     CURLOPT_TIMEOUT => 30,
                        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        //     CURLOPT_CUSTOMREQUEST => "POST",
                        //     CURLOPT_POSTFIELDS => "api_key=tzAnOXEq6qxxr4ux7t0IGDrriEALnS&api_secret=oVyt8y-45uJg_E-_KQ680wb5gGc_ou&code_length=6&to=917388565681",
                        //     CURLOPT_HTTPHEADER => [
                        //         "Accept: application/json",
                        //         "Content-Type: application/x-www-form-urlencoded"
                        //     ],
                        // ]);

                        // $response = curl_exec($curl);
                        // $err = curl_error($curl);

                        // curl_close($curl);

                        // if ($err) {
                        //     echo "cURL Error #:" . $err;
                        // } else {
                        //     echo $response;
                        // }

                        // $msg = "Thank you for logging in to Onlyn Nerdy Samiksha";

                        // $curl = curl_init();
                        // $data = array(
                        //     'api_key' => "tzAnOXEq6qxxr4ux7t0IGDrriEALnS",
                        //     'api_secret' => "oVyt8y-45uJg_E-_KQ680wb5gGc_ou",
                        //     'text' => $msg,
                        //     'to' => "917388565681",
                        //     'from' => "MOVIDER"
                        // );

                        // curl_setopt_array($curl, array(
                        //     CURLOPT_URL => "https://api.movider.co/v1/sms",
                        //     CURLOPT_RETURNTRANSFER => true,
                        //     CURLOPT_TIMEOUT => 30,
                        //     CURLOPT_CUSTOMREQUEST => "POST",
                        //     CURLOPT_POSTFIELDS => http_build_query($data),
                        //     CURLOPT_HTTPHEADER => array(
                        //         'Accept' => 'application/json',
                        //         'Content-Type' => 'application/x-www-form-urlencoded',
                        //     ),
                        // ));

                        // $response = curl_exec($curl);
                        // $err = curl_error($curl);

                        // curl_close($curl);

                        // if ($err) {
                        //     echo "cURL Error #:" . $err;
                        // } else {
                        //     echo $response;
                        //     echo $msg;
                        // }


                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $user_id;
                        $_SESSION["user_contact"] = $user_contact;
                        $_SESSION["user_school_name"] = $user_school_name;
                        $_SESSION["user_type"] = $user_type;
                        header('Location: dashboard.php');
                    } else {
                        echo "<script>loginErr();</script>";
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

                <button type="submit" name="submit" class="login-button">Sign-In</button>

                <div class="line section-form"></div>

                <div class="register-text">
                    <p>Not a member yet?<a href="register.php"> Click here </a>to create a new account</p>
                </div>
                <!-- <h6 class="register-text">Not a member yet?<a href="plan-select.php" class="btn w-100"> Click here</a>
                    to
                    create a new Account.
                </h6> -->
            </form>
        </div>
    </div>
</div>