<?php include('main/header.php') ?>
<?php include('main/web-navbar.php') ?>
<div class="container section-container mt-5 mb-5">
    <div class="register">
        <div class="col-md-6 login-background">
            <img src="assets/images/vectors/vec-1.png" alt="" class="login-img">
        </div>

        <div class="col-md-6 section-form">
            <p>Upgrade your school to a digital platform with Onlyn Nerdy</p>
            <form action="pay.php" method="POST" class="mt-4 reg-form login-form">
                <div class="d-flex mob-flex w-100 mb-2">
                    <div class="form-floating m-1 w-100">
                        <input type="text" name="user_school_name" required class="form-control" id="floatingInput"
                            placeholder="School Name">
                        <label for="floatingInput">School Name</label>
                    </div>

                    <div class="form-floating m-1 w-100">
                        <input type="number" name="user_contact" required maxlength="10" class="form-control"
                            id="floatingInput" placeholder="+91XXXXXXXXXX">
                        <label for="floatingInput">Registered Mobile Number</label>
                    </div>
                </div>
                <div class="d-flex mob-flex w-100 mb-2">
                    <div class="form-floating m-1 w-100">
                        <input type="password" autocomplete="on" name="user_password" required class="form-control"
                            id="floatingInput" placeholder="**********">
                        <label for="floatingInput">Password</label>
                    </div>

                    <div class="form-floating m-1 w-100">
                        <input type="password" name="user_cpassword" required class="form-control" id="floatingInput"
                            placeholder="**********">
                        <label for="floatingInput">Confirm Password</label>
                    </div>
                </div>

                <div class="form-floating mb-3 w-50">
                    <input type="email" name="user_email" class="form-control" id="floatingInput"
                        placeholder="abs@xyz.com">
                    <label for="floatingInput">Email ID</label>
                </div>

                <div class="d-flex mob-flex w-100 mb-3">
                    <div class="form-floating m-1 w-100">
                        <select name="user_state" class="form-select" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option selected>Click here to get list of states</option>
                            <?php
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/states',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HTTPHEADER => array(
                                    'X-CSCAPI-KEY: eTAxUGIyaElOSm5ldE9YdDhmQTJTaWMxbEVWUVFqR1hqblZRNmRyVw=='
                                ),
                            ));
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $response_json = json_decode($response);
                            foreach ($response_json as $key) {
                                $user_state =  $key->name; ?>
                            <option value="<?php echo $user_state; ?>"><?php echo $user_state; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">State</label>
                    </div>

                    <div class="form-floating m-1 w-100">
                        <select name="user_city" class="form-select" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option selected>Click here to get list of cities</option>
                            <?php
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/cities',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HTTPHEADER => array(
                                    'X-CSCAPI-KEY: eTAxUGIyaElOSm5ldE9YdDhmQTJTaWMxbEVWUVFqR1hqblZRNmRyVw=='
                                ),
                            ));
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $response_json = json_decode($response);
                            foreach ($response_json as $key) {
                                $user_city =  $key->name; ?>

                            <option value="<?php echo $user_city; ?>"><?php echo $user_city; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">City</label>
                    </div>
                </div>

                <div class="form-floating mb-3 w-100">
                    <textarea class="form-control" name="user_address" placeholder="Leave a comment here"
                        id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">School Address</label>
                </div>


                <div class="d-flex mob-flex w-100 mb-3">
                    <div class="form-floating m-1 w-100">
                        <input type="text" maxlength="6" required name="user_pincode" class="form-control"
                            id="floatingInput" placeholder="abs@xyz.com">
                        <label for="floatingInput">Pincode</label>
                    </div>

                    <div class="form-floating m-1 w-100">
                        <select name="user_plan_amount" class="form-select" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option selected>Open this menu</option>
                            <option value="2800">Basic (₹2800/-)</option>
                            <option value="3600">Premium (₹3600/-)</option>
                            <option value="5000">Pro (₹5000/-)</option>
                        </select>
                        <label for="floatingSelect">Select Subscription Plan</label>
                    </div>
                </div>
                <input type="submit" name="register" value='Sign-Up' class="login-button">
                <div class="line section-form"></div>
                <div class="register-text">
                    <p>Already a member?<a href="index.php"> Click here </a>to Sign-In to your account</p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>